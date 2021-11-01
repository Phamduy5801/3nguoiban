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
        <h1 style="color:#a83232">Quản lý phiên đăng kí học</h1>
        <br>
        <div class="container">
            <a class="btn btn-primary bt-add" href="add_phiendki.php">Mở phiên đăng kí mới</a>
            <br><br>
            <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Thời gian bắt đàu</th>
                    <th>Thời gian kết thúc</th>
                    <th>Học kì</th>
                    <th>Trạng thái</th>
                    <th>Thay đổi trạng thái</th>
                    <th>Xoá</th>
                </tr>
            </thead>
                <?php
                //gọi file config để kết nối
                include_once ("../../config/config.php");
                //câu lệNh sql
                $query = "Select  *  from  phien_dkihoc ";
                
                $result = $conn->query($query);
                if (!$result) {
                    die($conn->error);
                }
                //khởi tạo $phien = 1 mảng
                $phien = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    //gán mảng phien = dữ liệu theo từng hàng trong cơ sở dữ liệu
                    $phien[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $ph
                for ($i = 0; $i < count($phien); $i++) {
                    $ph = $phien[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $ph['id'] ?></td>
                        <td><?php echo $ph['thoigian_batdau'] ?></td>
                        <td><?php echo $ph['thoigian_ketthuc'] ?></td>
                        <td><?php echo $ph['hoc_ki'] ?></td>
                        <?php 
                            if($ph['status'] == 0){
                        ?>
                            <td>Chưa kích hoạt</td>
                        <?php
                            }else if($ph['status'] == 1){
                        ?>
                            <td>Đã kích hoạt</td>
                        <?php 
                            }
                        ?>
                        <td class='text-center' >
                            <a class="btn btn-success bt-add" style="margin-right: 100px;" href="change_stt.php?id=<?php echo $ph['id'] ?>"><i class="fa-solid fa-wrench"></i></a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc xoá phiên đăng kí này?')" class="btn btn-danger" href="delete-phiendki.php?id=<?php echo $ph['id'] ?>"><i class="fa-solid fa-user-slash"></i></a>
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