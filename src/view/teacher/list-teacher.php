

</script>
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
        <h1 style="color:#a83232">Thông tin giảng viên</h1>
        <br>
        <div class="container">
        <br></br>
          <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="d-flex justify-content-center">ID</th>
                        <th>Tên</th>                     
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Khoa</th>        
                    </tr>
                </thead>
                <?php
                //gọi file config để kết nôí
                include_once("config/config.php");
                //câu lệNh sql
                $query = "Select tea_id, tea_ten,  tea_sdt, tea_email, tea_diachi, ten_khoa  from db_teacher , db_khoa 
                where db_khoa.ma_khoa = db_teacher.ma_khoa  ";
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
                        <td colspan="1"><?php echo $st['tea_id'] ?></td>
                        <td colspan="1"><?php echo $st['tea_ten'] ?></td>                     
                        <td colspan="1"><?php echo $st['tea_sdt'] ?></td>
                        <td colspan="1"><?php echo $st['tea_email'] ?></td>
                        <td colspan="1"><?php echo $st['tea_diachi'] ?></td>
                        <td colspan="1"><?php echo $st['ten_khoa'] ?></td>                  
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