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
        <h1 style="color:#a83232">Add new role</h1>
        <br><br>
        <div class="container">

            <form method="POST" action="add-role.php">

                Name: <input class="form-control" type="text" name="role"/><br>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>

<?php
//kiểm tra dữ liệu người dùng nhậP
if (isset($_REQUEST['role'])) {

    //kết nối sql
    include_once ("../../config/config.php");

    //câu lệnh sql
    $query = "INSERT INTO `role` (`role_name`) VALUES (?);";
    // Tạo đối tượng repare
    $stmt = $conn->prepare($query);
    //gán dữ liệu vào biến và lấy dữ liệu từ form với name tương ứng
    $id = $_GET['role_id'];
    $role = $_POST['role'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('s', $role);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang role
    header("Location: role.php");
}
?> 