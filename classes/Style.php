<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Style{
    public $Style;
    public $Version = "1.0.0";

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
        if (get_instance()->cookiemanager->get('style')){
            return get_instance()->cookiemanager->get('style');
        } else {
            return config_item('style');
        }
    }
}