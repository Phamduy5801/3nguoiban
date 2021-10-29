<?php
session_start();
if (!isset($_SESSION['done'])) {
    header("Location: ../../../login.php");
}
?> 
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Thông báo khoa</h1>
        <br>
        <div class="container">
            <br><br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="d-flex justify-content-center">ID</th>
                        <th>Tên</th>
                        <th>Thông báo</th>
                          
                                         
                    </tr>
                </thead>
                <?php
                //gọi file config để kết nô
                include_once("../../config/config.php");
                //câu lệNh sql
                $query = "Select ma_khoa, ten_khoa, tb_khoa from db_khoa ";
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
                        <td colspan="1"><?php echo $st['ma_khoa'] ?></td>
                        <td colspan="1"><?php echo $st['ten_khoa'] ?></td>
                        <td colspan="1"><?php echo $st['tb_khoa'] ?></td>
                        
                        
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