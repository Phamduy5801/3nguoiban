<?php include('partials/header.php'); ?>

<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Quản lý khoa</h1>
        <br>
        <div class="container">
            <a class="btn btn-primary bt-add" href="add-khoa.php">Thêm mới khoa</a>
            <br><br>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
                //gọi file config để kết nô
                include "../config/config.php";
                //câu lệNh sql
                $query = "Select  ma_khoa, ten_khoa  from  db_khoa ";

                $result = $conn->query($query);
                if (!$result) {
                    die($conn->error);
                }
                //khởi tạo $khoa = 1 mảng
                $khoa = array();
                //chạy vòng lặP while và 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $khoa[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $k
                for ($i = 0; $i < count($khoa); $i++) {
                    $k = $khoa[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $k['ma_khoa'] ?></td>
                        <td><?php echo $k['ten_khoa'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href="update-khoa.php?ma_khoa=<?php echo $k['ma_khoa'] ?>" value="">Cập nhật khoa</a>
                            <a onclick="return confirm('Bạn có chắc xoá khoa <?php echo $k['ten_khoa'] ?> ?')" class="btn btn-danger" href="delete-khoa.php?ma_khoa=<?php echo $k['ma_khoa'] ?>">Xoá</a>
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