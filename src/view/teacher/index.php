<?php 
    session_start();
    if(!isset($_SESSION['teacher'])){
        header("Location: ../../../login.php");
    }
    if (!isset($_COOKIE['name'])) {
        header("Location: ../../../login.php");
    }
?>
<?php
include("partials/header.php")
?>
<div class="main-content">
    <div class="wrapper" style="width: 100%;">
        <div class="container">
            <!-- Lựa chọn của admin -->
            <div class="col-6 text-center box">
            <a href="#">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Thông tin cá nhân
                </a>
            </div>
             <!-- Lựa chọn của admin -->
            <div class="col-6 text-center box">
                <a href="#">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Khoa
                </a>
            </div>
            <div class="col-6 text-center box">
                <a href="#">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Giảng viên
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<?php
include("partials/footer.php")
?>