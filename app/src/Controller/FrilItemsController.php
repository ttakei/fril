<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Log\Log;

/**
 * FrilItemBulkExhibit Controller
 */
class FrilItemsController extends AppController
{
    const IMG_WIDTH = 163.5;
    const IMG_HEIGHT = 163.5;
    const S_IMG = WWW_ROOT. 'img'. DS. 'app_item'. DS;

    public $components = ['FrilItem', 'FrilData'];

    protected $post_default = array(
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

            $s_img_dirname = uniqid(getmypid(). "_", true);
            $s_img_dir = self::S_IMG. $s_img_dirname;
            if (!is_dir($s_img_dir) && !mkdir($s_img_dir)) {
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

                $item_arr = explode($item_delimiter, $item_line);
                if (count($item_arr) < 17) {
                    $this->Flash->error(sprintf('%d行目: フィールの数が足りません', $line));
                    return $this->redirect(['action'=>'bulk']);
                }
                $item['category_id'] = array_shift($item_arr);
                $item['size_id'] = array_shift($item_arr);
                $item['brand_id'] = array_shift($item_arr);
                $item['status'] = array_shift($item_arr);
                $item['carriage'] = array_shift($item_arr);
                $item['delivery_method'] = array_shift($item_arr);
                $item['delivery_date'] = array_shift($item_arr);
                $item['delivery_area'] = array_shift($item_arr);
                $item['request_required'] = array_shift($item_arr);
                $item['request_required'] = empty($item['request_required']) ?
                    '0' : $item['request_required'];
                $item['name'] = array_shift($item_arr);
                $item['detail'] = array_shift($item_arr);
                $item['sell_price'] = array_shift($item_arr);
                $img_name_arr = array();
                $img_name_arr[] = array_shift($item_arr);
                $img_name_arr[] = array_shift($item_arr);
                $img_name_arr[] = array_shift($item_arr);
                $img_name_arr[] = array_shift($item_arr);
                $item['re_exhibit_type'] = array_shift($item_arr);
                $item['re_exhibit_flg'] = array_shift($item_arr);
                $item['re_exhibit_flg'] = !empty($item['re_exhibit_flg']);
                $post = array();

                // 商品情報チェック
                if (!$this->validate($item)) {
                    $this->Flash->error(sprintf(
                        '%s行目に問題がありました',
                        $line
                    ));
                    return $this->redirect(['action'=>'bulk']);
                }

                // 画像チェック、画像情報取得
                if (!$this->validate_img($imgs, $img_name_arr, $s_img_dir, $post, $item)) {
                    $this->Flash->error(sprintf(
                        '%s行目に問題がありました',
                        $line
                    ));
                    return $this->redirect(['action'=>'bulk']);
                }
                $item['imgdir'] = $s_img_dirname;

                // 出品   
                if (!empty($this->request->data['direct_exhibit'])) {
                    if (!$this->post($post, $item, $user_shop_account)) {
                        $this->Flash->error(sprintf(
                            '%s行目に問題がありました',
                            $line
                        ));
                        return $this->redirect(['action'=>'bulk']);
                    }
                    $this->Flash->success(sprintf(
                        '%d行目(%s): 出品に成功しました',
                        $line, $item['name']
                    ));
                    $item['last_exhibit_datetime'] = new \DateTime();
                    $item['exhibit_cnt'] = 1;
                }

                // DBに格納
                $item['user_shop_account_id'] = $user_shop_account->id;
                if (!$this->store($item)) {
                    $this->Flash->error(sprintf(
                        '%s行目に問題がありました',
                        $line
                    ));
                    return $this->redirect(['action'=>'bulk']);
                }
            }
        }

