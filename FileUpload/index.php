<?php 

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../phplogin/login.php");
    exit;
}

include 'config.php';

$link = "";
$link_status = "display: none;";

$token = "";


if (isset($_POST['upload'])) { // If isset upload button or not
	// Declaring Variables
	$location = "../uploads/";
	$file_new_name = date("dmy") . time() . $_FILES["file"]["name"]; // New and unique name of uploaded file
	$file_name = $_FILES["file"]["name"]; // Get uploaded file name
	$file_temp = $_FILES["file"]["tmp_name"]; // Get uploaded file temp
	$file_size = $_FILES["file"]["size"]/1024/1024; // Get uploaded file size
	$upload_date = date('Y-m-d');
	$file_token = uniqid();
	$file_user = $_SESSION["username"];
	$file_link = $base_url . "download.php?token=" . $file_token;
	/*
	How we can get mb from bytes
	(mb*1024)*1024

	In my case i'm 10 mb limit
	(10*1024)*1024
	*/

	if ($file_size > 10485760) { // Check file size 10mb or not
		echo "<script>alert('Woops! File is too big. Maximum file size allowed for upload 10 MB.')</script>";
	} else {
		$sql = "INSERT INTO uploaded_files (name, new_name, token, file_size, username, upload_date, link)
				VALUES ('$file_name', '$file_new_name', '$file_token', '$file_size', '$file_user', '$upload_date', '$file_link')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			move_uploaded_file($file_temp, $location . $file_new_name);
			echo "<script>alert('Wow! File uploaded successfully.')</script>";
			// Select id from database
			$sql = "SELECT id FROM uploaded_files ORDER BY id DESC";
			$result = mysqli_query($conn, $sql);
			if ($row = mysqli_fetch_assoc($result)) {
				//Key token id+pin
				$link = $base_url . "download.php?token=" . $file_token;
				$link_status = "display: block;";
			}
		} else {
			echo "<script>alert('Woops! Something wong went.')</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

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
            <section class="main_content">
	         	<div class="file__upload">
					<div class="header">
						<p><i class="fa fa-cloud-upload fa-2x"></i><span><span>up</span>load</span></p>			
					</div>
					<form action="" method="POST" enctype="multipart/form-data" class="body">
						<!-- Sharable Link Code -->
						<input type="checkbox" id="link_checkbox">
						<input type="text" value="<?php echo $link; ?>" id="link" readonly>
						<label for="link_checkbox" style="<?php echo $link_status?>">Get Sharable Link</label>

						<input type="file" name="file" id="upload" required>
						<label for="upload">
							<i class="fa fa-file-text-o fa-3x"></i>
							<p>
								<strong><span>Browse & Choose</span></strong> files<br>
								 to begin the upload
							</p>
						</label>
						<label></label>
						<button name="upload" class="btn">Upload</button>
					</form>
				</div>  
            </section>
        </section>
    </section>
</body>
</html>