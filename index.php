<?php
const DEBUG = false; // ToDo
const BASEPATH = __DIR__ . '/';
const BASEURL = 'https://dev.bitdevil2k16.club/';

$page = @$_GET['p'];
$page = preg_replace('/\\.[^.\\s]{3,4}$/', '', $page);

if (empty($page)) $page = "home";

foreach(glob("core/*.class.php") as $class){
    include_once($class);
}

$base = new MainCore();
$main &= $base->get_instance();

InjectClass($page);


