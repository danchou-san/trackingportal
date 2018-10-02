<?php
include_once "view/View.php";

class KlantModel
{
    private $view;
    private $names;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getKlantView()
    {
        $this->view->toonKlantView();
    }
}



?>
