<?php
include_once "view/View.php";
include_once "model/db.php";

class GastModel extends db
{
    private $view;
    private $validation;
    private $email_adres;
    private $password;
    private $gebruiker;
    private $stmt;
    private $login_tries;

    public function __construct()
    {
        $this->view = new View();
    }

    public function getLoginScherm()
    {
        $this->view->toonLoginScherm();
    }

    public function getValidation()
    {
        if(isset($_POST["login"]))
        {
            $this->validation = "";
            return $this->validation;
        }
    }

    public function getAccount()
    {
        try
        {
            // $this->gebruiker = "SELECT IF(EXISTS(SELECT * FROM gebruikers WHERE email_adres = :email_adres AND password = :password), 1, 0)";
            $this->gebruiker = "SELECT * FROM gebruikers WHERE email_adres = :email_adres AND password = :password";

            $this->stmt = $this->connect()->prepare($this->gebruiker);

            $this->stmt->bindParam(":email_adres", $this->email_adres, PDO::PARAM_STR);
            $this->stmt->bindParam(":password", $this->password, PDO::PARAM_STR);

            $this->email_adres = $_POST['email_adres'];
            $this->password = $_POST['password'];
            $this->stmt->execute();
        }
        catch (PDOException $e)
        {
            die("ERROR: Could not prepare/execute query: $stmt. " . $e->getMessage());
        }
    }

    public function getRole()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        while($row = $this->stmt->fetch())
        {
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["name_addition"] = $row["name_addition"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["email_adres"] = $row["email_adres"];

            switch ($row["role_id"])
            {
                case 1:
                    $decide_role = "ECW";
                    $_SESSION["logged_in"] = $decide_role;
                    break;

                case 2:
                    $decide_role = "Klant";
                    $_SESSION["logged_in"] = $decide_role;
                    break;

                case 3:
                    $decide_role = "Vervoerder";
                    $_SESSION["logged_in"] = $decide_role;
                    break;

                case 4:
                    $decide_role = "Beheerder";
                    $_SESSION["logged_in"] = $decide_role;
                    break;
            }
            return $decide_role;
        }
    }

    public function getEmailAdres()
    {
        return $this->email_adres;
    }

    public function getPassword()
    {
        return $this->password;
    }
}



?>
