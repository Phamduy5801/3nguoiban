<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: ../../../login.php");
}
//check xem cookie con tồn tại hay ko nếu không còn thì quay trở về trang login
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
            <div class="col-4 text-center box">
                <a href="profile.php">
                    <div class="icon-group">
                        <i class="fas fa-university"></i>
                    </div>
                    Thông tin cá nhân
                </a>
            </div>
            <div class="col-4 text-center box">
                <a href="credits-registration.php">
                    <div class="icon-group">
                        <i class="fas fa-university"></i>
                    </div>
                    Đăng ký môn học
                </a>
            </div>
            <div class="col-4 text-center box">
                <a href="list-class.php">
                    <div class="icon-group">
                        <i class="fas fa-university"></i>
                    </div>
                    Thông tin lớp
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<?php
include("partials/footer.php")
?>