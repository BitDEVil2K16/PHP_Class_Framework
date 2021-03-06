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
const DEBUG = TRUE;
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
InjectClass($page);


