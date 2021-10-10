<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cool extends MainCore{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(string $argone = "0", string $argtwo = 'animation'){
        $data['bla'] = true;
        $data['testnon'] = "Das ist ein Toller Test, Bruder das fühl ich 12 von 10 son Ding ist das!";
        $data['blaarray'] = array("a","10min","0000");
        if (is_numeric($argone)){
            if ($argone != 0){
                $data['flagarg'] = $argone;
            } else {
                $argone = 49;
            }
        }
        $data['flagtypearg'] = $argtwo;
        $dataheader['title'] = "Coole Tests";
        $dataheader['description'] = "Coole Tests und so weiter,\nteste es selbst und ändere die werte.\nFlagvariable: ".ucfirst($argtwo). " Flag: " . $argone; //Kurzbeschreibung der Website Empfehlung 300 Zeichen
        $dataheader['metatags'] = "HTML, CSS, JavaScript, PHP, Template, Test, Cool";
        $dataheader['ogimage'] = BaseURL("images/logo.jpg");
        $dataheader['ogimage'] = "";
        $this->LoadView("_defaults/_header", $dataheader);
        $this->LoadView("cool/home", $data);
        $this->LoadView("_defaults/_footer");
    }
}
