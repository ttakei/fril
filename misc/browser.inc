<?php
require_once('logger.inc');

class Browser
{
    const CURL_TIMEOUT_CON = 10;
    const CURL_TIMEOUT = 30;
    const CURL_MAX_REDIRECT = 10;
    const CURL_METHOD_GET = 1;
    const CURL_METHOD_POST = 2;

    protected static $init = false;
    protected static $referer = null;
    protected static $cookie = '/tmp/browser_cookie';
    protected static $form_boundary = '------WebKitFormBoundaryccwehceFUBO6ghT1';

    // chrome v55
    static protected $header = array(
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36',
        //'Upgrade-Insecure-Requests' => '1',
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Language' => 'ja,en-US;q=0.8,en;q=0.6',
        //'Cache-Control' => 'no-cache',
    );

    protected function __construct() {
    }

    public static function __callStatic($func_name, $args) {
        if (!static::$init && !static::init()) {
            return null;
        }
        return call_user_func_array(__CLASS__. '::'. $func_name, $args);
    }

    protected static function init() {
        if (file_exists(static::$cookie) === true) {
            Logger::info("use cookie %s", static::$cookie);
        } elseif (touch(static::$cookie) !== true) {
            Logger::err("failed browser init. can't touch cookie %s", static::$cookie);
            return false;
        }
        static::$init = true;
        return true;
    }

