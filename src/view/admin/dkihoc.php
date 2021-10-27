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
        <h1 style="color:#a83232">Quản lý đăng kí học</h1>
        <br>
        <div class="container">
        <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Mã môn học</th>
                    <th>Tên sinh viên</th>
                    <th>Tên giảng viên</th>
                    <th>Ngày đăng kí</th>
                    <th>Tên môn học</th>
                    <th>Lớp học</th>
                    <th>Chức năng</th>
                </tr>
                <?php
                //gọi file config để kết noosi co so du lieu
                include_once ("../../config/config.php");
                //câu lệNh sql
                $query = "Select dki.id, sb.sb_id, st.st_ten, tea.tea_ten, dki.ngay_dki, sb.sb_ten, dki.lop_hoc from db_dkihoc dki, db_student st, db_teacher tea, db_subject sb 
                where st.st_id = dki.st_id and sb.sb_id = dki.sb_id and tea.tea_id = dki.tea_id ";
                // thực thi câu lệnh sql
                $result = $conn->query($query);
                //kiểm tra sự tồn tại của $result
                if (!$result) {
                    //nến không có thì die tại đây là hiển thị lỗi
                    die($conn->error);
                }
                //khởi tạo $dkihoc = 1 mảng
                $dkihoc = array();
                //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                    $dkihoc[] = $r;
                }
                //duyệt dữ liệu từ mảng gán vào biến $dki
                for ($i = 0; $i < count($dkihoc); $i++) {
                    $dki = $dkihoc[$i];
                ?>
                    <tr>
                        <!-- lấy dữ liệu từ mảng hiển thị lên bảng -->
                        <td><?php echo $dki['id'] ?></td>
                        <td><?php echo $dki['sb_id'] ?></td>
                        <td><?php echo $dki['st_ten'] ?></td>
                        <td><?php echo $dki['tea_ten'] ?></td>
                        <td><?php echo $dki['ngay_dki'] ?></td>
                        <td><?php echo $dki['sb_ten'] ?></td>
                        <td><?php echo $dki['lop_hoc'] ?></td>
                        <td>
                            <a class="btn btn-success bt-add" href="update-dkihoc.php?id=<?php echo $dki['id'] ?>">Cập nhật lịch học</a>
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