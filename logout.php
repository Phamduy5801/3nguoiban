<?php 
    session_start();
    if(isset($_SESSION['done'])){
        unset($_SESSION['done']);
        header("Location: login.php");
    }
?>