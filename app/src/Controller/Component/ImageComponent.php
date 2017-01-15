<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class ImageComponent extends Component
{
    public function trim($file_path, $s_file_path, $s_width, $s_height, &$mime) {
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
}
