<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cool extends MainCore{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(string $argone = "0", string $argtwo = 'animation'){
        $dataheader['title'] = "Coole Tests";
        $dataheader['description'] = "Coole Tests und so weiter";
        $dataheader['metatags'] = "tests cool bitdevil2k16 club";
        $data['bla'] = false;
        $data['testnon'] = "Das ist ein Toller Test, Bruder das fühl ich 12 von 10 son Ding ist das!";
        $data['blaarray'] = array("a","10min","0000");
        if (is_numeric($argone)){
            if ($argone != 0){
                $data['flagarg'] = $argone;
            }
        }
        $data['flagtypearg'] = $argtwo;
        $this->LoadView("_defaults/_header", $dataheader);
        $this->LoadView("cool/home", $data);
        $this->LoadView("_defaults/_footer");
    }
}
