<?php 
    session_start();
    if(!isset($_SESSION['teacher'])){
        header("Location: ../../../login.php");
    }
<<<<<<< HEAD
    if (!isset($_COOKIE['name'])) {
        header("Location: ../../../login.php");
    }
?>
=======
 ?>
>>>>>>> f40709b96b01f17cc40ecfd26801f69d2f80e60a
<?php
include("partials/header.php")
?>

<div class="main-content">
    <div class="wrapper" style="width: 100%;">
        <div class="container">
        <h1 style="color:#a83232">Trang chủ giảng viên</h1>
        <br><br>
            <!-- Lựa chọn của admin -->
            <div class="col-6 text-center box">
            <a href="list-teacher.php">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Thông tin Giảng viên
                </a>
            </div>
             <!-- Lựa chọn của admin -->

            <div class="col-6 text-center box">
                <a href="view-subject.php">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Danh sách môn học
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<?php
include("partials/footer.php")
?>