        $this->set('is_admin', $this->is_admin);
        $this->set('user_shop_account', $user_shop_account);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
    }

    /**
     * Add method
     */
    public function add($id = null)
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
            if (!isset($this->request->data['item_img']) ||
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

            $s_img_dirname = uniqid(getmypid(). "_", true);
            $s_img_dir = self::S_IMG. $s_img_dirname;
            if (!is_dir($s_img_dir) && !mkdir($s_img_dir)) {
                Log::debug(sprintf("bad request at %s(%s)", __FILE__, __LINE__));
                throw new BadRequestException('内部エラー');
            }

            $item = $this->request->data;
            $post = array();

            // 商品情報チェック
            if (!$this->validate($item)) {
                return $this->redirect(['action'=>'bulk']);
            }

            // 画像チェック、画像情報取得
            if (!$this->validate_img($imgs, array_keys($imgs), $s_img_dir, $post, $item)) {
                return $this->redirect(['action'=>'bulk']);
            }
            $item['imgdir'] = $s_img_dirname;

            // 出品   
            if (!empty($this->request->data['direct_exhibit'])) {
                if (!$this->post($post, $item, $user_shop_account)) {
                    return $this->redirect(['action'=>'bulk']);
                }
                $this->Flash->success(sprintf(
                    '出品に成功しました'
                ));
                $item['last_exhibit_datetime'] = new \DateTime();
                $item['exhibit_cnt'] = 1;
            }

            // DBに格納
            $item['user_shop_account_id'] = $user_shop_account->id;
            if (!$this->store($item)) {
                return $this->redirect(['action'=>'bulk']);
            }
        }

        $data_tbl = TableRegistry::get('fril_data');
        $data_all = array();
        $data_type_all = array(
            'category',
            'size',
            'brand',
            'status',
            'carriage',
            'delivery_method',
            'delivery_date',
            'delivery_area',
            'request_required',
        );
        foreach ($data_type_all as $data_type) {
            $data_obj_list = $data_tbl->find()->where(array('type' => $data_type));
            $data_arr = array();
            $data_arr[] = array('value' => '', 'text' => '');
            foreach ($data_obj_list as $data_obj) {
                $data_arr[] = array(
                    'value' => $data_obj->id,
                    'text' => $data_obj->name,
                );
            }
            $this->set($data_type, $data_arr);
        }

        $this->set('is_admin', $this->is_admin);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
    }

    /**
     * All method
     */
    public function all($id = null)
    {
        $user_shop_accounts_tbl = TableRegistry::get('user_shop_accounts');
        $fril_items_tbl = TableRegistry::get('fril_items');
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

        $conn = ConnectionManager::get('default');
        $fril_items = $conn->query(sprintf(
            "SELECT * FROM fril_items USE INDEX (account_idx) WHERE user_shop_account_id = '%s'",
            $user_shop_account->id
        ))->fetchAll('assoc');

        $this->set('is_admin', $this->is_admin);
        $this->set('fril_items', $fril_items);
        $this->set('current_user', $this->current_user);
        $this->set('current_user_shop_account', $this->current_user_shop_account);
    }

    /**
     * Validate method
     */
    protected function validate($item)
    {
        // カテゴリ
        if (!$this->FrilData->existed_category($item['category_id'])) {
            $this->Flash->error(sprintf(
                'カテゴリID %s は存在しません',
                $item['category_id']
            ));
            return false;
        }
 
        // サイズ
        if ($this->FrilData->size($item['size_id']) === null) {
            $this->Flash->error(sprintf(
                'サイズID %s は存在しません',
                $item['size_id']
            ));
            return false;
        }
 
        // ブランド
        if (!empty($item['brand_id']) &&
            !$this->FrilData->existed_brand($item['brand_id'])
        ) {
            $this->Flash->error(sprintf(
                'ブランドID %s は存在しません',
                $item['brand_id']
            ));
            return false;
        }
 
        // 商品状態
        if ($this->FrilData->status($item['status']) === null) {
            $this->Flash->error(sprintf(
                '商品状態ID %s は存在しません',
                $item['status']
            ));
            return false;
        }
 
        // 配送料負担
        if ($this->FrilData->carriage($item['carriage']) === null) {
            $this->Flash->error(sprintf(
                '配送料負担ID %s は存在しません',
                $item['carriage']
            ));
            return false;
        }
 
        // 配送方法
        if ($this->FrilData->delivery_method($item['delivery_method']) === null) {
            $this->Flash->error(sprintf(
                '配送方法ID %s は存在しません',
                $item['delivery_method']));
            return false;
        }
 
        // 発送日目安
        if ($this->FrilData->delivery_date($item['delivery_date']) === null) {
            $this->Flash->error(sprintf(
                '発送日目安ID %s は存在しません',
                $item['delivery_date']
            ));
            return false;
        }
 
        // 発送元地域
        if ($this->FrilData->delivery_area($item['delivery_area']) === null) {
            $this->Flash->error(sprintf(
                '発送元地域ID %s は存在しません',
                $item['delivery_area']
            ));
            return false;
        }
 
        // 購入申請
        if ($this->FrilData->request_required($item['request_required']) === null) {
            $this->Flash->error(sprintf(
                '購入申請ID %s は存在しません',
                $item['request_required']
            ));
            return false;
        }
 
        // 商品名
        if (empty($item['name'])) {
            $this->Flash->error(sprintf(
                '商品名は必須です'
            ));
            return false;
        }
        if (strlen($item['name']) > 100) {
            $this->Flash->error(sprintf(
                '商品名は100byte以内にして下さい'
            ));
            return false;
        }
 
        // 商品説明
        if (empty($item['detail'])) {
            $this->Flash->error(sprintf(
                '商品説明は必須です'
            ));
            return false;
        }

        // 商品価格
        if (empty($item['sell_price']) ||
            $item['sell_price'] < 300 ||
            $item['sell_price'] > 500000
        ) {
            $this->Flash->error(sprintf('
                商品価格は300～500,000円の必要があります'
            ));
            return false;
        }

        // 再出品タイプ
        if (!empty($item['re_exhibit_type']) &&
            $item['re_exhibit_type'] != 'none' &&
            $item['re_exhibit_type'] != 'normal' &&
            $item['re_exhibit_type'] != 'dupl' &&
            $item['re_exhibit_type'] != 'nocomment'
        ) {
            $this->Flash->error(sprintf(
                '再出品タイプが不正です',
                $post['param']['item[name]']
            ));
            return false;
        }
        return true;
    }

    public function validate_img($imgs, $img_name_arr, $s_img_dir, &$post, &$item)
    {
        // 画像ファイル
        for ($i = 0; $i < count($img_name_arr); $i++) {
            $img_name = $img_name_arr[$i];
            if (empty($img_name)) {
                if ($i == 0) {
                    $this->Flash->error(sprintf(
                        '%d行目: 画像ファイル1は必須です',
                        $line
                    ));
                    return false;
                } else {
                    break;
                }
            }

            if (strlen($img_name) > 50) {
                $this->Flash->error(sprintf(
                    '画像ファイル名は50byte以下にしてください'
                ));
                return false;
            }
            if (empty($imgs["$img_name"])) {
                $this->Flash->error(sprintf(
                    '画像ファイル %s がアップロードされていません',
                    $img_name
                ));
                return false;
            }
            $img_path = $imgs[$img_name];
            $s_img_name = $img_name;
            $s_img_path = $s_img_dir. DS. $s_img_name;
            if (!$this->Image->trim(
                    $img_path, $s_img_path,
                    static::IMG_WIDTH, static::IMG_HEIGHT, $mime
                )
            ) {
                $this->Flash->error(sprintf(
                    '画像ファイル %s のクロッピングに失敗しました',
                    $img_name
                ));
                return false;
            }
            $post['param_arr']['updates[]'][$i] = '1';
            $post['param_arr']['set_images[]'][$i] = '1';
            $post['param_file_arr']['image_tmp'][$i]['filename'] = $img_path;
            $post['param_file_arr']['images[]'][$i]['filename'] = $s_img_path;
            $post['param_file_arr']['images[]'][$i]['mime'] = $mime;
            $post['param_file_arr']['images[]'][$i]['postname'] = $s_img_name;
            $imgno = $i + 1;
            $item["imgfile_${imgno}"] = $s_img_name;
        }
        return true;
    }

    public function post($post, $item, $user_shop_account)
    {
        $post = array_merge($this->post_default, $post);

        // $post['param']配列組み立て
        foreach (array_keys($post['param']) as $post_key) {
            if (!preg_match('/item\[(.*?)\]/', $post_key, $match)) {
                Log::debug(sprintf(
                    'err at %s(%s)', __FILE__, __LINE__));
                $this->Flash->error('内部エラー');
                return false;
            }
            $key = $match[1];

            if (!isset($item[$key])) {
                Log::debug(sprintf(
                    'err at %s(%s)', __FILE__, __LINE__));
                $this->Flash->error('内部エラー');
                return false;
            }
            $post['param'][$post_key] = $item[$key];
        }

        // 出品 
        if (!$this->FrilItem->add($post, $user_shop_account->cookie)) {
            $this->Flash->error(sprintf(
                '出品リクエストに失敗しました',
                $post['param']['item[name]']
            ));
            return false;
        }

        return true;
    }

    public function store($item)
    {
        $fril_items_tbl = TableRegistry::get('fril_items');
        $fril_item = $fril_items_tbl->newEntity();
        $fril_item =  $fril_items_tbl->patchEntity($fril_item, $item);
        if (!$fril_items_tbl->save($fril_item)) {
            $this->Flash->error(sprintf(
                'データ保存に失敗しました',
                $post['param']['item[name]']
            ));
            return false;
        }
        return true;
    }
}
