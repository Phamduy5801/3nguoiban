
<?php 
    session_start();
    if(!isset($_SESSION['teacher'])){
        header("Location: ../../../login.php");
    }
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Danh sách môn học</h1>
        <br>
        
       
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
                    <th>Thông báo</th>
                    <th>Cập nhập</th>
                   
                </tr>
            </thead>
                <?php
                //gọi file config để kết nô
                include_once ("config/config.php");
                //câu lệNh sql
                $query = "Select sb_id,ten_khoa, sb_ten,ngay_batdau, ngay_ketthuc, thoigian_hoc, tea_ten, sb_tinchi, sb_tb  from db_subject , db_khoa , db_teacher
                where db_khoa.ma_khoa = db_subject.ma_khoa and db_teacher.tea_id = db_subject.tea_id;";
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
                        <td>Tài liệu: <a href="<?php echo $sb['sb_tb'] ?>"><?php echo $sb['sb_tb'] ?></a></td>                     
                        <td>
                            <a class="btn btn-success bt-add" href=" add-subject.php?sb_id=<?php echo $sb['sb_id']?>"><i class="fas fa-edit"></i></a>
                            
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