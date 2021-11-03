<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../login.php");
}
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Phân công dạy học</h1>
        <br>
        <div class="container">
            <a class="btn btn-primary bt-add" href="add-assignment.php" value="">Thêm mới</a>
            <br><br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Giảng viên</th>
                        <th>Môn học</th>
                        <th>Xoá</th>
                    </tr>
                </thead>
                <?php
                //gọi file config để kết nô
                include_once("../../config/config.php");
                //câu lệNh sql
                $query = "select id, tea_ten, sb_ten from teacher_subject, db_teacher, db_subject where teacher_subject.tea_id = db_teacher.tea_id and teacher_subject.sb_id = db_subject.sb_id";
                //thực thi câu lệnh sql
                $result = $conn->query($query);
                //kiểm tra sự tồn tại của biẾn result
                if (!$result) {
                    //nếu !$result thì die tại đây và hiển thị lỗi
                    die($conn->error);
                }
                //khởi tạo $tea_sbj = 1 mảng
                $tea_sbj = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $tea_sbj[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $t_sb
                for ($i = 0; $i < count($tea_sbj); $i++) {
                    $t_sb= $tea_sbj[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $t_sb['id'] ?></td>
                        <td><?php echo $t_sb['tea_ten'] ?></td>
                        <td><?php echo $t_sb['sb_ten'] ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc xoá lịch phân công của giảng viên <?php echo $t_sb['tea_ten'] ?>  ?')" class="btn btn-danger" href="delete-assignment.php?id=<?php echo $t_sb['id']  ?>"><i class="fa-solid fa-user-slash"></i></a>
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