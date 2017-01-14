<?php
namespace App\Controller\Component;

use App\Controller\Component\SessionComponent;
use Cake\Log\Log;

class FrilLoginComponent extends SessionComponent
{
    protected $form_url = 'https://fril.jp/users/sign_in';
    protected $post_url = 'https://fril.jp/users/sign_in';

    public function login($mail, $pass, &$cookie, &$nickname) {
        if (empty($mail) || empty($pass)) {
            Log::error('no mail or pass %s');
            return false;
        }

        $this->init($cookie);
        
        $result = $this->post(array(
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

        if (!isset($result['response']['info']['http_code']) || 
            $result['response']['info']['http_code'] < 200 ||
            $result['response']['info']['http_code'] >= 300
        ) {
            return false;
        }

        if (isset($result['response']['html']) &&
            preg_match('/([^>]*?)さんのマイページ/', $result['response']['html'], $match)
        ) {
            $nickname  = $match[1];
        }
        return true;
    }
}
