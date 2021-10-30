<?php
session_start();
if (!isset($_SESSION['teacher'])) {
    header("Location: ../../../login.php");
}
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Sửa thông tin giảng viên</h1>
        <br>
  
        <div class="container">
            <table class="table table-striped">
                
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Khoa</th>
                        <th>Username</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Sửa</th>                      
                    </tr>
                </thead>
                <?php
                //gọi file config để kết nô
                include_once("config/config.php");
                //câu lệNh sql
                $query = "Select tea_id, ten_khoa, db_user.username , tea_ten, tea_sdt, tea_email, tea_diachi from db_teacher, db_user , db_khoa 
                where db_khoa.ma_khoa = db_teacher.ma_khoa and db_user.user_id = db_teacher.user_id ";
                //thực thi câu lệNh sql
                $result = $conn->query($query);
                //kiểm tra sự tồn tại của biẾn result
                if (!$result) {
                    //nếu !$result thì die tại đây và hiểN thị lỗi
                    die($conn->error);
                }
                //khởi tạo $teacher = 1 mảng
                $teacher = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $teacher[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $tea
                for ($i = 0; $i < count($teacher); $i++) {
                    $tea = $teacher[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $tea['tea_id'] ?></td>
                        <td><?php echo $tea['ten_khoa'] ?></td>
                        <td><?php echo $tea['username'] ?></td>
                        <td><?php echo $tea['tea_ten'] ?></td>
                        <td><?php echo $tea['tea_sdt'] ?></td>
                        <td><?php echo $tea['tea_email'] ?></td>
                        <td><?php echo $tea['tea_diachi'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href="dexuat-sua-teacher.php?tea_id=<?php echo $tea['tea_id'] ?>"><i class="fa-solid fa-wrench"></i></a>
                        </td>
                        
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
        <div class="clearfix"></div>
        <a class="btn btn-danger bt-add" href="de-xuat.php" style ="float:right" value="">Thoát</a>
    </div>
</div>
<!-- End main -->

<?php include('partials/footer.php'); ?>