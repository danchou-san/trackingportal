<?php
include "../../model/db.php";
$db = new db();

$rit_query = "SELECT * FROM ritten";

$klant_query = "SELECT * FROM bedrijf_klanten";

$vervoerder_query = "SELECT * FROM bedrijf_vervoerders";

$transport_types_query = "SELECT * FROM transport_types";

$rit_stmt = $db->connect()->query($rit_query);
$klant_stmt = $db->connect()->query($klant_query);
$vervoerder_stmt = $db->connect()->query($vervoerder_query);
$transport_types_stmty = $db->connect()->query($transport_types_query);

?>

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
                        <li><a href="ecwIndex.php">Home</a></li>
                        <li class="active"><a href="beheerTransport.php">Beheer transport</a></li>
                        <li><a href="archief.php">Transport archief</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="ecwProfile.php"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../../index.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center addbelow addklant">
            <h2>Rit toevoegen</h2>
        </div>

        <div class = "container well">
            <form action = "" method = "post">
                <div>
                    <form action="ecw/ecwIndex.php" method = "post">

                        <?php if($_POST != NULL) { ?>
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <strong>Success!</strong> Rit is toegevoegd.
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-default toevoegen-button" onclick = "window.location.href = 'beheerTransport.php'">
                                    Terug naar beheer transport</button>
                            </div>
                        <?php } else { ?>

                        <div class="form-row">
                            <div class="col-md-12"><h3>Klant</h3></div>
                            <div class="col-md-12">
                                <label for="sel1">Klantnummer:</label>
                                <select class="form-control" name="customer_number" id="sel1">
                                    <option value="Onbekend">Onbekend</option>
                                    <?php while($row = $klant_stmt->fetch_assoc()) :?>
                                        <option value="<?=$row['company_name']?>"><?=$row['company_name']?>
                                        </option>
                                    <?php endwhile;?>
                                </select>
                            </div>

                            <div class="col-md-12"></div>

                            <div class="col-md-12"><h3>Vervoering</h3></div>

                            <div class="col-md-6">
                                <label>Vrachtwagen/aanhanger nummer:</label>
                                <input type="text" name="truck_number" class="form-control" placeholder="Vrachtwagen/aanhanger nummer" required>
                            </div>

                            <div class="col-md-6">
                                <label>ECW nummer:</label>
                                <input type="text" name="ecw_number" class="form-control" placeholder="ECW nummer" required>
                            </div>

                            <div class="col-md-6">
                                <label>Vervoerder:</label>
                                <select name="company_name" class="form-control" id="sel1">
                                    <option value="Onbekend">Onbekend</option>
                                    <?php while($row = $vervoerder_stmt->fetch_assoc()) :?>
                                        <option value="<?=$row['company_name']?>"><?=$row['company_name']?>
                                        </option>
                                    <?php endwhile;?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Laad datum:</label>
                                <div class="col-10">
                                    <input class="form-control" name="loading_date" type="date" id="example-date-input">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Transport type:</label>
                                <select class="form-control" name="transport_type" id="sel1">
                                    <?php while($row = $rit_stmt->fetch_assoc()) :?>
                                        <option value="<?=$row['transport_type']?>"><?=$row['transport_type']?>
                                        </option>
                                    <?php endwhile;?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Factuurnummer:</label>
                                <textarea class="form-control" name="invoice_number" rows="6" id="comment" style="resize:none" required></textarea>
                            </div>

                            <div class="col-md-3">
                                <label>Laad plaats:</label>
                                <input type="text" name="loading_place" class="form-control" placeholder="Laad plaats" required>
                            </div>

                            <div class="col-md-3">
                                <label>Aflaad plaats:</label>
                                <input type="text" name="offloading_place" class="form-control" placeholder="Aflaad plaats" required>
                            </div>

                            <div class="col-md-3">
                                <label>Aankomst datum:</label>
                                <div class="col-10">
                                    <input class="form-control" name="arrival_date" type="date" id="example-date-input">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Los datum:</label>
                                <div class="col-10">
                                    <input class="form-control" name="unloading_date" type="date" id="example-date-input">
                                </div>
                            </div>

                            <div class="col-md-12"></div>

                            <div class="form-group text-center col-md-12">
                                <input type="submit" class="btn btn-default toevoegen-button" value="Toevoegen">
                                <button type="button" class="btn btn-default terug-button"
                                        data-toggle="modal" data-target="#myModal">Terug</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
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
                        <button type="button" class="btn toevoegen-button" onclick = "window.location.href = 'beheerTransport.php'">Ja</button>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>

<?php

$customer_number = (isset($_POST['customer_id']) ? $_POST['customer_id'] : null);
$loading_date = (isset($_POST['loading_date']) ? $_POST['loading_date'] : null);
$truck_number = (isset($_POST['truck_number']) ? $_POST['truck_number'] : null);
$transport_type = (isset($_POST['transport_type_id']) ? $_POST['transport_type_id'] : null);
$carrier = (isset($_POST['company_id']) ? $_POST['company_id'] : null);
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
    $db->connect()->query($toevoegen);
}

?>
