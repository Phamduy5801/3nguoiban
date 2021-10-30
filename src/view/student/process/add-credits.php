<?php
session_start();
include('../../../config/config.php');
$username = $_SESSION['student'];
$mamon = $_POST['mamon'];
if ($mamon != null) {
    $sql = "select sb_id, tea_id from db_subject where sb_id = '$mamon'";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sb_id = $row['sb_id'];
                $tea_id = $row['tea_id'];
            }
        }
        else{
            header('Location:' . SITESDURL . 'credits-registration.php');
        }
        $sql1 = "SELECT `st_id`FROM `db_student`,  `db_user` WHERE db_user.user_id = db_user.user_id and db_user.username = '$username'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1 == true) {
            if (mysqli_num_rows($result1) > 0)
                while ($row = mysqli_fetch_assoc($result1)) {
                    $st_id = $row['st_id'];
                }
            $sql2 = "SELECT COUNT(*) FROM `db_dkihoc` WHERE sb_id LIKE '$sb_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $count = $row['COUNT(*)'];
            if ($count < 1) {
                $today = date("Y/m/d");
                $sql3 = "INSERT INTO `db_dkihoc`( `sb_id`, `st_id`, `tea_id`, `ngay_dki`) 
        VALUES ('$sb_id','$st_id','$tea_id','$today')";
                $result3 = mysqli_query($conn, $sql3);
                if ($result3 > 0) {
                    header('Location:' . SITESDURL . 'credits-registration.php');
                }
            } else {
                header('Location:' . SITESDURL . 'credits-registration.php');
            }
        }
    }
} else {
    header('Location:' . SITESDURL . 'credits-registration.php');
}
