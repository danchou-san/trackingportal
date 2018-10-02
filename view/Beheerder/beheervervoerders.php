<?php
session_start();
include "../../model/db.php";
$db = new db();

$vervoerder_query = "SELECT * FROM bedrijf_vervoerders";

$vervoerder_stmt = $db->connect()->query($vervoerder_query);
?>
<?php if($_SESSION["logged_in"] == "Beheerder") {?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Beheer vervoerders - ECW Tracking Portal</title>
        <link rel="icon" href="../../assets/ecwIco2.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="../../assets/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/style.css">

		<script>
			$(document).ready(function() {
				$('#datatable').DataTable( {
					 "searching": false,
					 "paging": true,
					 "info": false,
					 "lengthChange":false,
					 "columnDefs": [ {
				         "targets": 'no-sort',
				         "orderable": false,
 			    	} ]
				} );
			} );
		</script>
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
                        <li><a href="beheerklanten.php">Beheer klanten</a></li>
                        <li class="active"><a href="beheervervoerders.php">Beheer vervoerders</a></li>
                        <li><a href="beheergebruikers.php">Beheer gebruikers</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profiel.php"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center addbelow">
            <h1>Beheer vervoerders</h1>
            <a href = "voegvervoerder.php"><button type="button" class="btn btn-lg addbutton">Voeg vervoerder toe</button></a>
            <input class="form-control" id="myInput" type="text" placeholder="Zoeken..">
        </div>

        <div class="container table-responsive">
                <table id="datatable" class="table table-striped table-condensed hover">
                    <thead>
                    <tr>
                        <th>Bedrijfsnaam</th>
                        <th>Contactpersoon</th>
                        <th class="no-sort"></th>
                    </tr>
                    </thead>

                    <tbody id="myTable">
	                    <?php while($row = $vervoerder_stmt->fetch()) : ?>
                            <?php
                            $contact_id = $row['contact_id'];
                            $contact_query = "SELECT * FROM contact_vervoerders WHERE id = $contact_id";
                            $contact_stmt = $db->connect()->query($contact_query);
                            while($contact_row = $contact_stmt->fetch()) :
                            ?>
	                        <tr>
	                            <td><?php if($row['company_name']) { echo $row['company_name']; } else { echo "-"; }?></td>
	                            <td><?php if($contact_row['first_name'] || $contact_row['name_addition'] || $contact_row['last_name']) { echo $contact_row['first_name']." ".$contact_row['name_addition']." ".$contact_row['last_name']; } else { echo "-"; }?></td>
	                            <td>
                                    <div class="btn-group-xs">
	                                    <a href="wijzigVervoerder.php?id=<?=$row['id']?>&company_name=<?=$row['company_name']?>&first_name=<?=$row['first_name']?>&name_addition=<?=$row['name_addition']?>&last_name=<?=$row['last_name']?>&customer_email=<?=$row['customer_email']?>&phone_number=<?=$row['phone_number']?>" class="btn pencil" data-toggle="tooltip" title="Vervoerder wijzigen"><img class = "Pencil button" src="../../assets/pencil.png"></a>
	                                    <a href="deleteVervoerder.php?del=<?=$row['id']?>"
	                                       onclick = "return confirm('<?php if($row["company_name"]) { echo "Rij van ".$row["company_name"]." verwijderen?"; } else { echo "Deze vervoerder verwijderen?"; }?>')"
	                                       class="btn cross" data-toggle="tooltip" title="Vervoerder verwijderen"><img class = "Cross button" src="../../assets/cross.png"></a>
	                                </div>
	                            </td>
	                        </tr>
                            <?php endwhile; ?>
	                    <?php endwhile; ?>
                    </tbody>
                </table>
        </div>

        <script>
            $(document).ready(function(){
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>
<?php } else { error_reporting(0); header("Location: ../../error.php");} ?>
