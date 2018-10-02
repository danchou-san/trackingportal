<?php
include_once "model/KlantModel.php";

class KlantController
{
    private $model;

    public function __construct()
    {
        $this->model = new KlantModel();
    }

    public function execute()
    {
        $this->model->getKlantView();
    }
}



?>
