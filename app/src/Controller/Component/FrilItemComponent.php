<?php
namespace App\Controller\Component;

use App\Controller\Component\SessionComponent;

class FrilItemComponent extends SessionComponent
{
    const LIST_TYPE_SELLING = 'selling';
    const LIST_TYPE_TRADING = 'trading';
    const LIST_TYPE_SOLD = 'sold';

    protected $form_url = 'https://fril.jp/item/new';
    protected $post_url = 'https://fril.jp/item/validate';

    protected $default_header = array(
        'X-Requested-With' => 'XMLHttpRequest',
        'Connection' => 'keep-alive',
    );
    protected $default_param = array(
        'utf8' => "\xE2\x9C\x93",
        'item[category_id]' => '',
        'item[size_id]' => '',
        'item[brand_id]' => '',
        'item[status]' => '',
        'item[carriage]' => '',
        'item[delivery_method]' => '',
        'item[delivery_date]' => '',
        'item[delivery_area]' => '',
        'item[request_required]' => '',
        'item[name]' => '',
        'item[detail]' => '',
        'item[sell_price]' => '',
    );
    protected $default_param_arr = array(
        'item_img_ids[]' => array('', '', '', ''),
        'updates[]' => array('', '', '', ''),
        'set_images[]' => array('', '', '', ''),
        'crop_x[]' => array('', '', '', ''),
        'crop_y[]' => array('', '', '', ''),
        'crop_size[]' => array('', '', '', ''),
    );
    protected $default_param_file = array(
    );
    protected $default_param_file_arr = array(
        'image_tmp' => array(),
        'images[]' => array(),
    );
    protected $default_token = array(
        'parse' => array(
            '//meta[@name="csrf-token"]/@content' => array(
                'type' => 'header',
                'key' => 'X-CSRF-Token',
            ),
            '//meta[@name="csrf-token" ]/@content' => array(
                'type' => 'param',
                'key' => 'authenticity_token',
            ),
        ),
    );

    public function validate($arr) {
        $this->form_url = 'https://fril.jp/item/new';
        $this->post_url = 'https://fril.jp/item/validate';
        return self::post(array(
            'header' => $this->default_header,
            'param' => array_merge($this->default_param, $arr['param']),
            'param_arr' => array_merge($this->default_param_arr, $arr['param_arr']),
            'token' => $this->default_token,
            'redirect' => false,
            'referer_save' => false,
        ));
    }

    public function get_item($id) {
        $url = "https://fril.jp/item/$id/edit";
        $result = self::get(array(
                'url' => $url,
        ));
        if (!isset($result['response']['html'])) {
            return array();
        }
        
        $html = '';
        $html = $html. $result['response']['html'];
        $item = array();
        if (!preg_match('/<div data-react-class="ItemContent" data-react-props="([^"]*)/', $html, $match)) {
            return array();
        }
        $data_raw = $match[1];
        $data_raw_decode = htmlspecialchars_decode($data_raw);
        $data = json_decode($data_raw_decode, true);

        $item = array();
        $param_arr_xpath = array(
            'item_img_ids[]' => '//input[@name="item_img_ids[]"]/@value',
        );
        foreach (array_keys($this->default_param) as $key) {
            $json_key = '';
            if (preg_match('/\[(.*?)\]/', $key, $match)) {
                $json_key = $match[1];
            }
            if (empty($json_key) || !isset($data['item'][$json_key])) {
                continue;
            }
            $val = $data['item'][$json_key];
            $item['param'][$key] = $val;
        }
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xml_raw = $dom->saveXML();
        $xml = simplexml_load_string($xml_raw);
        foreach ($param_arr_xpath as $key => $xpath) {
            if (empty($xpath)) {
                continue;
            }
            $e = $xml->xpath($xpath);
            foreach ($e as $q) {
                $val = $q->__toString();
                $item['param_arr'][$key][] = $val;
            }
        }
    }

    public function get_list($type) {
        if ($type != static::LIST_TYPE_SELLING &&
            $type != static::LIST_TYPE_TRADING &&
            $type != static::LIST_TYPE_SOLD
        ) {
            return null;
        }

        $url = "https://fril.jp/ajax/item/$type";
        $result= self::get(array(
                'url' => $url,
                'header' => array('X-Requested-With' => 'XMLHttpRequest'),
        ));
        if (!isset($result['response']['html'])) {
            return array();
        }

        $matches = array();
        if (!preg_match_all(
            '|/item/([^/]+)/edit|',
            $result['response']['html'], $matches, PREG_SET_ORDER)
        ) {
            return array();
        }

        $id_list = array();
        foreach ($matches as $match) {
            $id_list[] = $match[1];
        }
        return $id_list;
    }

    public function selling() {
        return $this->get_list(static::LIST_TYPE_SELLING);
    }

    public function traiding() {
        return $this->get_list(static::LIST_TYPE_TRAIDING);
    }

    public function sold() {
        return $this->get_list(static::LIST_TYPE_SOLD);
    }

    public function delete($id, $arr = array()) {
        $this->form_url = 'https://fril.jp/sell';
        $this->post_url = 'https://fril.jp/item/'. $id;
        return self::post(array(
            'header' => $this->default_header,
            'param' => array('_method' => 'delete'),
            'token' => array(
                'parse' => array(
                    '//meta[@name="csrf-token" ]/@content' => array(
                        'type' => 'param',
                        'key' => 'authenticity_token',
                    ),
                ),
            ),
            'redirect' => false,
            'referer_save' => false,
        ));
    }

    public function add($arr, $cookie) {
        $this->init($cookie);
        $result_validate = $this->validate($arr);
        if ($result_validate['response']['info']['http_code'] < 200 ||
            $result_validate['response']['info']['http_code'] >= 300
        ) {
            Log::debug("failed validate: %s", var_export($result_validate['response']));
            return false;
        }

        $param_file_arr = array_merge($this->default_param_file_arr, $arr['param_file_arr']);
        $this->post_url = 'https://fril.jp/item';
        $result = $this->post(array(
            'header' => $this->default_header,
            'param' => array_merge($this->default_param, $arr['param']),
            'param_arr' => array_merge($this->default_param_arr, $arr['param_arr']),
            //'param_file' => array_merge($this->default_param_file, $arr['param_file']),
            'param_file_arr' => $param_file_arr,
            'reuse_token' => true,
            'redirect' => !empty($arr['redirect']),
        ));

        if ($result['response']['info']['http_code'] < 200 ||
            $result['response']['info']['http_code'] >= 300
        ) {
            Log::debug("failed post: %s", var_export($result['response']));
            return false;
        }
        return true;
    }
}
