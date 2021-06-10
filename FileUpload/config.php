<?php 

$server = "localhost";
$dbuser = "root";
$dbpass = "";
$database = "file_database";

$conn = mysqli_connect($server, $dbuser, $dbpass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

$base_url = "http://localhost:8080/skycloud/skyCloud/FileUpload/"; // Website url

?>