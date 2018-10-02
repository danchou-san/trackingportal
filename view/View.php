<?php

class View
{
    public function toonLoginScherm()
    {
        include "Gast/login.php";
    }

    public function toonECWView()
    {
        header("Location: view/ECW/startscherm.php");
        exit();
    }

    public function toonBeheerderView()
    {
        header("Location: view/Beheerder/startscherm.php");
        exit();
    }

    public function toonKlantView()
    {
        header("Location: view/Klant/overzichtritten.php");
        exit();
    }

    public function toonVervoerderView()
    {
        header("Location: view/Vervoerder/overzichtritten.php");
        exit();
    }

    public function toonView()
    {
        include "ECW/startscherm.php";
    }
}



?>
