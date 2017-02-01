<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class FrilDataComponent extends Component
{
/*
    public $size = array(
        '10001' => '~XS',
        '10003' => 'S',
        '10004' => 'M',
        '10005' => 'L',
        '10008' => 'XL',
        '10009' => 'XXL~',
        '19998' => 'FREE / ONESIZE',
    );

    public $status = array(
        '1' => '全体的に状態が悪い',
        '2' => '傷や汚れあり',
        '3' => 'やや傷や汚れあり',
        '4' => '未使用に近い',
        '5' => '新品、未使用',
        '6' => '目立った傷や汚れなし',
    );

    public $carriage = array(
        '1' => '送料込み（出品者が負担）',
        '2' => '着払い（購入者が負担）',
    );

    public $delivery_method = array(
        '1' => '普通郵便',
        '2' => 'ゆうパック元払い',
        '3' => 'レターパックプラス',
        '4' => 'レターパックライト',
        '6' => 'ヤマト宅急便',
        '10' => 'はこBOON',
        '11' => 'クリックポスト',
        '12' => 'ゆうメール元払い',
        '14' => '宅急便コンパクト',
        '16' => 'スマートレター',
        '17' => 'ゆうパケット',
    );

    public $delivery_date = array(
        '1' => '支払い後、1～2日で発送',
        '2' => '支払い後、2～3日で発送',
        '3' => '支払い後、4～7日で発送',
    );

    public $delivery_area = array(
        '1' => '北海道',
        '2' => '青森県',
        '3' => '岩手県',
        '4' => '宮城県',
        '5' => '秋田県',
        '6' => '山形県',
        '7' => '福島県',
        '8' => '茨城県',
        '9' => '栃木県',
        '10' => '群馬県',
        '11' => '埼玉県',
        '12' => '千葉県',
        '13' => '東京都',
        '14' => '神奈川県',
        '15' => '新潟県',
        '16' => '富山県',
        '17' => '石川県',
        '18' => '福井県',
        '19' => '山梨県',
        '20' => '長野県',
        '21' => '岐阜県',
        '22' => '静岡県',
        '23' => '愛知県',
        '24' => '三重県',
        '25' => '滋賀県',
        '26' => '京都府',
        '27' => '大阪府',
        '28' => '兵庫県',
        '29' => '奈良県',
        '30' => '和歌山県',
        '31' => '鳥取県',
        '32' => '島根県',
        '33' => '岡山県',
        '34' => '広島県',
        '35' => '山口県',
        '36' => '徳島県',
        '37' => '香川県',
        '38' => '愛媛県',
        '39' => '高知県',
        '40' => '福岡県',
        '41' => '佐賀県',
        '42' => '長崎県',
        '43' => '熊本県',
        '44' => '大分県',
        '45' => '宮崎県',
        '46' => '鹿児島県',
        '47' => '沖縄県',
    );

    public $request_required = array(
        '0' => 'なし',
        '1' => 'あり',
    );
*/
    protected $data_tbl;

    public function __construct() {
        $this->data_tbl = TableRegistry::get('fril_data');
    }

    public function __call($name, $args) {
        if (!isset($args[0])) {
            return null;
        }
        $id = $args[0];
        $result = $this->data_tbl->find()
            ->where(['type' => $name, 'id' => $id])
            ->first();

        if (empty($result['name'])) {
            return null;
        }

        return $result['name'];
    }

    public function getCategory($id) {
        $result = $this->data_tbl->find()
            ->where(['type' => 'category', 'id' => $id])
            ->first();

        if (empty($result['name'])) {
            return null;
        }

        return $result['name'];
    }

    public function existed_category($id) {
        $data = $this->getCategory($id);
        return $data !== null;
    }

    public function getBrand($id) {
        $result = $this->data_tbl->find()
            ->where(['type' => 'brand', 'id' => $id])
            ->first();

        if (empty($result['name'])) {
            return null;
        }

        return $result['name'];
    }

    public function existed_brand($id) {
        $data = $this->getBrand($id);
        return $data !== null;
    }

}
