<?php
include_once "view/View.php";

class BeheerderModel
{
    private $view;
    private $names;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getECWView()
    {
        $this->view->toonBeheerderView();
    }
}



?>
