<?php
include_once "view/View.php";

class VervoerderModel
{
    private $view;
    private $names;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getVervoerderView()
    {
        $this->view->toonVervoerderView();
    }
}



?>
