<?php session_start(); ?>
<?php if($_SESSION["logged_in"] == "ECW") {?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Index - ECW Tracking Portal</title>
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
                <a class = "logoLink" href = "startscherm.php">
                    <img class = "logo" src = "../../assets/ECW%20logo.jpg">
                </a>
                <h3 class = "Title">Tracking Portal</h3>
            </div>
        </header>

        <nav class="navbar navbar-default"  data-spy="affix" data-offset-top="127">
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
                        <li class="active"><a href="">Home</a></li>
                        <li><a href="beheertransport.php">Beheer transport</a></li>
                        <li><a href="archief.php">Transport archief</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="profiel.php"><span class="glyphicon glyphicon-user"></span> Profiel</a></li>
                        <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container text-center">
            <h1>Welkom, <?=$_SESSION["first_name"]?><?php if($_SESSION["name_addition"]){ echo " ".$_SESSION["name_addition"]." ";}else{echo " ";}?><?=$_SESSION["last_name"]?>!</h1>
            <h4>Klik op een van de knoppen op de navigatiebar</h4>
        </div>
    </body>
</html>

<?php } else { error_reporting(0); header("Location: ../../error.php");} ?>
