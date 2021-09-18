<?php
const DEBUG = false;
const BASEPATH = __DIR__ . '/';
const APPPATH = __FILE__ ;
const BASEURL = 'https://dev.bitdevil2k16.club/';
const ENVIRONMENT = 'development';

$page = @$_GET['p'];
$page = preg_replace('/\\.[^.\\s]{3,4}$/', '', $page);

if (empty($page)) $page = "home";

foreach(glob("core/*.class.php") as $class){
    include_once($class);
}
if (defined(DEBUG) && DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

$base = new MainCore();
$main =& $base->get_instance();

load_class('AnjaScript', 'classes');
load_class('CCPlus', 'classes');
load_class('Style', 'classes');

InjectClass($page);


