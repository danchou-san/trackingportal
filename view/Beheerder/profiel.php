<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Rit toevoegen - ECW Tracking Portal</title>
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
                <a class = "logoLink" href = "startscherm.php">
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
                        <li><a href="startscherm.php">Home</a></li>
                        <li><a href="beheerklanten.php">Beheer klanten</a></li>
                        <li><a href="beheervervoerders.php">Beheer vervoerders</a></li>
                        <li><a href="beheergebruikers.php">Beheer gebruikers</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="profiel.php"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../../index.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center addbelow addklant">
            <h2>Profiel</h2>
        </div>

        <div class = "container well">
            <form action="" method="post">
                <div class="col-md-5">
                    <label>Naam:</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Naam" value=<?=$_SESSION['first_name']?> required>
                </div>

                <div class="col-md-2">
                    <label>Toevoeging:</label>
                    <input type="text" name="name_addition" class="form-control" placeholder="Toevoeging" value=<?php if($_SESSION['name_addition'] != ""){ echo $_SESSION['name_addition'];} else { echo ""; } ?>>
                </div>

                <div class="col-md-5">
                    <label>Achternaam:</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Achternaam" value=<?=$_SESSION['last_name']?> required>
                </div>

                <div class="col-md-6">
                    <label>E-mail:</label>
                    <input type="text" name="email" class="form-control" placeholder="E-mail" value=<?=$_SESSION['email_adres']?> required>
                </div>

                <div class="col-md-6">
                    <label>Rol:</label>
                    <input type="text" name="role" class="form-control" placeholder="Achternaam" value="ECW" readonly>
                </div>

                <div class="col-md-6">
                    <label>Wachtwoord:</label>
                    <input type="password" name="password" class="form-control" placeholder="Wachtwoord" required>
                </div>

                <div class="col-md-6">
                    <label>Bevestig wachtwoord:</label>
                    <input type="password" name="password" class="form-control" placeholder="Bevestig wachtwoord" required>
                </div>

                <div class="col-md-12"></div>

                <div class="form-group text-center col-md-12">
                    <input type="submit" class="btn btn-default toevoegen-button" value="Profiel bewerken">
                    <button type="button" class="btn btn-default terug-button" data-toggle="modal" data-target="#myModal">Terug</button>
                </div>
            </form>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header verwijder">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Terug naar beheer transport</h4>
                    </div>
                    <div class="modal-body">
                        <p>Weet u zeker dat u terug wilt?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn terug-button" data-dismiss="modal">Annuleer</button>
                        <button type="button" class="btn toevoegen-button" onclick = "window.location.href = 'beheertransport.php'">Ja</button>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>

<?php

$customer_number = (isset($_POST['customer_number']) ? $_POST['customer_number'] : null);
$loading_date = (isset($_POST['loading_date']) ? $_POST['loading_date'] : null);
$truck_number = (isset($_POST['truck_number']) ? $_POST['truck_number'] : null);
$transport_type = (isset($_POST['transport_type']) ? $_POST['transport_type'] : null);
$carrier = (isset($_POST['company_name']) ? $_POST['company_name'] : null);
$loading_place = (isset($_POST['loading_place']) ? $_POST['loading_place'] : null);
$invoice_number = (isset($_POST['invoice_number']) ? $_POST['invoice_number'] : null);
$ecw_number = (isset($_POST['ecw_number']) ? $_POST['ecw_number'] : null);
$offloading_place = (isset($_POST['offloading_place']) ? $_POST['offloading_place'] : null);
$arrival_date = (isset($_POST['arrival_date']) ? $_POST['arrival_date'] : null);
$unloading_date = (isset($_POST['unloading_date']) ? $_POST['unloading_date'] : null);

$toevoegen = "INSERT INTO `ritten` (`id`, `customer_number`, `loading_date`, `truck_number`, `transport_type`, `carrier`, `loading_place`, `invoice_number`, `ecw_number`, `offloading_place`, `arrival_date`, `unloading_date`)
VALUES (NULL, '$customer_number', '$loading_date', '$truck_number', '$transport_type', '$carrier', '$loading_place', '$invoice_number', '$ecw_number', '$offloading_place', '$arrival_date', '$unloading_date');";

if ($_POST != NULL)
{
    $connection->query($toevoegen);
}

?>
