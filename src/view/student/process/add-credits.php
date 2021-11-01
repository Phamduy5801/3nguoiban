<?php
session_start();
include('../../../config/config.php');
$username = $_SESSION['student'];
$mamon = $_POST['mamon'];
if ($mamon != null) {
    // check xem mon day co ton tai hay ko nếu có lấy ra mã môn học
    $sql = "select sb_id from db_subject where sb_id = '$mamon'";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sb_id = $row['sb_id'];
            }
        } else {
            header('Location:' . SITESDURL . 'credits-registration.php');
        }
        // lay ma sinh vien co username da dc dang nhap trong phien lam viec
        $sql1 = "SELECT `st_id` FROM `db_student`, `db_user` WHERE db_user.user_id = db_user.user_id and db_user.username = '$username'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1 == true) {
            if (mysqli_num_rows($result1) > 0)
                while ($row = mysqli_fetch_assoc($result1)) {
                    $st_id = $row['st_id'];
                }
                // check xem mon day da dc dang ki chua
            $sql2 = "SELECT db_dkihoc.sb_id, db_student.st_id
            FROM `db_dkihoc`, `db_user`,`db_student` 
            WHERE db_dkihoc.st_id = db_student.st_id and db_student.user_id = db_user.user_id and db_user.username = '$username' and db_dkihoc.sb_id ='$mamon'";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2 == true) {
                $rowcount = mysqli_num_rows($result2);
                // neu ma chua dc dang ki thi ko co ban ghi nao thi se dc dang ki
                if ($rowcount < 1) { 
                    $today = date("Y/m/d");
                    $sql3 = "INSERT INTO `db_dkihoc`(`sb_id`, `st_id`, `ngay_dki`)
        VALUES ('$sb_id','$st_id','$today')";
                    $result3 = mysqli_query($conn, $sql3);
                    if ($result3 > 0) {
                        header('Location:' . SITESDURL . 'credits-registration.php');
                    }
                } else {
                    header('Location:' . SITESDURL . 'credits-registration.php');
                }
            }
        }
    }
} else {
    header('Location:' . SITESDURL . 'credits-registration.php');
}
?>