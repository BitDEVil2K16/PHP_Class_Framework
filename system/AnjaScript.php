<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: AnjaScript.php
 *
 * Special Thanks to Anja as namesake!!
 *
 */
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
        return '<script defer src="https://code.jquery.com/jquery-'.$version.'.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>'.PHP_EOL;
    }

    function jQueryUi($version = '1.12.1', $style = "sunny"): string
    {
        return '<script defer src="https://code.jquery.com/ui/'.$version.'/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>'.PHP_EOL.
            '    <link  rel=stylecheat as=style href="https://code.jquery.com/ui/'.$version.'/themes/'.$style.'/jquery-ui.css" />'.PHP_EOL;
    }
    function higlightjs($version = '11.2.0', $style = "dracula"): string
    {
        return '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/'.$version.'/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/'.$version.'/highlight.min.js"></script>
    <link rel="stylesheet" href="'.BaseUrl('core/css/highligterthemes/'.$style.'.css?v=0.0.1').'" />'.PHP_EOL;
    }

}