    protected static function curl($arr = array()) {
        // バリデーションと初期値
        if (empty($arr['url']) || 
            ( $arr['method'] !== static::CURL_METHOD_GET &&
                $arr['method'] !== static::CURL_METHOD_POST )
        ) {
            Logger::crit("invalid param %s", var_export($arr));
            return null;
        }
        $url = $arr['url'];
        $method = $arr['method'];
        $param = empty($arr['param']) ? array() : $arr['param'];
        $param_arr = empty($arr['param_arr']) ? array() : $arr['param_arr'];
        $param_file = empty($arr['param_file']) ? array() : $arr['param_file'];
        $param_file_arr = empty($arr['param_file_arr']) ? array() : $arr['param_file_arr'];
        $header = empty($arr['header']) ? array() : $arr['header'];
        $redirect = !isset($arr['redirect']) ? true : $arr['redirect'];
        $referer_save = !isset($arr['referer_save']) ? true : $arr['referer_save'];
        $do_parse = (!isset($arr['parse']) || !is_array($arr['parse'])) ?
            false : true;
        $do_preg_match = (!isset($arr['preg_match']) || !is_array($arr['preg_match'])) ?
            false : true;

        // 結果
        $result = array();

        // 初期化
        $ch = curl_init();

        // メソッドによる分岐
        $field_arr = array();
        $field_raw = "";
        if ($method == static::CURL_METHOD_GET) {
            if (!empty($param)) {
                $query = http_build_query($param);
                curl_setopt($ch, CURLOPT_URL, "${url}?${query}");
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        } elseif ($method == static::CURL_METHOD_POST) {
            curl_setopt($ch, CURLOPT_POST, true);
            static::$form_boundary = "---------------------" . md5(mt_rand() . microtime());
            if (!empty($param)) {
                $field = array();
                $field = array_merge($field, $param);
                foreach ($field as $key => $val) {
                    $field_arr[] = array($key, $val);
                }
            }
            if (!empty($param_arr)) {
                foreach ($param_arr as $key => $parr) {
                    for ($i = 0; $i < count($parr); $i++) {
                        $field_arr[] = array($key, $parr[$i]);
                    }
                }
            }
            if (!empty($param_file)) {
                foreach ($param_file as $key => $val) {
                    $val = array_merge(array(
                        'filename' => '', 'mime' => '', 'postname' => ''),
                        $val);
                    if (empty($val['filename'])) {
                        $file = '';
                    } else {
                        $file = file_get_contents($val['filename']);
                    }
                    $field_arr[] = array(
                        $key, $file, $val['mime'], $val['postname']);
                }
            }
            if (!empty($param_file_arr)) {
                foreach ($param_file_arr as $key => $parr) {
                    for ($i = 0; $i < count($parr); $i++) {
                        $val = $parr[$i];
                        $val = array_merge(array(
                            'filename' => '', 'mime' => '', 'postname' => ''),
                            $val);
                        if (empty($val['filename'])) {
                            $file = '';
                        } else {
                            $file = file_get_contents($val['filename']);
                        }
                        $field_arr[] = array(
                            $key, $file, $val['mime'], $val['postname']);
                    }
                }
            }

            if (!empty($field_arr)) {
                $field_raw = static::multipart_build_query($field_arr, static::$form_boundary);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $field_raw);
                static::$header['Content-Type'] = "multipart/form-data; boundary=". static::$form_boundary;
            }
            
            //$url = 'http://mt.takekoubou.net/cgi-bin/mt/mt.cgi';
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        // to set curl response to variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);  // ヘッダーも取得
        // timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, static::CURL_TIMEOUT_CON);
        curl_setopt($ch, CURLOPT_TIMEOUT, static::CURL_TIMEOUT);
        // ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // redirect
        if ($redirect) {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, static::CURL_MAX_REDIRECT);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        }
        // cookie
        curl_setopt($ch, CURLOPT_COOKIEFILE, static::$cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, static::$cookie);
        // referer
        if (isset(static::$referer)) {
            static::$header['Referer'] = static::$referer;
        }
        // other header
        static::$header = array_merge($header, static::$header);
        $header_arr = array();
        foreach(static::$header as $key => $val) {
            $header_arr[] = "$key: $val";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_arr);

        // 返却用
        $result['request'] = array(
            'header' => static::$header,
            'url' => $url,
            //'field' => $field,
            'field' => $field_raw,
        );

if ($method == static::CURL_METHOD_POST) {
//var_dump($result); exit;
}
        // リクエスト実行
        $response = curl_exec($ch);

        // エラー情報
        $result['error'] = array(
            'errno' => curl_errno($ch),
            'error' => curl_error($ch),
        );

        // レスポンス情報取得
        $response_info = curl_getinfo($ch);

        // 解放
        curl_close($ch);

        // 次のリクエストのためにリファラセット
        if ($referer_save) {
            static::$referer = $response_info['url'];
        }
        
        // レスポンスヘッダー取得
        $response_header_raw = substr(
            $response, 0, $response_info['header_size']);
        $response_header = array();
        if (preg_match_all(
                '/([^\r\n]*?): ([^\r\n]*)/',
                $response_header_raw, $matches, PREG_SET_ORDER) === false ||
            !is_array($matches)
        ) {
            Logger:warn(
                "can't parse response header %s", $response_header_raw);
        }
        foreach ($matches as $match) {
            $response_header[$match[1]] = $match[2];
        }

        // レスポンスhtml取得
        $html = substr($response, $response_info['header_size']);

        // htmlパース
        if ($do_parse) {
            $parsed = array();
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xml_raw = $dom->saveXML();
            $xml = simplexml_load_string($xml_raw);
            foreach ($arr['parse'] as $xpath) {
                $e = $xml->xpath($xpath);
                $val = $e[0]->__toString();
                $parsed[$xpath] = $val;
            }
            $result['parsed'] = $parsed;
        }
        if ($do_preg_match) {
            $preg_matched = array();
            foreach ($arr['preg_match'] as $regex) {
                if (preg_match($regex, $html, $match)) {
                    $preg_matched[$regex] = $match[1];
                }
            }
            $result['preg_matched'] = $preg_matched;
        }

        $result['response'] = array(
            'info' => $response_info,
            'header' => $response_header,
            'html' => $html,
            'raw' => $response,
        );
        return $result;
    }

    protected static function get($arr = array()) {
        $arr['method'] = static::CURL_METHOD_GET;
        return static::curl($arr);
    }

    protected static function post($arr = array()) {
        $arr['method'] = static::CURL_METHOD_POST;
        return static::curl($arr);
    }

    protected static function multipart_build_query($field_arr){
        $retval = '';
        $boundary = static::$form_boundary;
        foreach($field_arr as $f){
            if (!isset($f[0])) {
                continue;
            }
            $key = $f[0];
            $val = isset($f[1]) ? $f[1] : "";
            $type = isset($f[2]) ? $f[2] : null;
            $filename = isset($f[3]) ? $f[3] : null;
            if (!isset($filename)) {
                $retval .= "--$boundary\r\nContent-Disposition: form-data; name=\"$key\"\r\n";
            } else {
                $retval .= "--$boundary\r\nContent-Disposition: form-data; name=\"$key\"; filename=\"$filename\"\r\n";
            }
            if (isset($type)) {
                $retval .= "Content-Type: $type\r\n";
            }
            $retval .= "\r\n$val\r\n";
        }
        $retval .= "--$boundary--\r\n";
        return $retval;
    }
}
