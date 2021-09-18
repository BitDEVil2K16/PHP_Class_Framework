<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MainCore {
    public function __construct()
    {
        parent::__construct();
        //Check if logged in or something
    }

    public function index(){
        $dataHead['title'] = "Home Start";
        $this->LoadView("_defaults/_header", $dataHead);
        $this->LoadView("home");
        $this->LoadView("_defaults/_footer");
    }
}
