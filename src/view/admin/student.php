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
        <h1 style="color:#a83232">Quản lý sinh viên</h1>
        <br>
        <div class="container">
        <a class="btn btn-primary bt-add" href="add-student.php" value="">Thêm mới sinh viên</a>
        <br><br>
        <table class="table">
                <tr>
                <th>ID</th>
                    <th>Tên</th>
                    <th>Lớp</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Khoa</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                //gọi file config để kết nô
                include_once ("../../config/config.php");
                //câu lệNh sql
                $query = "Select st_id, st_ten, st_lop, st_sdt, st_email, st_diachi, ten_khoa  from db_student , db_khoa 
                where db_khoa.ma_khoa = db_student.ma_khoa  ";
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
                        <td><?php echo $st['st_id'] ?></td>
                        <td><?php echo $st['st_ten'] ?></td>
                        <td><?php echo $st['st_lop'] ?></td>
                        <td><?php echo $st['st_sdt'] ?></td>
                        <td><?php echo $st['st_email'] ?></td>
                        <td><?php echo $st['st_diachi'] ?></td>
                        <td><?php echo $st['ten_khoa'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href="update-student.php?st_id=<?php echo $st['st_id']  ?>">Cập nhật sinh viên</a>
                            <a onclick="return confirm('Bạn có chắc xoá sinh viên <?php echo $st['st_ten'] ?> ?')" class="btn btn-danger" href="delete-student.php?st_id=<?php echo $st['st_id'] ?>">Xoá</a>
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

<?php include('partials/footer.php'); ?>