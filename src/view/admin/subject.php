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
        <h1 style="color:#a83232">Quản lý môn học</h1>
        <br>
        
        <a class="btn btn-primary bt-add" href="add-subject.php" value="">Thêm mới môn học</a>
        <br><br>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Khoa</th>
                    <th>Tên</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Thời gian học</th>
                    <th>Giảng viên</th>
                    <th>Số tín chỉ</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>
                <?php
                //gọi file config để kết nô
                include_once ("../../config/config.php");
                //câu lệNh sql
                $query = "Select sb_id,ten_khoa, sb_ten,ngay_batdau, ngay_ketthuc, thoigian_hoc, db_teacher.tea_ten, sb_tinchi   from db_subject , db_teacher, db_khoa 
                where db_khoa.ma_khoa = db_subject.ma_khoa and db_teacher.tea_id = db_subject.tea_id ;";
                // thực thi câu lệnh sql
                $result = $conn->query($query);
                //kiểm tra sự tồn tại của $result
                if (!$result) {
                    //nến không có thì die tại đây là hiển thị lỗi
                    die($conn->error);
                }
                //khởi tạo $role = 1 mảng
                $subject = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $subject[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $st
                for ($i = 0; $i < count($subject); $i++) {
                    $sb = $subject[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        
                        <td><?php echo $sb['sb_id'] ?></td>
                        <td><?php echo $sb['ten_khoa'] ?></td>
                        <td><?php echo $sb['sb_ten'] ?></td>
                        <td><?php echo $sb['ngay_batdau'] ?></td>
                        <td><?php echo $sb['ngay_ketthuc'] ?></td>
                        <td><?php echo $sb['thoigian_hoc'] ?></td>
                        <td><?php echo $sb['tea_ten'] ?></td>
                        <td><?php echo $sb['sb_tinchi'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href=" update-subject.php?sb_id=<?php echo $sb['sb_id']?>"><i class="fa-solid fa-wrench"></i></a>
                            
                        </td>
                        <td>
                        <a onclick="return confirm('Bạn có chắc xoá môn học <?php echo $sb['sb_ten']?> ?')" class="btn btn-danger" href="delete-subject.php?sb_id=<?php echo $sb['sb_id'] ?>"><i class="fa-solid fa-user-slash"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
        
        <div class="clearfix"></div>

    </div>
</div>
<!-- End main -->

<?php include('partials/footer.php'); ?>