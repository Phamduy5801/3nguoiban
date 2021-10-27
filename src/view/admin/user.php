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
        <h1 style="color:#a83232">Quản lý người sử dụng</h1>
        <br><br>
        <div class="container">
           
            <a class="btn btn-primary bt-add" href="add-user.php" value="">Thêm mới người dùng</a>
            <br><br>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Chức vụ</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                //kết nối csdl
                include_once ("../../config/config.php");
               //câu lệnh sql
                $query = "Select u.user_id, u.username, u.email, r.role_name  from db_user u, role r where r.role_id = u.role_id";
                //khởi tạo đối tượng prepare
                $result = $conn->query($query);
                //kiếm tra $result
                if (!$result) {
                    //nếU sai thì die tại đây và hiển thị lỗi
                    die($conn->error);
                }
                //tạo biến $user = 1 mảng
                $user = array();
                //chạy vòng lặP while và lấy dữ liệu theo từng hàng
                while ($r = $result->fetch_array(MYSQLI_BOTH)){
                    //gán mảng $user = dữ liệu theo hàng đưỢc lấy trong cơ sở dữ liệu
                    $user[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $use
                for ($i = 0; $i < count($user); $i++) {
                    $use = $user[$i];
                ?>
                    <tr>
                        <td><?php echo $use['user_id'] ?></td>
                        <td><?php echo $use['username'] ?></td>
                        <td><?php echo $use['email'] ?></td>
                        <td><?php echo $use['role_name'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href="update-user.php?user_id=<?php echo $use['user_id'] ?>">Cập nhật người dùng</a>
                            <a onclick="return confirm('Bạn có chắc xoá người dùng <?php echo $use['username'] ?> ?')" class="btn btn-danger" href="delete-user.php?user_id=<?php echo $use['user_id'] ?>">Xoá</a>
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
<?php include_once('partials/footer.php'); ?>