<?php
require_once('logger.inc');
require_once('session.inc');

class Login extends Session
{
    protected static $form_url = 'https://fril.jp/users/sign_in';
    protected static $post_url = 'https://fril.jp/users/sign_in';

    private function __construct() {
    }

    public static function login($mail, $pass) {
        if (empty($mail) || empty($pass)) {
            Logger::err('no mail or pass %s');
            return false;
        }
        
        return self::post(array(
            'param' => array(
                'user[email]' => $mail,
                'user[password]' => $pass,
            ),
            'token' => array(
                'parse' => array(
                    '//input[@type="hidden" and @name="authenticity_token"]/@value' => array(
                        'type' => 'param',
                        'key' => 'authenticity_token',
                    ),
                ),
            ),
        ));
    }
}
