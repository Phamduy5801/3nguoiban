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
        <h1 style="color:#a83232">Quản lý chức năng</h1>
        <br>
        <div class="container">
        <a class="btn btn-primary bt-add" href="add-teacher.php" value="">Thêm mới giảng viên</a>
        <br><br>
        <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
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
                $query = "Select tea_id, tea_ten, tea_sdt, tea_email, tea_diachi, ten_khoa  from db_teacher , db_khoa 
                where db_khoa.ma_khoa = db_teacher.ma_khoa  ";
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
                        <td><?php echo $tea['tea_ten'] ?></td>
                        <td><?php echo $tea['tea_sdt'] ?></td>
                        <td><?php echo $tea['tea_email'] ?></td>
                        <td><?php echo $tea['tea_diachi'] ?></td>
                        <td><?php echo $tea['ten_khoa'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href="update-teacher.php?tea_id=<?php  echo $tea['tea_id'] ?>">Cập nhật giảng viên</a>
                            <a onclick="return confirm('Bạn có chắc xoá giảng viên <?php echo $tea['tea_ten']?> ?')" class="btn btn-danger" href="delete-teacher.php?tea_id=<?php echo $tea['tea_id']  ?>">Xoá</a>
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