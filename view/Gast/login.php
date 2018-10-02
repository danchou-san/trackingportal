<?php
if(!isset($_SESSION))
{
    session_start();
    $_SESSION['login_tries'] = 0;
}
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Login - ECW Tracking Portal</title>
        <link rel="icon" href="assets/ecwIco2.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            <div class = "header">
                <a class = "logoLink" href = "index.php">
                    <img class = "logo" src = "assets/ECW%20logo.jpg">
                </a>
                <h3 class = "Title">Tracking Portal</h3>
            </div>
        </header>

        <nav class="navbar navbar-default">
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
                    </ul>
                </div>
            </div>
        </nav>

        <div class="login well">
            <h1>Log in</h1>
            <form action="" method = "post">
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="text" class="form-control" name="email_adres" required>
                </div>
                <div class="form-group">
                    <label>Wachtwoord:</label>
                    <input type="password" class="form-control" name="password" required>
                    <?php if(isset($_POST['login'])) { echo "<p class=login-wrong>E-mail of wachtwoord is verkeerd ingevuld.</p>";} ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default toevoegen-button" name="login">Log in</button>
                    <?php if(isset($_POST['login'])){ $_SESSION['login_tries'] += 1;}?>
                </div>
            </form>
        </div>
    </body>
</html>
