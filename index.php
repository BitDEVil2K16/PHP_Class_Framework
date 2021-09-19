<?php
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: index.php
 *
 */
const DEBUG = true;
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

load_class('AnjaScript', 'system');
load_class('CCPlus', 'system');
load_class('Style', 'system');

InjectClass($page);


