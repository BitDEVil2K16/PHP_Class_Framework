<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AnjaScript{
    private $_test = "Nice";
    public $test;

    function __construct()
    {
        $this->test = $this->_test;
    }

    function Init(){

    }

    /**
     * @param string $version
     * @return string
     */
    function jQuery($version = '3.6.0'): string
    {
        return '<script src="https://code.jquery.com/jquery-'.$version.'.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>'.PHP_EOL;
    }

    function jQueryUi($version = '1.12.1', $style = "sunny"): string
    {
        return '<script src="https://code.jquery.com/ui/'.$version.'/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>'.PHP_EOL.
               '    <link rel="stylesheet" href="https://code.jquery.com/ui/'.$version.'/themes/'.$style.'/jquery-ui.css" />'.PHP_EOL;
    }

}