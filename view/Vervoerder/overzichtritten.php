<?php
	include "../../assets/include.php";
	require "../../assets/dbInfo.php";

	$query = "SELECT * FROM ritten";
	$klant = "SELECT * FROM klanten";

	$resultObj = $connection->query($query);
	$klantObj = $connection->query($klant);

	$counter = 0;
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Overzicht transport - ECW Tracking Portal</title>
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
            <div class = "header">
                <a class = "logoLink" href = "index.php">
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
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="overzichtVervoerder.php">Overzicht transport</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center addbelow">
            <h1>Overzicht transport</h1>
            <input class="form-control" id="myInput" type="text" placeholder="Zoeken..">
        </div>

        <div class="container">
            <div class="table-responsive">
                <table id="mappie" class="table table-striped">
                    <thead>
	                    <tr>
	                        <th>Klantnummer</th>
	                        <th>Factuurnummer</th>
	                        <th>Laatste positie</th>
	                        <th>Aflaad plaats</th>
	                        <th>Datum laatste positie</th>
	                    </tr>
                    </thead>

                    <tbody id="myTable">
						<?php while ($row = $resultObj->fetch_assoc()) : ?>
                        <?php
	                        $counter++;
	                        $loadingFormat = new DateTime($row['loading_date']);
	                        $arrivalFormat = new DateTime($row['arrival_date']);
	                        $unloadingFormat = new DateTime($row['unloading_date']);
	                        $resultLoading = $loadingFormat->format('d-m-Y');
	                        $resultArrival = $arrivalFormat->format('d-m-Y');
	                        $resultUnloading = $unloadingFormat->format('d-m-Y');
	                        $name = $klantObj->fetch_assoc();
                        ?>

						<tr id="noColor" data-toggle="collapse" data-target="#demo<?=$counter?>" class="accordion-toggle Other" title="Klik hier voor de kaart">
						  <td><?php if($row['customer_number'] && $row['customer_number'] != "Onbekend") { echo $row['customer_number']; } else { echo "-"; }?></td>
						  <td><?php if($row['truck_number']) { echo $row['truck_number']; } else { echo "-"; }?></td>
						  <td><?php if($row['offloading_place']) { echo $row['offloading_place']; } else { echo "-"; }?></td>
						  <td><?php if($row['offloading_place']) { echo $row['offloading_place']; } else { echo "-"; }?></td>
						  <td><?php if($row['unloading_date'] != "0000-00-00") { echo $resultUnloading; } else { echo "-"; }?></td>
						</tr>

                        <tr>
                            <td colspan="5" class="hiddenRow">
                                <div class="accordian-body collapse" id="demo<?=$counter?>">

                                    <div class="container-fluid well well-sm wellosa">
                                        <h3 class="text-center information">Laatste positie</h3>
                                        <div class="col-md-6">
                                            <label>Laatste positie:</label>
                                            <div class="col-10">
                                                <input id="map-position<?=$counter?>" type="text" name="offloading_place" class="form-control" placeholder="Laatste positie" value="Rotterdam, NL">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Datum laatste positie:</label>
                                            <div class="col-10">
                                                <input class="form-control" name="unloading_date" type="date" id="example-date-input">
                                            </div>
                                        </div>

                                        <div class="col-md-12"></div>

                                        <div class="form-group text-center col-md-12">
                                            <input id="submit-map<?=$counter?>" type="submit" class="btn btn-default toevoegen-button" value="Laatste positie bijwerken">
                                        </div>
                                    </div>

                                    <div id="googleMap<?=$counter?>" style="width:100%;height:400px;"></div>
                              	</div>

                                    <div class="text-left container-fluid well well-sm wello">
                                        <div>
                                            <h3 class="text-center information">Rit informatie</h3>

                                            <div class="col-md-3">
                                                <label>Factuurnummer:</label>
                                                <p><?php if($row['invoice_number'] && $row['invoice_number'] != "Onbekend") { echo $row['invoice_number']; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Vrachtwagen/aanhanger nummer:</label>
                                                <p><?php if($row['truck_number'] && $row['truck_number'] != "Onbekend") { echo $row['truck_number']; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Laad datum:</label>
                                                <p><?php if($row['loading_date'] != "0000-00-00") { echo $resultLoading; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Laad plaats:</label>
                                                <p><?php if($row['loading_place'] && $row['loading_place'] != "Onbekend") { echo $row['loading_place']; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>ECW-nummer:</label>
                                                <p><?php if($row['ecw_number'] && $row['ecw_number'] != "Onbekend") { echo $row['ecw_number']; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Aflaad plaats:</label>
                                                <p><?php if($row['offloading_place'] && $row['offloading_place'] != "Onbekend") { echo $row['offloading_place']; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Bestemmingsdatum:</label>
                                                <p><?php if($row['arrival_date'] != "0000-00-00") { echo $resultArrival; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Los datum:</label>
                                                <p><?php if($row['unloading_date'] != "0000-00-00") { echo $resultUnloading; } else { echo "-"; }?></p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Laatste positie:</label>
                                                <p>Klaipeda</p>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Datum laatste positie:</label>
                                                <p>04-06-2014</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <script>
		<?php for ($b=1; $b <= $counter; $b++) { ?>
			function initMap() {
			    var map<?=$b?> = new google.maps.Map(document.getElementById('googleMap<?=$b?>'), {
			      zoom: 8,
			      center: {lat: -34.397, lng: 150.644}
			    });
			    var geocoder<?=$b?> = new google.maps.Geocoder();

			    document.getElementById('submit-map<?=$b?>').addEventListener('click', function() {
					geocodeAddress(geocoder<?=$b?>, map<?=$b?>);
			    });
			}

			function geocodeAddress(geocoder<?=$b?>, resultsMap<?=$b?>) {
				var address<?=$b?> = document.getElementById('map-position<?=$b?>').value;

				geocoder<?=$counter?>.geocode({'address': address<?=$b?>}, function(results, status) {
					if (status === 'OK') {
						resultsMap.setCenter(results[0].geometry.location);

						var marker<?=$b?> = new google.maps.Marker({
						  map: resultsMap<?=$counter?>,
						  position: results[0].geometry.location
						});
					}
					else {
						alert('Geocode was not successful for the following reason: ' + status);
			  		}
				});
			}
		<?php } ?>
  	</script>

  	<script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
	</script>

	<script>
        $(document).ready(function(){
            $('[data-toggle="collapse"]').tooltip({title: "Test", delay: {show: 500, hide: 100}});
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2AJqkMwBOhQAjTs5ZJY_udc4cLaTcqaA&callback=myMap"></script>
</html>
