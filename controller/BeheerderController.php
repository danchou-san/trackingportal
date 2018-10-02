<?php
include_once "model/BeheerderModel.php";

class BeheerderController
{
    private $model;

    public function __construct()
    {
        $this->model = new BeheerderModel();
    }

    public function execute()
    {
        $this->model->getECWView();
    }
}



?>
