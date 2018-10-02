<?php
include_once "view/View.php";
include_once "Rit.php";

class ECWModel extends db
{
    private $view;
    private $rit;
    private $transport_type_id;

    public function __construct()
    {
        $this->view = new View();
        $this->rit = new Rit();
    }

    public function getECWView()
    {
        $this->view->toonECWView();
    }
}

?>
