<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="wrapper">
        <section class="sidebar">
            <h2>Sky Cloud</h2>
            <ul>
                <li><a href="welcome.php"><i class="fa fa-home"></i>Startseite</a></li>
                <li><a href="../FileUpload/index.php"><i class="fa fa-cloud-upload"></i>Datei Hochladen</a></li>
                <li><a href="../FileUpload/userFile.php"><i class="fa fa-folder"></i>Meine Dateien</a></li>
            </ul>
        </section>
        <section class="main">
            <section class="navbar">
                 <p>
                    <input type="button" onclick="location.href='reset-password.php';" value="Passwort ändern" class="btn reset">
                    <input type="button" onclick="location.href='logout.php';" value="Abmelden" class="btn logout">
                </p>
                <div class="clearfix"></div>
            </section>
            <div class="clearfix"></div>
            <section class="main_content">
                <h1 class="willkommen">Hallo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></h1> 
                    <h1>Willkommen zu Sky Cloud</h1>
            </section>
        </section>
    </section>
</body>
</html>