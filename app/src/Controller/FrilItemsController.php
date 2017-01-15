<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\BadRequestException;
use Cake\Log\Log;

/**
 * FrilItemBulkExhibit Controller
 */
class FrilItemsController extends AppController
{
    const IMG_WIDTH = 163.5;
    const IMG_HEIGHT = 163.5;
    const S_IMG = TMP. 'app_s_imgs'. DS;

    public $components = ['FrilItem', 'FrilData'];

    /**
     * Bulk method
     */
    public function bulk($id = null)
    {
        $user_shop_accounts_tbl = TableRegistry::get('user_shop_accounts');
        if (!empty($id)) {
            if (!$this->is_admin) {
                return $this->redirect(['action'=>'bulk']);
            }
            $user_shop_account = $user_shop_accounts_tbl->get($id);
        } else {
            if (empty($this->current_user_shop_account)) {
                return $this->redirect(
                    ['controller' => 'UserShopAccounts', 'action'=>'edit']);
            }
            $user_shop_account = $this->current_user_shop_account;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!isset($this->request->data['item_csv']) ||
                empty($this->request->data['item_format']) ||
                !isset($this->request->data['item_img']) ||
                !is_array($this->request->data['item_img'])
            ) {
                Log::debug(sprintf("bad request at %s(%s)", __FILE__, __LINE__));
                throw new BadRequestException('入力が不正です');
            }
            $imgs = array();
            foreach ($this->request->data['item_img'] as $img) {
                if (empty($img['name']) ||
                    empty($img['tmp_name'])
                ) {
                    continue;
                }
                $imgs[$img['name']] = $img['tmp_name'];

            }

            if ($this->request->data['item_format'] == 'tsv') {
                $item_delimiter = "\t";
            } elseif($this->request->data['item_format'] == 'csv') {
                $item_delimiter = ",";
            } else {
                Log::debug(sprintf("bad request at %s(%s)", __FILE__, __LINE__));
                throw new BadRequestException('入力が不正です');
            }

            $s_img_tmp_dir = self::S_IMG. uniqid(getmypid(). "_");
            if (!is_dir($s_img_tmp_dir) && !mkdir($s_img_tmp_dir)) {
                Log::debug(sprintf("bad request at %s(%s)", __FILE__, __LINE__));
                throw new BadRequestException('内部エラー');
            }
            $item_lines = explode("\n", $this->request->data['item_csv']);
            $line = 0;
            foreach ($item_lines as $item_line) {
                $line++;
                $item_line = rtrim($item_line);
                if (empty($item_line)) {
                    continue;
                }

                $post = array(
                    'param_arr' => array(
                        'item_img_ids[]' => array('', '', '', ''),
                        'updates[]' => array('1', '', '', ''),
                        'set_images[]' => array('1', '', '', ''),
                        'crop_x[]' => array('', '', '', ''),
                        'crop_y[]' => array('', '', '', ''),
                        'crop_size[]' => array('', '', '', ''),
                    ),
                    'param' => array(
                        'item[category_id]' => null,
                        'item[size_id]' => null,
                        'item[brand_id]' => null,
                        'item[status]' => null,
                        'item[carriage]' => null,
                        'item[delivery_method]' => null,
                        'item[delivery_date]' => null,
                        'item[delivery_area]' => null,
                        'item[request_required]' => null,
                        'item[name]' => null,
                        'item[detail]' => null,
                        'item[sell_price]' => null,
                    ),
                    'param_file_arr' => array(
                        'image_tmp' => array(
                            array(
                                'filename' => null,
                                'mime' => 'application/octet-stream',
                                'postname' => '',
                            ),
                            array(), array(), array(),
                        ),
                        'images[]' => array(
                            array(
                                'filename' => null,
                                'mime' => null,
                                'postname' => null,
                            ),
                        ),
                    ),
                );

                $item_arr = explode($item_delimiter, $item_line);
                if (count($item_arr) < 12) {
                    $this->Flash->error(sprintf('%d行目: フィールの数が足りません', $line));
                    return $this->redirect(['action'=>'bulk']);
                }

                // カテゴリ
                $post['param']['item[category_id]'] = array_shift($item_arr);
                if (!$this->FrilData->existed_category($post['param']['item[category_id]'])) {
                    $this->Flash->error(sprintf('%d行目: カテゴリID %s は存在しません',
                        $line, $post['param']['item[category_id]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // サイズ
                $post['param']['item[size_id]'] = array_shift($item_arr);
                if (!isset($this->FrilData->size[$post['param']['item[size_id]']])) {
                    $this->Flash->error(sprintf('%d行目: サイズID %s は存在しません',
                        $line, $post['param']['item[size_id]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // ブランド
                $post['param']['item[brand_id]'] = array_shift($item_arr);
                if (!empty($post['param']['item[brand_id]']) &&
                    !$this->FrilData->existed_brand($post['param']['item[brand_id]'])
                ) {
                    $this->Flash->error(sprintf('%d行目: ブランドID %s は存在しません',
                        $line, $post['param']['item[brand_id]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 商品状態
                $post['param']['item[status]'] = array_shift($item_arr);
                if (!isset($this->FrilData->status[$post['param']['item[status]']])) {
                    $this->Flash->error(sprintf('%d行目: 商品状態ID %s は存在しません',
                        $line, $post['param']['item[status]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 配送料負担
                $post['param']['item[carriage]'] = array_shift($item_arr);
                if (!isset($this->FrilData->carriage[$post['param']['item[carriage]']])) {
                    $this->Flash->error(sprintf('%d行目: 配送料負担ID %s は存在しません',
                        $line, $post['param']['item[carriage]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 配送方法
                $post['param']['item[delivery_method]'] = array_shift($item_arr);
                if (!isset($this->FrilData->delivery_method[$post['param']['item[delivery_method]']])) {
                    $this->Flash->error(sprintf('%d行目: 配送方法ID %s は存在しません',
                        $line, $post['param']['item[delivery_method]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 発送日目安
                $post['param']['item[delivery_date]'] = array_shift($item_arr);
                if (!isset($this->FrilData->delivery_date[$post['param']['item[delivery_date]']])) {
                    $this->Flash->error(sprintf('%d行目: 発送日目安ID %s は存在しません',
                        $line, $post['param']['item[delivery_date]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 発送元地域
                $post['param']['item[delivery_area]'] = array_shift($item_arr);
                if (!isset($this->FrilData->delivery_area[$post['param']['item[delivery_area]']])) {
                    $this->Flash->error(sprintf('%d行目: 発送元地域ID %s は存在しません',
                        $line, $post['param']['item[delivery_area]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 購入申請
                $post['param']['item[request_required]'] = array_shift($item_arr);
                $post['param']['item[request_required]'] = empty($post['param']['item[request_required]']) ?
                    '0' : $post['param']['item[request_required]'];
                if (!isset($this->FrilData->request_required[$post['param']['item[request_required]']])) {
                    $this->Flash->error(sprintf('%d行目: 購入申請ID %s は存在しません',
                        $line, $post['param']['item[request_required]']));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 商品名
                $post['param']['item[name]'] = array_shift($item_arr);
                if (empty($post['param']['item[name]'])) {
                    $this->Flash->error(sprintf('%d行目: 商品名は必須です', $line));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 商品説明
                $post['param']['item[detail]'] = array_shift($item_arr);
                if (empty($post['param']['item[detail]'])) {
                    $this->Flash->error(sprintf('%d行目: 商品説明は必須です', $line));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 商品価格
                $post['param']['item[sell_price]'] = array_shift($item_arr);
                if (empty($post['param']['item[sell_price]']) ||
                    $post['param']['item[sell_price]'] < 300 ||
                    $post['param']['item[sell_price]'] > 500000
                ) {
                    $this->Flash->error(sprintf('%d行目: 商品価格が不正です', $line));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 画像ファイル
                $img_name = array_shift($item_arr);
                if (empty($imgs["$img_name"])) {
                    $this->Flash->error(sprintf('%d行目: 画像ファイル %s がアップロードされていません',
                        $line, $img_name));
                    continue;
                }
                $img_path = $imgs[$img_name];
                $s_img_name = $img_name;
                $s_img_path = $s_img_tmp_dir. DS. $s_img_name;
                if (!$this->Image->trim(
                        $img_path, $s_img_path, static::IMG_WIDTH, static::IMG_HEIGHT, $mime)
                ) {
                    $this->Flash->error(sprintf('%d行目: 画像ファイル %s のクロッピングに失敗しました',
                        $line, $img_name));
                    continue;
                }
                $post['param_file_arr']['image_tmp'][0]['filename'] = $img_path;
                $post['param_file_arr']['images[]'][0]['filename'] = $s_img_path;
                $post['param_file_arr']['images[]'][0]['mime'] = $mime;
                $post['param_file_arr']['images[]'][0]['postname'] = $s_img_name;

                if (!$this->FrilItem->add($post, $user_shop_account->cookie)) {
                    $this->Flash->error(sprintf('%d行目(%s): 出品リクエストに失敗しました', $line, $post['param']['item[name]']));
                    continue;
                }
            }
            //rmdir($s_img_tmp_dir);
            system("/bin/rm -rf $s_img_tmp_dir");
        }

        $this->set('is_admin', $this->is_admin);
        $this->set('user_shop_account', $user_shop_account);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
    }
}
