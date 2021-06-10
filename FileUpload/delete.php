<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($conn,"delete from uploaded_files where id = '$id'"); // delete query

if($del)
{
    mysqli_close($conn); // Close connection
    header("location:userFile.php"); // redirects to all records page
    exit;   
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>