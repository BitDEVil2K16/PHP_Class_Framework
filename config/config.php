<?php defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

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

