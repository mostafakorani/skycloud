<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../phplogin/login.php");
    exit;
}

$file_user = $_SESSION["username"];

include 'config.php';

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="styleUserFile.css">

    <title>File Upload PHP Script - Pure Coding</title>
</head>
<body>
    <section class="wrapper">
        <section class="sidebar">
            <h2>Sky Cloud</h2>
            <ul>
                <li><a href="../phplogin/welcome.php"><i class="fa fa-home"></i>Startseite</a></li>
                <li><a href="index.php"><i class="fa fa-cloud-upload"></i>Datei Hochladen</a></li>
                <li><a href="userFile.php"><i class="fa fa-folder"></i>Meine Dateien</a></li>
            </ul>
        </section>
        <section class="main">            
            <section class="user_content">
                <table>
                    <tr>
                        <td>Datei ID</td> 
                        <td>Datei Name</td>
                        <td>Datei Größe (in MB)</td>
                        <td>Hochgeladen am</td>
						<td>Link</td> 
                        <td>Herunterladen</td>
                        <td>Löschen</td>  
                    </tr>
                    <?php

                    $records = mysqli_query($conn,"select * from uploaded_files where username='$file_user'");
                    while($data = mysqli_fetch_array($records)){
                        ?>
                      <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['file_size']; ?></td>  
						<td><?php echo $data['upload_date']; ?></td>  	
	<td><?php echo $data['link']; ?></td>  						
                        <td><a class="down" href="../uploads/<?php echo $data['new_name']; ?>" download="<?php echo $data['name']; ?>">Herunterladen</a></td>
                        <td><a class="delete" href="delete.php?id=<?php echo $data['id']; ?>">Löschen</a></td>
                      </tr> 
                    <?php
                    }
                    ?>
                </table>
            </section>
        </section>
    </section>
</body>
</html>