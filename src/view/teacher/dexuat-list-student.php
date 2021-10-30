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
        <h1 style="color:#a83232">Sửa thông tin sinh viên</h1>
        <br>
        <div class="container">
            <a class="btn btn-primary bt-add" href="dexuat-them-student.php" value="">Thêm mới sinh viên</a>
            <br><br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Khoa</th>
                        <th>Username</th>
                        <th>Lớp</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
               
                <?php
                //gọi file config để kết nô
                include_once("../../config/config.php");
                //câu lệNh sql
                $query = "Select st_id, ten_khoa, db_user.username, st_ten, st_lop, st_sdt, st_email, st_diachi  from db_student , db_khoa, db_user
                where db_khoa.ma_khoa = db_student.ma_khoa and db_student.user_id=db_user.user_id ";
                // thực thi câu lệnh sql
                $result = $conn->query($query);
                //kiểm tra sự tồn tại của $result
                if (!$result) {
                    //nến không có thì die tại đây là hiển thị lỗi
                    die($conn->error);
                }
                //khởi tạo $role = 1 mảng
                $student = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $student[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $st
                for ($i = 0; $i < count($student); $i++) {
                    $st = $student[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td colspan="1"><?php echo $st['st_id'] ?></td>
                        <td colspan="1"><?php echo $st['st_ten'] ?></td>
                        <td colspan="1"><?php echo $st['ten_khoa'] ?></td>
                        <td colspan="1"><?php echo $st['username'] ?></td>
                        <td colspan="1"><?php echo $st['st_lop'] ?></td>
                        <td colspan="1"><?php echo $st['st_sdt'] ?></td>
                        <td colspan="1"><?php echo $st['st_email'] ?></td>
                        <td colspan="1"><?php echo $st['st_diachi'] ?></td>
                        <td colspan="1">
                            <a class="btn btn-success bt-add" href="dexuat-sua-student.php?st_id=<?php echo $st['st_id']  ?>"><i class="fa-solid fa-wrench"></i></a>
                        </td>
                        <td colspan="1">
                            <a onclick="return confirm('Bạn có chắc xoá sinh viên <?php echo $st['st_ten'] ?> ?')" class="btn btn-danger" href="dexuat-xoa-student.php?st_id=<?php echo $st['st_id'] ?>"><i class="fa-solid fa-user-slash"></i></a>
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