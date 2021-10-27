<?php 
    session_start();
    if(!isset($_SESSION['done'])){
        header("Location: ../../../login.php");
    }
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <!-- Content -->
        <h1 style="color:#a83232">Trang chủ quản lý</h1>
        <br><br>
        <div class="container">
            <!-- Lựa chọn của admin -->
            <div class="col-6 text-center box">
            <a href="#">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Trang chủ người dùng
                </a>
            </div>
             <!-- Lựa chọn của admin -->
            <div class="col-6 text-center box">
                <a href="#">
                <div class="icon-group">
                    <i class="fas fa-university"></i>
                </div>
                Thống kê
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?> 