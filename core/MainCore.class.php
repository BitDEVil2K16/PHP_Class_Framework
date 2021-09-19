<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: MainCore.class.php
 *
 */
require BASEPATH.'vendor/autoload.php';
use Phpfastcache\CacheManager;
use Phpfastcache\Config\Config;
use Phpfastcache\Core\phpFastCache;

// Setup File Path on your config files


class MainCore extends Extender{

    private static $instance;
    private $load;
    public $config;
    public $cookiemanager;
    public $cache;

    public function __construct()
    {
        self::$instance =& $this;
        include_once (BASEPATH.'system/Common.php');
        foreach(glob("helpers/*.php") as $helper){
            include_once ($helper);
        }
        foreach(glob("classes/*.class.php") as $class){
            include_once ($class);
        }
        /** Settings **/
        $this->config = new Settings();
        $this->cookiemanager = new Cookie();
        $this->cookiemanager->setDomain(config_item('cookie_domain'));
        $this->cookiemanager->setPath(config_item('cookie_path'));
        $this->cookiemanager->setPrefix(config_item('cookie_prefix'));
        $this->cookiemanager->setSecure(config_item('cookie_secure'));
        $this->cookiemanager->setHttpOnly(config_item('cookie_httponly'));
        CacheManager::setDefaultConfig(new Config([
            "path" => sys_get_temp_dir(),
            "itemDetailedDate" => false
        ]));
        $InstanceCache = CacheManager::getInstance('files');
        $this->cache = $InstanceCache;
        /* Load Function Classes */
        foreach (is_loaded() as $var => $class)
        {
            $this->$var = load_class($class);
        }
        $charset = strtoupper(config_item('charset'));
        ini_set('default_charset', $charset);
    }

    public function LoadView($page, $data = NULL){
        Global $main;

        if (!$data){
            $data = [];
        }
        /* Set User Style */
        //$this->style->SetStyle(config_item('style'));

        $datas['data'] = $data;
        $page = str_replace(array(".php", "-"),"",$page);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "pages/$page.php")){
            if (gettype($datas['data']) != "string"){
                foreach ($datas['data'] as $key => $value){
                    $$key = $value;
                }
            }
            include_once($_SERVER['DOCUMENT_ROOT'] . "pages/$page.php");
        } else {
            //error
            include_once($_SERVER['DOCUMENT_ROOT'] . "pages/_defaults/_error.php");
        }
    }

    public static function &get_instance(){
        return self::$instance;
    }
}

class Extender{
    private $extender=array();

    public function addExtender($obj){
        $this->extender[] = $obj;
    }

    public function __call($name, $arguments)
    {
        foreach ($this->extender as $extender){
            if (method_exists($extender, $name)){
                return call_user_func(array($extender, $name), $arguments);
            }
        }
    }

    public function __get($name)
    {
        foreach ($this->extender as $ext){
            if (property_exists($ext, $name)){
                return $ext->$name;
            }
        }
    }
}