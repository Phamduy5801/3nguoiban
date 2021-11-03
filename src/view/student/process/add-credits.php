<?php
session_start();
include('../../../config/config.php');
$username = $_SESSION['student'];
$mamon = $_POST['mamon'];
// check xem giá trị của thanh đăng ký học có để trống hay không
if ($mamon != null) {
    // câu lệnh sql lấy ra những học kì có status = 1
    $sql4 = "select * from phien_dkihoc where status = 1";
    // khởi tạo câu lệnh
    $result4 = mysqli_query($conn, $sql4);
    // check xem câu lệnh có tồn tại hay ko
    if ($result4 == true) {
        // duyệt số bản ghi
        if (mysqli_num_rows($result4) > 0) {
            while ($row = mysqli_fetch_assoc($result4)) {
                $hocki = $row['hoc_ki'];
            }
            // check xem mon day co ton tai hay ko nếu có lấy ra mã môn học
            $sql = "select sb_id from db_subject where sb_id = '$mamon' and hoc_ki = '$hocki'";
            $result = mysqli_query($conn, $sql);
            if ($result == true) {
                // check xem có bao nhiêu bản ghi
                if (mysqli_num_rows($result) > 0) {
                    // lấy từng dòng trong bản ghi
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sb_id = $row['sb_id'];
                    }
                    // lay ma sinh vien co username da dc dang nhap trong phien lam viec
                    $sql1 = "SELECT db_student.st_id FROM `db_student`, `db_user` WHERE db_student.user_id = db_user.user_id and db_user.username = '$username'";
                    $result1 = mysqli_query($conn, $sql1);
                    if ($result1 == true) {
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                $st_id = $row['st_id'];
                            }
                        }
                        // check xem mon day da dc dang ki chua
                        $sql2 = "SELECT db_dkihoc.sb_id, db_student.st_id
            FROM `db_dkihoc`, `db_user`,`db_student` 
            WHERE db_dkihoc.st_id = db_student.st_id and db_student.user_id = db_user.user_id and db_user.username = '$username' and db_dkihoc.sb_id ='$mamon'";
                        // khởi tạo câu lệnh
                        $result2 = mysqli_query($conn, $sql2);
                        // check xem câu lệnh đã đc khởi tạo chưa
                        if ($result2 == true) {
                            // đếm số bản ghi
                            $rowcount = mysqli_num_rows($result2);
                            // neu ma chua dc dang ki thi ko co ban ghi nao thi se dc dang ki
                            if ($rowcount < 1) {
                                // lấy giá trị ngày hôm nay
                                $today = date("Y/m/d");
                                // câu lệnh thêm bản ghi sql
                                $sql3 = "INSERT INTO `db_dkihoc`(`sb_id`, `st_id`, `ngay_dki`)
        VALUES ('$sb_id','$st_id','$today')";
                                // khởi tạo câu lệnh
                                $result3 = mysqli_query($conn, $sql3);
                                // check xem có bao nhiêu bản ghi đc thêm
                                if ($result3 > 0) {
                                    header('Location:' . SITESDURL . 'credits-registration.php');
                                    mysqli_close($conn);
                                }
                                // nếu môn này đã tồn tại
                            } else {
?>
                                <script>
                                    alert("Bạn đã đăng ký môn này rồi");
                                    window.history.go(-1)
                                </script>
                    <?php
                            }
                        }
                    }
                    // nếu không có học kì nào được mở
                    else if (mysqli_num_rows($result4) == 0) {
                        header('Location:' . SITESDURL . 'credits-registration.php');
                    }
                    // nếu môn này không tồn tại hoặc kì học không được mở
                } else {
                    ?>
                    <script>
                        alert("Mã môn không tồn tại");
                        window.history.go(-1)
                    </script>
    <?php
                }
            }
        }
    }
    // nếu để trống thanh đăng ký mà ấn nút
} else {
    ?>
    <script>
        alert("Vui lòng điền mã môn học bạn muốn đăng ký");
        window.history.go(-1)
    </script>
<?php
}
// đóng kết nối
mysqli_close($conn);
?>