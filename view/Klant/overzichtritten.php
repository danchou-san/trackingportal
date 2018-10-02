<?php
include "../../assets/include.php";
require "../../assets/dbInfo.php";

$query = "SELECT * FROM ritten";
$klant = "SELECT * FROM klanten";

$resultObj = $connection->query($query);
$klantObj = $connection->query($klant);
$counter = 0;
$counters = 0;
$countersi = 0;
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Overzicht transport - ECW Tracking Portal</title>
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
                        <li class="active"><a href="overzichtKlant.php">Overzicht transport</a></li>
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
                <table id="mappie" class="table">
                    <thead>
                    <tr>
                        <th>Klantnummer</th>
                        <th>Factuurnummer</th>
                        <th>Laatste positie</th>
                        <th>Aflaad plaats</th>
                        <th>Datum laatste positie</th>
                    </tr>
                    </thead>

					<?php while ($row = $resultObj->fetch_assoc()) : ?>
						<?php
                        $counter++;
                        $loadingFormat = new DateTime($row['loading_date']);
                        $arrivalFormat = new DateTime($row['arrival_date']);
                        $unloadingFormat = new DateTime($row['unloading_date']);
                        $lastFormat = new DateTime($row['last_date']);
                        $resultLoading = $loadingFormat->format('d-m-Y');
                        $resultArrival = $arrivalFormat->format('d-m-Y');
                        $resultUnloading = $unloadingFormat->format('d-m-Y');
                        $resultLast = $lastFormat->format('d-m-Y');
                        $name = $klantObj->fetch_assoc();
                        ?>
                    <tbody id="myTable<?php echo $counter?>">
                        <tr id="noColor" data-toggle="collapse" data-target="#demo<?=$counter?>" class="accordion-toggle Other id-tr" title="Klik hier voor de kaart">
                            <td><?php if($row['customer_number'] && $row['customer_number'] != "Onbekend") { echo $row['customer_number']; } else { echo "-"; }?></td>
                            <td><?php if($row['truck_number']) { echo $row['truck_number']; } else { echo "-"; }?></td>
                            <td><?php if($row['last_position']) { echo $row['last_position']; } else { echo "-"; }?></td>
                            <td><?php if($row['offloading_place']) { echo $row['offloading_place']; } else { echo "-"; }?></td>
                            <td><?php if($row['last_date'] != "0000-00-00") { echo $resultLast; } else { echo "-"; }?></td>
                        </tr>

                        <tr class="id-tr">
                            <td colspan="5" class="hiddenRow">
                                <div class="accordian-body collapse" id="demo<?=$counter?>">
									<div id="googleMap<?=$counter?>" style="width:100%;height:400px;"></div>
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
                                            <p><?php if($row['last_position'] && $row['last_position'] != "Onbekend") { echo $row['last_position']; } else { echo "-"; }?></p>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Datum laatste positie:</label>
                                            <p><?php if($row['last_date'] != "0000-00-00") { echo $resultLast; } else { echo "-"; }?></p>
                                        </div>
                                    </div>

                                </div>
                                </div>
                            </td>
                  			</tr>
                    </tbody>
				<?php endwhile ?>
                </table>
            </div>
        </div>
    </body>

		<script>

		var geocoder;
		var map;

		function initialize() {

				geocoder = new google.maps.Geocoder();

				var latlng = new google.maps.LatLng(51.851771, 4.509714);
				var mapOptions = {
						zoom: 8,
						center: latlng
				};

				<?php for($a = 1; $a <= $counter; $a++) { ?>
				<?php $name = $resultObj->fetch_assoc();?>
				map<?=$a?> = new google.maps.Map(document.getElementById("googleMap<?=$a?>"), mapOptions);

				// Call the codeAddress function (once) when the map is idle (ready)
				google.maps.event.addListenerOnce(map<?=$a?>, 'idle', codeAddress);
			<?php } ?>
		}

		function codeAddress() {
			<?php $resultObj = $connection->query($query); ?>
				<?php while ($row = $resultObj->fetch_assoc()) : ?>
				<?php $counters++;?>
					var address<?=$counters?> = '<?php echo $row["last_position"];?>, EU';

				geocoder.geocode({
						'address': address<?=$counters?>
				}, function (results, status) {

    				if (status == google.maps.GeocoderStatus.OK) {
						map<?=$counters?>.setCenter(results[0].geometry.location);

						var cityCircle = new google.maps.Circle({
					      strokeColor: '#0390DF',
					      strokeOpacity: 0.8,
					      strokeWeight: 2,
					      fillColor: '#0390DF',
					      fillOpacity: 0.05,
					      map: map<?=$counters?>,
					      center: results[0].geometry.location,
					      radius: 180 * 100
					    });
                        cityCircle.setMap(map<?=$counters?>);
    				}
				});
				<?php endwhile; ?>
		}

		initialize();
		</script>

    <script>
	<?php $resultObj = $connection->query($query); ?>
		<?php while ($row = $resultObj->fetch_assoc()) : ?>
		<?php $countersi++;?>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable<?=$countersi?>").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
		<?php endwhile; ?>

        $(document).ready(function(){
            $('[data-toggle="collapse"]').tooltip({title: "Test", delay: {show: 500, hide: 100}});
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2AJqkMwBOhQAjTs5ZJY_udc4cLaTcqaA&callback=initialize"></script>
</html>
