<?php defined("BASEPATH") or die("Scheisse");

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
                    $base->LoadView("_defaults/_header");
                    $base->LoadView("_defaults/_error", $data);
                    $base->LoadView("_defaults/_footer");
                }
            } else {
                if (!method_exists($app, 'index')) {
                    $data['errormessage'] = "Index not Found";
                    $base->LoadView("_defaults/_header");
                    $base->LoadView("_defaults/_error", $data);
                    $base->LoadView("_defaults/_footer");
                }
                array_shift($dta);
                $fnc = array_key_exists(0, $dta) ? $dta[0] : 'index';
                if (!method_exists($app, fnc)) {
                    if ($app->$fnc()) {

                    } else {
                        try {
                            $elements = [];
                            foreach ($dta as $element) {
                                $elements[] = $element;
                            }
                            switch (count($elements)) {
                                case 1:
                                    $app->index($elements[0]);
                                    break;
                                case 2:
                                    $app->index($elements[0], $elements[0]);
                                    break;
                                case 3:
                                    $app->index($elements[0], $elements[0], $elements[0]);
                                    break;
                                case 4:
                                    $app->index($elements[0], $elements[0], $elements[0], $elements[0]);
                                    break;
                                default:
                                    $app->index();
                                    break;
                            }

                        } catch (Exception $exception) {
                            $data['errormessage'] = "Methode is not Defined";
                            $data['Exception'] = $exception;
                            $base->LoadView("_defaults/_header");
                            $base->LoadView("_defaults/_error", $data);
                            $base->LoadView("_defaults/_footer");
                        }
                    }
                }
                array_shift($dta);
                $elements = [];
                foreach ($dta as $element) {
                    $elements[] = $element;
                }
                switch (count($elements)) {
                    case 1:
                        $app->$fnc($elements[0]);
                        break;
                    case 2:
                        $app->$fnc($elements[0], $elements[0]);
                        break;
                    case 3:
                        $app->$fnc($elements[0], $elements[0], $elements[0]);
                        break;
                    case 4:
                        $app->$fnc($elements[0], $elements[0], $elements[0], $elements[0]);
                        break;
                    default:
                        $app->$fnc();
                        break;
                }
            }
        }else{
            if (!class_exist($_class, false)){
                $data['errormessage'] = "Class not Exist";
                $base->LoadView("_defaults/_header");
                $base->LoadView("_defaults/_error", $data);
                $base->LoadView("_defaults/_footer");
                exit;
            }
            $base->LoadView("_defaults/_header");
            $base->LoadView($page);
            $base->LoadView("_defaults/_footer");
        }
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