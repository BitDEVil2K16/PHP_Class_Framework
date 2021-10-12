<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pictures extends MainCore{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $dataHead['title'] = "Pictures Index";
        $this->LoadView("_defaults/_header", $dataHead);
        $this->LoadView("pictures/index");
        $this->LoadView("_defaults/_footer");
    }
}