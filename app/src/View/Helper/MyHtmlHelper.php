<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;

class MyHtmlHelper extends \Cake\View\Helper\HtmlHelper
{
    public $current_url;

    public function sidebar_link($request = null, $title, $url = null, $option = []) {
        if (!isset($this->current_url)) {
            if (empty($request)) {
                $this->log("empty request", LOG_DEBUG);
                return '';
            }
            $this->current_url = Router::reverse($request, true);
        }

        if ($url === null) {
            $this->log("no set url", LOG_DEBUG);
            return '';
        }

        $url_built = $this->Url->build($url);
        $active = false;
        if (strpos($this->current_url, $url_built)) {
            $active = true;
        }

        if($active) {
            $option['class'] = 'list-group-item active';
        } else {
            $option['class'] = 'list-group-item';
        }
        $link = $this->link($title, $url, $option);

        return $link;
    }
}
