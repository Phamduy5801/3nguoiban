<?php 
    session_start();
    if(!isset($_SESSION['teacher'])){
        header("Location: ../../../login.php");
    }
?>
<?php
include("partials/header.php")
?>

<div class="main-content">
    <div class="wrapper" style="width: 100%;">
        <div class="container">
        <h1 style="color:#a83232">Chỉnh sửa thông tin</h1>
        <br><br>
            <div class="col-6 text-center box">
            <a href="dexuat-list-teacher.php">
                <div class="icon-group">
                    <i class="fas fa-user-edit"></i>
                </div>
                 Giảng viên
                </a>
            </div>
          

            <div class="col-6 text-center box">
                <a href="dexuat-list-student.php">
                <div class="icon-group">
                    <i class="fas fa-user-edit"></i>
                </div>
                Sinh viên
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<?php
include("partials/footer.php")
?>