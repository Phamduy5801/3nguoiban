<?php 
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location: ../../../login.php");
    }
?>
<?php include('partials/header.php'); ?>

<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Quản lý chức vụ</h1>
        <br>
        <div class="container">
            <a class="btn btn-primary bt-add" href="add-role.php">Thêm mới chức vụ</a>
            <br><br>
            <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Sửa</th>
                </tr>
            </thead>
                <?php
                //gọi file config để kết nô
                include_once ("../../config/config.php");
                //câu lệNh sql
                $query = "Select  role_id, role_name  from  role ";
                
                $result = $conn->query($query);
                if (!$result) {
                    die($conn->error);
                }
                //khởi tạo $role = 1 mảng
                $role = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    //gán mảng role = dữ liệu theo từng hàng trong cơ sở dữ liệu
                    $role[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $ro
                for ($i = 0; $i < count($role); $i++) {
                    $ro = $role[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $ro['role_id'] ?></td>
                        <td><?php echo $ro['role_name'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc xoá chức vụ <?php echo $ro['role_name'] ?>  ?')" class="btn btn-danger" href="delete-role.php?role_id=<?php echo $ro['role_id'] ?>"><i class="fa-solid fa-user-slash"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->

<?php include('partials/footer.php');?>