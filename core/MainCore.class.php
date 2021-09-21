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
CacheManager::setDefaultConfig(new Config([
    "path" => sys_get_temp_dir(),
    "itemDetailedDate" => false
]));
$cacheinstance = CacheManager::getInstance('files');
//error_reporting(E_ALL);
//ini_set('ignore_repeated_errors', TRUE);
//ini_set('display_errors', TRUE);
class MainCore extends Extender{
    private static $instance;
    public $db;
    private $load;
    public $config;
    public $cookiemanager;
    public $cache;
    public $logger;

    public function __construct()
    {
        global $cacheinstance;
        self::$instance =& $this;
        include_once (BASEPATH.'system/Common.php');
        foreach(glob("helpers/*.php") as $helper){
            include_once ($helper);
        }
        foreach(glob("classes/*.class.php") as $class){
            include_once ($class);
        }
        /** Settings **/
        if ($this->config){
            $this->config = new Settings();
        }
        if ($this->cookiemanager == null){
            $this->cookiemanager = new Cookie();
            $this->cookiemanager->setDomain(config_item('cookie_domain'));
            $this->cookiemanager->setPath(config_item('cookie_path'));
            $this->cookiemanager->setPrefix(config_item('cookie_prefix'));
            $this->cookiemanager->setSecure(config_item('cookie_secure'));
            $this->cookiemanager->setHttpOnly(config_item('cookie_httponly'));
        }
        if ($this->cache == null){
            $this->cache = $cacheinstance;
        }
        $logLevels = array(
        0 => 'EMERGENCY',
        1 => 'ALERT',
        2 => 'CRITICAL',
        3 => 'ERROR',
        4 => "WARNING",
        5 => 'NOTICE',
        6 => 'INFO',
        7 => 'DEBUG'
        );
        if (defined('LOG') && LOG){
            $logoptions = array (
                'extension' => 'log',
                'dateFormat' => 'd.m.Y H:i:s',
                'prefix' => strtolower($logLevels[(defined('LOGLVL') ? LOGLVL : 7)]).'_'
            );
            $this->logger = new Logger(BASEPATH.'logs',(defined('LOGLVL') ? LOGLVL : 7), $logoptions);
        } else {
            $logoptions = array (
                'extension' => 'log',
                'dateFormat' => 'd.m.Y H:i:s',
                'prefix' => strtolower($logLevels[0]).'_'
            );
            $this->logger = new Logger(BASEPATH.'logs',0,$logoptions);
        }
        $this->db = new Database(config_item('databases')['default']);


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