<?php
session_start();
include "../../model/db.php";
$db = new db();

$ritten_query = "SELECT * FROM ritten";

$klant_query = "SELECT * FROM bedrijf_klanten";

$vervoerder_query = "SELECT * FROM bedrijf_vervoerders";

$gebruiker_query = "SELECT * FROM gebruikers";

$role_query = "SELECT * FROM roles";

$ritten_stmt = $db->connect()->query($ritten_query);
$klant_stmt = $db->connect()->query($klant_query);
$vervoerder_stmt = $db->connect()->query($vervoerder_query);
$gebruiker_stmt = $db->connect()->query($gebruiker_query);
$role_stmt = $db->connect()->query($role_query);
?>

<?php if($_SESSION["logged_in"] == "Beheerder") {?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Gerbruiker registreren - ECW Tracking Portal</title>
        <link rel="icon" href="../../assets/ecwIco2.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            <div class="container-fluid text-center">
                <a class = "logoLink" href = "beheerderIndex.php">
                    <img class = "logo" src = "../../assets/ECW%20logo.jpg">
                </a>
                <h3 class = "Title">Tracking Portal</h3>
            </div>
        </header>

        <nav class="navbar navbar-default" data-spy="affix" data-offset-top="127">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle navbutton" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="beheerderIndex.php">Home</a></li>
                        <li><a href="beheerKlanten.php">Beheer klanten</a></li>
                        <li><a href="beheerVervoerders.php">Beheer vervoerders</a></li>
                        <li class="active"><a href="beheerGebruikers.php">Beheer gebruikers</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="ecwProfile.php"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../../index.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center addbelow addklant">
            <h2>Gebruiker registreren</h2>
        </div>

        <div class = "container well">
            <form action="" method = "post">
                <div class="form-row">

                    <?php if($_POST != NULL) { ?>
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <strong>Success!</strong> Gebruiker is toegevoegd.
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-default toevoegen-button" onclick = "window.location.href = 'beheerGebruikers.php'">
                                Terug naar beheer gebruikers</button>
                        </div>
                    <?php } else { ?>

                    <div class="col-md-12"><h3>Account</h3></div>

                    <div class="col-md-12">
                        <label>E-mail:</label>
                        <input type="text" name="email" class="form-control" placeholder="E-mail" required>
                    </div>

                    <div class="col-md-5">
                        <label>Wachtwoord:</label>
                        <input type="password" name="password" class="form-control" placeholder="Wachtwoord" required>
                    </div>

                    <div class="col-md-5">
                        <label>Bevestig wachtwoord:</label>
                        <input type="password" name="password2" class="form-control" placeholder="Wachtwoord" required>
                    </div>

                    <div class="col-md-2">
                        <label>Rol:</label>
                        <select id="choice" onchange="showFunction()" class="form-control" name="role">
                            <?php while($role_row = $role_stmt->fetch()) :?>
                                <option value="<?=$role_row['id']?>"><?=$role_row['role']?>
                                </option>
                            <?php endwhile;?>
                        </select>
                    </div>

                    <div id="klant_choice" class="col-md-12" style="display:none;">
                        <label>Klant:</label>
                        <select id="klant_value" class="form-control" name="customer">
                            <?php while($klant_row = $klant_stmt->fetch()) :?>
                                <option value="<?=$klant_row['id']?>"><?=$klant_row['company_name']?>
                                </option>
                            <?php endwhile;?>
                        </select>
                    </div>

                    <div id="vervoerder_choice" class="col-md-12" style="display:none;">
                        <label>Vervoerder:</label>
                        <select id="vervoerder_value" class="form-control" name="carrier">
                            <?php while($vervoerder_row = $vervoerder_stmt->fetch()) :?>
                                <option value="<?=$vervoerder_row['id']?>"><?=$vervoerder_row['company_name']?>
                                </option>
                            <?php endwhile;?>
                        </select>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-12"><h3>Contactpersoon</h3></div>

                    <div class="col-md-5">
                        <label>Naam:</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Naam" required>
                    </div>

                    <div class="col-md-2">
                        <label>Toevoeging:</label>
                        <input type="text" name="name_addition" class="form-control" placeholder="Toevoeging">
                    </div>

                    <div class="col-md-5">
                        <label>Achternaam:</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Achternaam" required>
                    </div>

                    <div class="col-md-12">
                        <label>Telefoonnummer:</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Telefoonnummer" required>
                    </div>

                    <div class="col-md-12"></div>

                    <div class="form-group text-center col-md-12">
                        <input type="submit" class="btn btn-default toevoegen-button" value="Registreer">
                        <button type="button" class="btn btn-default terug-button"
                                data-toggle="modal" data-target="#myModal">Terug</button>
                    </div>
                </div>
                <?php } ?>
            </form>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header verwijder">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Terug naar beheer gebruikers</h4>
                        </div>
                        <div class="modal-body">
                            <p>Weet u zeker dat u terug wilt?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn terug-button" data-dismiss="modal">Annuleer</button>
                            <button type="button" class="btn toevoegen-button" onclick = "window.location.href = 'beheerGebruikers.php'">Ja</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>

</html>

<script>
function showFunction() {
    var x = document.getElementById("choice").value;
    if (x === "2")
    {
    	document.getElementById("klant_choice").style.display = "block";
        document.getElementById("vervoerder_choice").style.display = "none";
        document.getElementById("klant_value").value = "1";
        document.getElementById("vervoerder_value").value = "0";
    }
    else if (x === "3")
    {
    	document.getElementById("vervoerder_choice").style.display = "block";
        document.getElementById("klant_choice").style.display = "none";
        document.getElementById("vervoerder_value").value = "1";
        document.getElementById("klant_value").value = "0";
    }
    else
    {
    	document.getElementById("vervoerder_choice").style.display = "none";
        document.getElementById("klant_choice").style.display = "none";
        document.getElementById("vervoerder_value").value = "0";
        document.getElementById("klant_value").value = "0";
    }

}
</script>

<?php

$email = (isset($_POST['email']) ? $_POST['email'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);
$role = (isset($_POST['role']) ? $_POST['role'] : null);
$first_name = (isset($_POST['first_name']) ? $_POST['first_name'] : null);
$name_addition = (isset($_POST['name_addition']) ? $_POST['name_addition'] : null);
$last_name = (isset($_POST['last_name']) ? $_POST['last_name'] : null);
$phone_number = (isset($_POST['phone_number']) ? $_POST['phone_number'] : null);

if(isset($_POST['customer'])){ $customer = $_POST['customer']; $customer = $customer;} else { $customer = NULL; }
$customer = !empty($customer) ? "'$customer'" : "NULL";
if(isset($_POST['carrier'])){ $carrier = $_POST['carrier']; $carrier = $carrier;} else { $carrier = NULL; }
$carrier = !empty($carrier) ? "'$carrier'" : "NULL";
$name_addition = !empty($name_addition) ? "'$name_addition'" : "NULL";

$toevoegen = "INSERT INTO `gebruikers` (`id`, `email_adres`, `password`, `role_id`, `first_name`, `name_addition`, `last_name`, `phone_number`, `customer_id`, `carrier_id`)
VALUES (NULL, '$email', '$password', '$role', '$first_name', $name_addition, '$last_name', '$phone_number', $customer, $carrier);";

if ($_POST != NULL)
{
    $nu = $db->connect()->query($toevoegen);
}
?>

<?php } else { error_reporting(0); header("Location: ../../error.php");} ?>
