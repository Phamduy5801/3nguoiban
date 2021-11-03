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
include('partials/header.php')
?>
<main>
    <div class="container-fluid">
        <div style="height: 200px;" class="d-flex justify-content-center d-flex align-items-center">
            <p class="h1">Thông tin cá nhân</p>
        </div>
        <div class="d-flex justify-content-center d-flex align-items-center">
            <div class="card mb-5" style="max-width: 740px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="img/no_img.png" class="img-fluid rounded-start" alt="...">

                        <div style="width: 240px; height: 100px;" class="d-flex justify-content-center d-flex align-items-center">
                            <label class="form-label"> </label>
                            <button class="btn btn-outline-secondary" type="submit" id="myBtn">Đổi mật khẩu</button>
                        </div>
                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2><i class="fa-solid fa-shield-blank"></i> Đổi mật khẩu</h2>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-body row">
                                    <div class="col d-flex justify-content d-flex align-items-center">
                                        <img src="img/lock-out-4538020_1280.png" style="width: 200px; height: 200px;" alt=""></i>
                                    </div>
                                    <div class="col-8">
                                        <form action="process/change-pass.php" method="POST">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Mật khẩu cũ</label>
                                                <input name="oldpass" type="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label>
                                                <input name="pass1" type="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu mới</label>
                                                <input name="pass2" type="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <h3><i class="fa-solid fa-lock"></i></h3>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Get the modal
                            var modal = document.getElementById("myModal");

                            // Get the button that opens the modal
                            var btn = document.getElementById("myBtn");

                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close")[0];

                            // When the user clicks the button, open the modal 
                            btn.onclick = function() {
                                modal.style.display = "block";
                            }

                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function() {
                                modal.style.display = "none";
                            }

                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = "none";
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <?php
                            $username = $_SESSION['student'];
                            include_once('../../config/config.php');
                            $sql = "SELECT st_id, st_ten, ten_khoa, st_lop, st_sdt, st_email, st_diachi 
                            from db_student, db_user, db_khoa
                            where db_student.user_id = db_user.user_id and db_student.ma_khoa = db_khoa.ma_khoa and db_user.username = '$username'";
                            $result = mysqli_query($conn, $sql);
                            if ($result == true) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                        <form>
                                            <div class="row">
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Mã sinh viên</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['st_id'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Họ và tên</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['st_ten'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Khoa</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['ten_khoa'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Lớp</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['st_lop'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Số điện thoại</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['st_sdt'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['st_email'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                                    <label class="form-label">Địa chỉ</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $row['st_diachi'] ?>">
                                                </div>
                                                <div class="mb-3 col-5">
                                        </form>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include('partials/footer.php')
?>