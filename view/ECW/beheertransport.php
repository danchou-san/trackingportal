<?php
session_start();
include "../../model/db.php";
$db = new db();

$ritten = "SELECT * FROM ritten";

$stmt = $db->connect()->query($ritten);
?>

<?php if($_SESSION["logged_in"] == "ECW") {?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Beheer transport - ECW Tracking Portal</title>
        <link rel="icon" href="../../assets/ecwIco2.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/style.css">

        <script src="../../assets/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../assets/datatables.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            <div class = "header">
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
                        <li class="active"><a href="beheertransport.php">Beheer transport</a></li>
                        <li><a href="archief.php">Transport archief</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profiel.php"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center addbelow">
            <h1>Beheer transport</h1>
            <a href = "voegRit.php"><button type="button" class="btn btn-lg addbutton">Voeg rit toe</button></a>
            <input class="form-control" id="myInput" type="text" placeholder="Zoeken..">
        </div>

        <div class="container-fluid table-responsive">
            <table id="datatable" class="table table-striped table-condensed table-ritten hover">
                <thead>
                <tr>
                    <th>Klantnummer</th>
                    <th>Laad datum</th>
                    <th>Type transport</th>
                    <th>Vrachtwagen/aanhanger nummer</th>
                    <th>Vervoerder</th>
                    <th>Laad plaats</th>
                    <th>Factuurnummer</th>
                    <th>Ecw nummer</th>
                    <th>Aflaad plaats</th>
                    <th>Bestemmingsdatum</th>
                    <th>Los datum</th>
                    <th class="no-sort"></th>
                </tr>
                </thead>

                <tbody id="myTable">
                <?php while($row = $stmt->fetch()) : ?>
                    <?php
                    $loading_format = new DateTime($row['loading_date']);
                    $arrival_format = new DateTime($row['arrival_date']);
                    $unloading_format = new DateTime($row['unloading_date']);

                    $result_loading = $loading_format->format('d-m-Y');
                    $result_arrival = $arrival_format->format('d-m-Y');
                    $result_unloading = $unloading_format->format('d-m-Y');

                    $customer_id = $row['customer_id'];
                    $transport_type_id = $row['transport_type_id'];
                    $carrier_id = $row['carrier_id'];
                    ?>
                    <tr>
                        <td>
                            <?php
                            $customer_query = "SELECT * FROM bedrijf_klanten WHERE id = $customer_id";
                            $customer_stmt = $db->connect()->query($customer_query);
                            while($customer_row = $customer_stmt->fetch())
                            {
                                if($customer_row['company_name'] && $customer_row['company_name'] != "Onbekend") { echo $customer_row['company_name']; } else { echo "-"; }
                            }
                            ?>
                        </td>
                        <td><?php if($row['loading_date'] != "0000-00-00") { echo $result_loading; } else { echo "-"; }?></td>
                        <td>
                            <?php
                            $transport_query = "SELECT * FROM transport_types WHERE id = $transport_type_id";
                            $transport_stmt = $db->connect()->query($transport_query);
                            while($transport_row = $transport_stmt->fetch())
                            {
                                if($transport_row['transport_type']) { if($transport_row['transport_type'] != "Onbekend") { echo $transport_row['transport_type']; } else { echo "-"; }} else { echo "-"; }
                            }
                            ?>
                        </td>
                        <td><?php if($row['truck_number']) { echo $row['truck_number']; } else { echo "-"; }?></td>
                        <td>
                            <?php
                            $carrier_query = "SELECT * FROM bedrijf_vervoerders WHERE id = $carrier_id";
                            $carrier_stmt = $db->connect()->query($carrier_query);
                            while($carrier_row = $carrier_stmt->fetch())
                            {
                                if($carrier_row['company_name'] && $carrier_row['company_name'] != "Onbekend") { echo $carrier_row['company_name']; } else { echo "-"; }
                            }
                            ?>
                        </td>
                        <td><?php if($row['loading_place']) { echo $row['loading_place']; } else { echo "-"; }?></td>
                        <td><?php if($row['invoice_number']) { echo $row['invoice_number']; } else { echo "-"; }?></td>
                        <td><?php if($row['ecw_number']) { echo $row['ecw_number']; } else { echo "-"; }?></td>
                        <td><?php if($row['offloading_place']) { echo $row['offloading_place']; } else { echo "-"; }?></td>
                        <td><?php if($row['arrival_date'] != "0000-00-00") { echo $result_arrival; } else { echo "-"; }?></td>
                        <td><?php if($row['unloading_date'] != "0000-00-00") { echo $result_unloading; } else { echo "-"; }?></td>
                        <td>
                            <div class="btn-group-xs">
                                <a href="naararchief.php?id=<?=$row['id']?>" class="btn checker" data-toggle="tooltip" title="Rit archiveren"
                                   onclick = "return confirm('<?php if($row["customer_number"] && $row["customer_number"] != "Onbekend") { echo "Rit van klantnummer ".$row["customer_number"]." archiveren?"; } else { echo "Deze rit archiveren?"; }?>')">
                                    <img class = "Pencil button" src="../../assets/checker.png"></a>
                                <a href="wijzigRit.php?id=<?=$row['id']?>" class="btn pencil" data-toggle="tooltip" title="Rit wijzigen">
                                    <img class = "Pencil button" src="../../assets/pencil.png">
                                </a>
                                <a href="deleteRit.php?del=<?=$row['id']?>"
                                   onclick = "return confirm('<?php if($row["customer_number"] && $row["customer_number"] != "Onbekend") { echo "Rit van klantnummer ".$row["customer_number"]." verwijderen?"; } else { echo "Deze rit verwijderen?"; }?>')"
                                   class="btn cross" data-toggle="tooltip" title="Rit verwijderen"><img class = "Cross button" src="../../assets/cross.png"></a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

<?php } else { error_reporting(0); header("Location: ../../error.php");} ?>
