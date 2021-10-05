<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: config.php
 *
 */
ob_start();
const LOG = TRUE;
/*
1 => ALERT
2 => CRITICAL
3 => ERROR
4 => WARNING
5 => NOTICE
6 => INFO
7 => DEBUG
*/
const LOGLVL = 7;
$url = (isset($_SERVER['HTTPS']) ? "https://" : "http://");
$url .= $_SERVER['HTTP_HOST']. str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['base_url'] = $url;
$config['language']	= 'ger';
$config['charset'] = 'UTF-8';
$config['style'] = 'dark';
$config['timezone'] = 'Europe/Berlin';
$config['timeformat'] = 'd.m.Y h:i:s';

$config['cookie_prefix']	= 'bit';
$config['cookie_domain']	= 'dev.bitdevil2k16.club';
$config['cookie_path']		= '/';
$config['cookie_secure']	= true;
$config['cookie_httponly'] 	= true;

$config['databases'] = [
    'default' => [
        'hostname' => 'localhost',
        'username' => 'TestUser',
        'password' => 'l6b23Id8vALu4iFO5oSELEwiMiQate',
        'database' => 'OpenSourceProject',
        'charset' => 'utf8mb4'
    ],
    'meinproject' => [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'Ultr4Str0nGP4ssw0rd',
        'database' => 'MeinProject',
        'charset' => 'utf8mb4'
    ]
];

