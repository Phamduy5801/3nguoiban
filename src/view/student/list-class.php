<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: ../../../login.php");
}
if (!isset($_COOKIE['name'])) {
    header("Location: ../../../login.php");
}
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <div class="container-fluid clear">
            <div class="d-flex justify-content-center d-flex align-items-center" style="height: 200px;">
                <p class="h1">Danh sách lớp học</p>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <form action="" method="GET" style="width: 50%;">
                        <div class="input-group mb-3">
                            <input name="search" type="text" class="form-control" placeholder="Mã lớp" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <div class="col d-flex justify-content-end">
                    <form action="" method="GET" style="width: 40%;">
                        <div class="input-group mb-3">
                            <select name="find" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option selected>Kì học</option>
                                <?php
                                include_once('../../config/config.php');
                                $username = $_SESSION['student'];
                                $sql = "SELECT distinct hoc_ki from phien_dkihoc";
                                $result = mysqli_query($conn, $sql);
                                if ($result == true) {
                                    if (mysqli_num_rows($result) > 0)
                                        while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['hoc_ki'] ?>"><?php echo $row['hoc_ki'] ?></option>
                                <?php
                                        }
                                }
                                ?>
                            </select>
                            <button style="height: 40px;" class="btn btn-outline-secondary" type="submit" id="button-addon1">Tìm kiếm</button>
                        </div>

                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã môn</th>
                        <th scope="col">Mã khoa</th>
                        <th scope="col">Tên giáo viên</th>
                        <th scope="col">Môn</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Học Kì</th>
                        <th scope="col">Số tín chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once('../../config/config.php');
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $key = $_GET['search'];
                        $sql = "SELECT db_subject.sb_id, db_subject.ma_khoa, db_teacher.tea_ten, sb_ten, ngay_batdau, ngay_ketthuc, thoigian_hoc, db_subject.hoc_ki, sb_tinchi 
                        from db_subject, db_teacher, teacher_subject
                        where db_subject.sb_id = teacher_subject.sb_id and teacher_subject.tea_id = db_teacher.tea_id and teacher_subject.sb_id like '%$key%'";
                    } else if (isset($_GET['find']) && !empty($_GET['find'])) {
                        $key = $_GET['find'];
                        $sql = "SELECT db_subject.sb_id, db_subject.ma_khoa, db_teacher.tea_ten, sb_ten, ngay_batdau, ngay_ketthuc, thoigian_hoc, db_subject.hoc_ki, sb_tinchi 
                        from db_subject, db_teacher, teacher_subject
                        where db_subject.sb_id = teacher_subject.sb_id and teacher_subject.tea_id = db_teacher.tea_id and db_subject.hoc_ki like '$key'";
                    } else {
                        $sql = "select db_subject.sb_id, db_subject.ma_khoa, db_teacher.tea_ten, sb_ten, ngay_batdau, ngay_ketthuc, thoigian_hoc, sb_tinchi, db_subject.hoc_ki 
                        from db_subject, db_teacher, teacher_subject
                        where db_subject.sb_id = teacher_subject.sb_id and teacher_subject.tea_id = db_teacher.tea_id";
                    }

                    $result = mysqli_query($conn, $sql);

                    if ($result == true) {
                        if (mysqli_num_rows($result) > 0)
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $row['sb_id']; ?> </th>
                                <td><?php echo $row['ma_khoa']; ?></td>
                                <td><?php echo $row['tea_ten']; ?></td>
                                <td><?php echo $row['sb_ten']; ?></td>
                                <td><?php echo $row['ngay_batdau']; ?></td>
                                <td><?php echo $row['ngay_ketthuc']; ?></td>
                                <td><?php echo $row['thoigian_hoc']; ?></td>
                                <td><?php echo $row['hoc_ki']; ?></td>
                                <td><?php echo $row['sb_tinchi']; ?></td>
                            </tr>
                    <?php
                            }
                        mysqli_close($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>