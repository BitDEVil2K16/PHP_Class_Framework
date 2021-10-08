<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: LoadingHelper.php
 *
 */
//error_reporting(E_ALL);
//ini_set('ignore_repeated_errors', TRUE);
//ini_set('display_errors', TRUE);
if (!function_exists('InjectClass')){
    /**
     * @param $class
     */
    function InjectClass($class){
        Global $base;
        $page = str_replace(array(".php", "-"), array("","_"), $class);
        $dta = explode("/", $page);

        $file = fileExists($_SERVER['DOCUMENT_ROOT']. "controller/". $dta[0] .".php", false);
        $_class = str_replace(array($_SERVER['DOCUMENT_ROOT']. "controller/",".php","-"),array("","","_"), $file);

        if (!$file && array_key_exists(1, $dta)){
            $file = fileExists($_SERVER['DOCUMENT_ROOT'] . "controller/".$dta[0]."/".$dta[1].".php",false);
            if ($file){
                $_class = str_replace(array($_SERVER['DOCUMENT_ROOT']."controller/$dta[0]/",".php","-"),array("","","_"),$file);
                array_shift($dta);
            }
        }
        if ($file) {
            include_once($file);
            if (!class_exists($_class, false)) {
                $data['errormessage'] = "Class not Found";
                $data['errorcode'] = 501;
                $base->LoadView("_defaults/_header");
                $base->LoadView("_defaults/_error", $data);
                $base->LoadView("_defaults/_footer");
                exit;
            }

            $app = new $_class;
            if (array_key_exists(1, $dta) && $dta[1] == '') {
                if (method_exists($app, 'index')) {
                    $app->index();
                } else {
                    $data['errormessage'] = "Methode not Found";
                    $data['errorcode'] = 501;
                    $base->LoadView("_defaults/_header");
                    $base->LoadView("_defaults/_error", $data);
                    $base->LoadView("_defaults/_footer");
                }
            } else {
                if (!method_exists($app, 'index')) {
                    $data['errormessage'] = "Index not Found";
                    $data['errorcode'] = 404;
                    $datah['title'] = "404 Error";
                    $ww = new MainCore();
                    $ww->LoadView("_defaults/_header", $datah);
                    $ww->LoadView("_defaults/_error", $data);
                    $ww->LoadView("_defaults/_footer");
                }
                array_shift($dta);
                $fnc = array_key_exists(0, $dta) ? $dta[0] : 'index';

                if (!method_exists($app, $fnc)) {
                    if ($app->$fnc()) {
                    } else {
                        try {
                            $elements = [];
                            foreach ($dta as $element) {
                                $elements[] = $element;
                            }
                            $app->index(...$elements);
                        } catch (Exception $exception) {
                            $datah['title'] = "404 Error";
                            $data['errormessage'] = $exception;
                            $data['errorcode'] = 500;
                            $ww = new MainCore();
                            $ww->LoadView("_defaults/_header", $datah);
                            $ww->LoadView("_defaults/_error", $data);
                            $ww->LoadView("_defaults/_footer");
                        }
                    }
                }
                array_shift($dta);
                $elements = [];
                foreach ($dta as $element) {
                    $elements[] = $element;
                }
                $app->$fnc(...$elements);
            }
        }else{
            if (!class_exists($_class, false)){
                $data['errormessage'] = "Controller not Exist";
                $data['errorcode'] = 501;
                $datah['title'] = "Controller Error";
                $ww = new MainCore();
                $ww->LoadView("_defaults/_header", $datah);
                $ww->LoadView("_defaults/_error", $data);
                $ww->LoadView("_defaults/_footer");
                exit;
            }
            $base->LoadView("_defaults/_header");
            $base->LoadView($page);
            $base->LoadView("_defaults/_footer");
        }
    }
    function &get_instance()
    {
        return MainCore::get_instance();
    }
}

if (!function_exists('fileExists')) {
    /**
     * @param $fileName
     * @param bool $caseSensitive
     * @return false|mixed
     */
    function fileExists($fileName, $caseSensitive = true)
    {

        if (file_exists($fileName)) {
            return $fileName;
        }
        if ($caseSensitive) return false;

        // Handle case insensitive requests
        $directoryName = dirname($fileName);
        $fileArray = glob($directoryName . '/*', GLOB_NOSORT);
        $fileNameLowerCase = strtolower($fileName);
        foreach ($fileArray as $file) {
            if (strtolower($file) == $fileNameLowerCase) {
                return $file;
            }
        }
        return false;
    }
}