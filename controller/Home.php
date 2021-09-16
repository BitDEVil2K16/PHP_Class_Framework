<?php defined("BASEPATH") or exit("No No No");

class Home extends MainCore{
    public function __construct()
    {
        //Check if logged in or something
    }

    public function index(){
        $dataHead['title'] = "Home Start";
        $this->LoadView("_defaults/_header", $dataHead);
        $this->LoadView("home");
        $this->LoadView("_defaults/_footer");
    }
}