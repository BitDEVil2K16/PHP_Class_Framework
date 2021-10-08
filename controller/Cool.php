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
        $data['testnon'] = "Ein Test";
        $data['bla'] = true;
        $data['blaarray'] = array("a","10min");
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
