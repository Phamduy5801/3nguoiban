<?php include('partials/header.php'); ?>

<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Quản lý chức năng</h1>
        <br>
        <div class="container">
            <a class="btn btn-primary bt-add" href="add-role.php">Thêm mới chức năng</a>
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
                $query = "Select  role_id, role_name  from  role ";
                
                $result = $conn->query($query);
                if (!$result) {
                    die($conn->error);
                }
                //khởi tạo $role = 1 mảng
                $role = array();
                //chạy vòng lặP while và 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $role[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $ro
                for ($i = 0; $i < count($role); $i++) {
                    $ro = $role[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $ro['role_id'] ?></td>
                        <td><?php echo $ro['role_name'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc xoá chức năng <?php echo $ro['role_name'] ?>  ?')" class="btn btn-danger" href="delete-role.php?role_id=<?php echo $ro['role_id'] ?>">Xoá</a>
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