<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('BaseUrl')) {
    /**
     * @param string $add
     * @return string
     */
    function BaseUrl($add = ""){
        return (string)BASEURL . $add;
    }

}
