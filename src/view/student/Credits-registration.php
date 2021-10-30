<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: ../../../login.php");
}
if (!isset($_COOKIE['name'])) {
    header("Location: ../../../login.php");
}
?>
<?php
include("partials/header.php")
?>
<main>
    <!-- Start main -->
    <div class="main-content">
        <div class="wrapper">
            <h1 style="color:#a83232">Đăng ký Lớp</h1>
            <br><br>
            <form action="process/add-credits.php" method="POST">
                <div class="input-group mb-3" style="width: 300px;">
                    <input name="mamon" type="text" class="form-control" placeholder="Mã Lớp" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Đăng ký</button>
                </div>
            </form>
            <br><br>
            <h1 style="color:#a83232">Lớp đã đăng ký</h1>
            <br><br>
            <table class="table table-bordered" style="border: solid;">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Môn</th>
                        <th scope="col">Mã học sinh</th>
                        <th scope="col">Ngày đăng ký</th>
                        <th scope="col">Hủy</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once('../../config/config.php');
                    $username = $_SESSION['student'];
                    $sql = "select id, db_dkihoc.sb_id, db_dkihoc.st_id, ngay_dki, db_teacher.tea_ten
                    from db_dkihoc, db_user, db_student, db_teacher
                    where db_dkihoc.st_id = db_student.st_id and db_dkihoc.tea_id = db_teacher.tea_id and db_student.user_id = db_user.user_id and db_user.username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if ($result == true) {
                        if (mysqli_num_rows($result) > 0)
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?> </th>
                                <td><?php echo $row['sb_id']; ?></td>
                                <td><?php echo $row['st_id']; ?></td>
                                <td><?php echo $row['tea_ten']; ?></td>
                                <td><?php  echo $row['ngay_dki']; ?></td>
                                <td><a class="btn btn-danger" href=""><i class="fa-solid fa-x"></i></a></td>
                            </tr>
                    <?php
                            }
                    }
                    ?>
                </tbody>
            </table>
            <div class="clearfix"></div>

        </div>
    </div>
    <!-- End main -->
</main>
<?php
include("partials/footer.php")
?>