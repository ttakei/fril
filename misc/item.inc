<?php
require_once('logger.inc');
require_once('session.inc');

class Item extends Session
{
    const IMG_WIDTH = 163.5;
    const IMG_HEIGHT = 163.5;
    const LIST_TYPE_SELLING = 'selling';
    const LIST_TYPE_TRADING = 'trading';
    const LIST_TYPE_SOLD = 'sold';

    protected static $form_url = 'https://fril.jp/item/new';
    protected static $post_url = 'https://fril.jp/item/validate';

    protected static $default_header = array(
        'X-Requested-With' => 'XMLHttpRequest',
        'Connection' => 'keep-alive',
    );
    protected static $default_param = array(
        'utf8' => "\xE2\x9C\x93",
        'item[category_id]' => '',
        //'item[size_id]' => '',
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
    protected static $default_param_arr = array(
        'item_img_ids[]' => array('', '', '', ''),
        'updates[]' => array('', '', '', ''),
        'set_images[]' => array('', '', '', ''),
        'crop_x[]' => array('', '', '', ''),
        'crop_y[]' => array('', '', '', ''),
        'crop_size[]' => array('', '', '', ''),
    );
    protected static $default_param_file = array(
    );
    protected static $default_param_file_arr = array(
        'image_tmp' => array(),
        'images[]' => array(),
    );
    protected static $default_token = array(
        'parse' => array(
            '//meta[@name="csrf-token"]/@content' => array(
                'type' => 'header',
                'key' => 'X-CSRF-Token',
            ),
            //'//input[@type="hidden" and @name="authenticity_token"]/@value' => array(
            '//meta[@name="csrf-token" ]/@content' => array(
                'type' => 'param',
                'key' => 'authenticity_token',
            ),
        ),
    );

    private function __construct() {
    }

    public static function validate($arr) {
        static::$form_url = 'https://fril.jp/item/new';
        static::$post_url = 'https://fril.jp/item/validate';
        return self::post(array(
            'header' => static::$default_header,
            'param' => array_merge(static::$default_param, $arr['param']),
            'param_arr' => array_merge(static::$default_param_arr, $arr['param_arr']),
            'token' => static::$default_token,
            'redirect' => false,
            'referer_save' => false,
        ));
    }

    public static function get_item($id) {
        $url = "https://fril.jp/item/$id/edit";
        $result = self::get(array(
                'url' => $url,
        ));
        if (!isset($result['response']['html'])) {
            return array();
        }
        
        $html = '';
        //$html = '<?xml version="1.0" encoding="UTF-8"?';
        //$html = $html. '>';
        $html = $html. $result['response']['html'];
//var_dump($html); exit;
        $item = array();
/*
        $data_xml = $xml->xpath('//div[@data-react-class="ItemContent"]/@data-react-props');
var_dump($data_xml); exit;
        $data_raw = $data_xml[0]->__toString();
echo(urldecode($data_raw). "\n"); exit;
*/
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
        foreach (array_keys(static::$default_param) as $key) {
            $json_key = '';
            if (preg_match('/\[(.*?)\]/', $key, $match)) {
                $json_key = $match[1];
            }
            if (empty($json_key) || !isset($data['item'][$json_key])) {
                continue;
            }
            $val = $data['item'][$json_key];
/*
            $decoded = preg_replace_callback('|\\\\u([0-9a-f]{4})|i', function($matched){
                return mb_convert_encoding(pack('H*', $matched[1]), 'UTF-8', 'UTF-16');
            }, $val);
*/
            //$decoded = static::unicode_encode($val);
            $item['param'][$key] = $val;
        }
//        var_dump($item); exit;
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
        var_dump($item); exit;
    }

    public static function get_list($type) {
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

    public static function selling() {
        return static::get_list(static::LIST_TYPE_SELLING);
    }

    public static function traiding() {
        return static::get_list(static::LIST_TYPE_TRAIDING);
    }

    public static function sold() {
        return static::get_list(static::LIST_TYPE_SOLD);
    }

    public static function delete($id, $arr = array()) {
        static::$form_url = 'https://fril.jp/sell';
        static::$post_url = 'https://fril.jp/item/'. $id;
        return self::post(array(
            'header' => static::$default_header,
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

    public static function add($arr) {
        static::validate($arr);
        // 画像クロッピング
        $param_file_arr = array_merge(static::$default_param_file_arr, $arr['param_file_arr']);
        foreach ($param_file_arr['image_tmp'] as $image) {
            if (empty($image['filename'])) {
                continue;
            }
            $image_file = $image['filename'];
            $s_image_file = 's_'. $image_file;
            $mime = '';
            if (!static::trim_image($image_file, $s_image_file, $mime)) {
                Logger::err("failed crop image %s", $image_file);
                return false;
            }
            $param_file_arr['images[]'][] = array(
                'filename' => $s_image_file,
                'mime' => $mime,
                'postname' => $s_image_file,
            );
        }
        static::$post_url = 'https://fril.jp/item';
        return self::post(array(
            'header' => static::$default_header,
            'param' => array_merge(static::$default_param, $arr['param']),
            'param_arr' => array_merge(static::$default_param_arr, $arr['param_arr']),
            'param_file' => array_merge(static::$default_param_file, $arr['param_file']),
            'param_file_arr' => $param_file_arr,
            'reuse_token' => true,
            'redirect' => !empty($arr['redirect']),
        ));
    }

    public static function trim_image($file_path, $s_file_path, &$mime) {
        if (file_exists($s_file_path)) {
            unlink($s_file_path);
        }

        // 画像情報
        $image_info = getimagesize($file_path);
        if (!$image_info) {
            Logger::err("failed get image info $file_path");
            return false;
        }
        $mime = $image_info['mime'];
        $width = $image_info['0'];
        $height = $image_info['1'];

        // 伸縮後
        $s_width = static::IMG_WIDTH;
        $s_height = static::IMG_HEIGHT;
        $s_image_resource = imagecreatetruecolor($s_width, $s_height);

        // mimeに合わせて伸縮
        switch($mime) {
            case 'image/jpeg':
                $image_resource = imagecreatefromjpeg($file_path);
                imagecopyresampled($s_image_resource, $image_resource,
                    0, 0, 0, 0,
                    $s_width, $s_height, $width, $height);
                imagejpeg($s_image_resource, $s_file_path);
                break;
            case 'image/png':
                $image_resource = imagecreatefrompng($file_path);
                imagecopyresampled($s_image_resource, $image_resource,
                    0, 0, 0, 0,
                    $s_width, $s_height, $width, $height);
                imagepng($s_image_resource, $s_file_path);
                break;
            case 'image/gif':
                $image_resource = imagecreatefromgif($file_path);
                imagecopyresampled($s_image_resource, $image_resource,
                    0, 0, 0, 0,
                    $s_width, $s_height, $width, $height);
                imagegif($s_image_resource, $s_file_path);
                break;
            default:
                Logger::err("unknown mime $mime");
                return false;
        }
        return true;
    }

    protected static function unicode_encode($str) {
        return preg_replace_callback("/\\\\u([0-9a-zA-Z]{4})/", "static::encode_callback", $str);
    }
    
    protected static function encode_callback($matches) {
        $char = mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UTF-16");
        return $char;
    }
}
