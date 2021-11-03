<?php

//Include constants.php file here
include('../../../config/config.php');

// 1. get the ID of Admin to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM `db_dkihoc` WHERE id = '$id'";

//Execute the Query
$result = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if ($result == true) {
    header('Location: ../credits-registration.php');
} else {
    
}
?>