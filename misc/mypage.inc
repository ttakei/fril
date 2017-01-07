<?php
require_once('logger.inc');
require_once('session.inc');

class Mypage extends Session
{
    protected static $form_url = 'https://fril.jp/mypage';
    protected static $post_url = '';

    private function __construct() {
    }

    public static function test() {
        $response = Browser::get(array(
            'url' => self::$form_url,
        ));
        var_dump($response);
    }
}
