<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('create_thumb')) {
    /**
     * @param $src
     * @param $dest
     * @param $newwidth
     */
    function create_thumb($src, $dest, $newwidth) {
        $info = getimagesize($src);
        $source_image = imagecreatefromjpeg($src);
        switch($info['mime']){
            case "image/webp":
                $source_image = imagecreatefromwebp($src);
                break;
            case "image/png":
                $source_image = imagecreatefrompng($src);
                break;
            case "image/gif":
                $source_image = imagecreatefromgif($src);
                break;
            case "image/jpg":
            case "image/jpeg":
                $source_image = imagecreatefromjpeg($src);
                break;
        }
        $width = imagesx($source_image);
        $height = imagesy($source_image);
        $desired_height = floor($height * ($newwidth / $width));
        $virtual_image = imagecreatetruecolor($newwidth, $desired_height);
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $newwidth, $desired_height, $width, $height);
        imagejpeg($virtual_image, $dest);
    }
}
