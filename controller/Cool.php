<?php defined("BASEPATH") or exit("No No No");

class Cool extends MainCore{
    public function __construct()
    {
        if (!isset($uiuiui)){
            //die("haha");
        }
    }

    public function index(){
        $data['testnon'] = "Ein Test";
        $data['bla'] = false;
        $data['blaarray'] = array("a","b");
        $this->LoadView("_defaults/_header");
        $this->LoadView("cool/home", $data);
        $this->LoadView("_defaults/_footer");
    }
}