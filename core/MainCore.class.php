<?php defined("BASEPATH") or die("Nope");

class MainCore extends Extender{
    private static $instance;

    public function __construct()
    {
        self::$instance =& $this;
        foreach(glob("helpers/*.php") as $helper){
            include_once ($helper);
        }
    }

    public function LoadView($page, $data = NULL){
        Global $main;

        if (!$data){
            $data = [];
        }
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


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
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