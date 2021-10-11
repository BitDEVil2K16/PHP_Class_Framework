<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: Style.php
 *
 */
class Style{
    public $Style;
    public $Version = "1.0.4";

    public function __construct()
    {
        $this->Style = $this->_GetStyle();
    }
    function SetStyle($style){
        get_instance()->cookiemanager->setName('style');
        get_instance()->cookiemanager->setValue($style);
        get_instance()->cookiemanager->setTime("+365 days");
        get_instance()->cookiemanager->create();
        $this->Style = get_instance()->cookiemanager->get('style');
    }
    private function _GetStyle(): string
    {
        if (config_item('bootstrap')){
            $_style = config_item('bootstrap-style');
            if (get_instance()->cookiemanager->get('style')){
                if (get_instance()->cookiemanager->get('style') != $_style){
                    $this->SetStyle($_style);
                    return "bootstrap/".$_style;
                }
                return "bootstrap/".get_instance()->cookiemanager->get('style');
            } else {
                return "bootstrap/".config_item('bootstrap-style');
            }
        } else {
            if (get_instance()->cookiemanager->get('style')){
                if (get_instance()->cookiemanager->get('style') != config_item('style')){
                    $this->SetStyle(config_item('style'));
                    return "public/".config_item('style');
                }
                return "public/".get_instance()->cookiemanager->get('style');
            } else {
                return "public/".config_item('style');
            }
        }

    }
}