<?php
include_once "model/VervoerderModel.php";

class VervoerderController
{
    private $model;

    public function __construct()
    {
        $this->model = new VervoerderModel();
    }

    public function execute()
    {
        $this->model->getVervoerderView();
    }
}



?>
