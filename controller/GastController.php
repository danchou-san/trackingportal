<?php
include_once "model/GastModel.php";
include_once "controller/ECWController.php";
include_once "controller/KlantController.php";
include_once "controller/VervoerderController.php";
include_once "controller/BeheerderController.php";

class GastController
{
    private $model;
    private $ecw_controller;
    private $klant_controller;
    private $vervoerder_controller;
    private $beheerder_controller;

    public function __construct()
    {
        $this->model = new GastModel();
        $this->ecw_controller = new ECWController("", "");
        $this->klant_controller = new KlantController("", "");
        $this->vervoerder_controller = new VervoerderController("", "");
        $this->beheerder_controller = new BeheerderController("", "");
    }

    public function execute()
    {
        if (isset($_POST["login"]))
        {
            $this->model->getAccount();

            switch ($this->model->getRole())
            {
                case "ECW":
                    $this->ecw_controller->execute($this->model->getEmailAdres(), $this->model->getPassword());
                    break;

                case "Klant":
                    $this->klant_controller->execute($this->model->getEmailAdres(), $this->model->getPassword());
                    break;

                case "Vervoerder":
                    $this->vervoerder_controller->execute($this->model->getEmailAdres(), $this->model->getPassword());
                    break;

                case "Beheerder":
                    $this->beheerder_controller->execute($this->model->getEmailAdres(), $this->model->getPassword());
                    break;

                default:
                    $this->model->getLoginScherm($this->model->getEmailAdres(), $this->model->getPassword());
                    break;
            }
        }
        else
        {
            $this->model->getLoginScherm();
        }
    }
}



?>
