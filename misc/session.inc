<?php
require_once('logger.inc');
require_once('browser.inc');

class Session
{
    protected static $form_url = '';
    protected static $post_url = '';
    protected static $token = '';

    private function __construct() {
    }

    protected static function get($arr = array()) {
        $arr = array_merge(array(
                'url' => '',
                'param' => array(),
                'header' => array(),
                'reuse_token' => false,
                'redirect' => true,
                'referer_save' => true,
            ), $arr);

        return Browser::get($arr);
    }

    protected static function post($arr = array()) {
        $arr = array_merge(
            array(
                'param' => array(),
                'param_arr' => array(),
                'param_file' => array(),
                'param_file_arr' => array(),
                'header' => array(),
                'reuse_token' => false,
                'redirect' => true,
                'referer_save' => true,
            ),
            $arr
        );

        $arr_token = array();
        if ($arr['reuse_token']) {
            $arr_token = static::$token;
        } elseif (!empty($arr['token'])) {
            static::token($arr['token'], array(), $arr_token);
        }
        if (!empty($arr_token['param'])) {
            $arr['param'] =
                array_merge($arr['param'], $arr_token['param']);
        }
        if (!empty($arr_token['header'])) {
            $arr['header'] =
                array_merge($arr['header'], $arr_token['header']);
        }

        return Browser::post(array(
            'url' => static::$post_url,
            'param' => $arr['param'],
            'param_arr' => $arr['param_arr'],
            'param_file' => $arr['param_file'],
            'param_file_arr' => $arr['param_file_arr'],
            'header' => $arr['header'],
            'redirect' => $arr['redirect'],
            'referer_save' => $arr['referer_save'],
        ));
    }

    protected static function token($token_needle, $param = array(), &$out) {
        $parse = empty($token_needle['parse']) ? array() : $token_needle['parse'];
        $preg_match = empty($token_needle['preg_match']) ? array() : $token_needle['preg_match'];
        $url = static::$form_url;
        $result = Browser::get(array(
            'url' => $url,
            'param' => $param,
            'redirect' => true,
            'parse' => array_keys($parse),
            'preg_match' => array_keys($preg_match),
        ));

        foreach ($parse as $xpath => $val) {
            $key = $val['key'];
            $type = $val['type'];
            $out[$type][$key] = $result['parsed'][$xpath];
        }

        foreach ($preg_match as $regex => $val) {
            $key = $val['key'];
            $type = $val['type'];
            $out[$type][$key] = $result['preg_matched'][$regex];
        }

        static::$token = $out;
        return;
    }
}
