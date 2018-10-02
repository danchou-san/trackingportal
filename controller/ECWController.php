<?php
include_once "model/ECWModel.php";

class ECWController
{
    private $model;
    private $email_adres;
    private $password;

    public function __construct($email_adres, $password)
    {
        $this->model = new ECWModel();
        $this->email_adres = $email_adres;
        $this->password = $password;
    }

    public function execute()
    {
        $this->model->getECWView();
    }
}



?>
