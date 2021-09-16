<?php defined("BASEPATH") or die("Scheisse");

if (!function_exists('BaseUrl')) {
    /**
     * @param string $add
     * @return string
     */
    function BaseUrl($add = ""){
        return (string)BASEURL . $add;
    }

}