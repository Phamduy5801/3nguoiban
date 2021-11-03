<?php
session_start();
include('../../../config/config.php');
$username = $_SESSION['student'];
$oldpass = $_POST['oldpass'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
// kiểm tra xem đã điền mật khẩu cũ chưa
if ($oldpass != null) {
    // sql
    $sql = "SELECT `password` from db_user where username = '$username'";
    // khởi tạo câu lệnh
    $result = mysqli_query($conn, $sql);
    // kiểm tra xem câu lệnh có tồn tại hay ko
    if ($result == true) {
        // kiểm tra xem số bản ghi có nhiều hơn 0 bản ghi ko
        if (mysqli_num_rows($result) > 0) {
            // gán giá trị bản ghi vào mảng row
            $row = mysqli_fetch_assoc($result);
            // lấy giá trị của một cell trong bảng gán vào biến 
            $dbpass = $row['password'];
        }
        // kiểm tra xem mật khẩu cũ có trùng mật khẩu trong db ko
        if ($oldpass == $dbpass) {
            //nếu trừng thì gán mật khẩu update bằng mật khẩu muốn thay đổi
            $finalpass = $pass1;
            // kiểm tra xem mật khẩu muốn thay đổi có để trông không
            if ($pass1 != null) {
                // kiểm tra xem 2 mật khẩu muốn thay đổi có khớp không
                if ($pass1 == $pass2) {
                    // câu lệnh update
                    $sql1 = "UPDATE db_user set `password` = '$finalpass' where username = '$username'";
                    // khởi tạo câu lệnh
                    $result1 = mysqli_query($conn, $sql1);
                    // kiểm tra xem câu lệnh có đúng ko
                    if ($result1 == true) {
?>
                        <script>
                            // quay trở về trang login sau khi đã đổi xong mật khẩu
                            window.location.replace(<?php header("Location: ../../../../login.php"); ?>);
                        </script>
                    <?php
                    }
                    // nếu 2 mật khẩu không khớp trở về trang cũ 
                } else {
                    ?>
                    <script>
                        alert("Mật khẩu không khớp");
                        window.history.go(-1);
                    </script>
                <?php
                }
                // nếu để trống mật khẩu trở về trang cũ 
            } else {
                ?>
                <script>
                    alert("Không được để trống mật khẩu");
                    window.history.go(-1);
                </script>
                <?php
            }
            // kiểm tra xem mật khẩu vừa nhập với mật khẩu có đúng là mật khẩu mã hóa từ database  không
        } else if (password_verify($oldpass, $dbpass)) {
            // mã hóa mật khẩu nhập
            $finalpass = password_hash($pass1, PASSWORD_DEFAULT);
            // nếu mật khẩu không trống
            if ($pass1 != null) {
                // nếu 2 mật khẩu giống nhau
                if ($pass1 == $pass2) {
                    //sql câu lệnh update
                    $sql1 = "UPDATE db_user set `password` = '$finalpass' where username = '$username'";
                    // khởi tạo câu lệnh

                    $result1 = mysqli_query($conn, $sql1);
                    // kiểm tra xem câu lệnh có đúng ko

                    if ($result1 == true) {
                ?>
                        <script>
                            // quay trở về trang login sau khi đã đổi xong mật khẩu
                            window.location.replace(<?php header("Location: ../../../../login.php"); ?>);
                        </script>
                    <?php
                    }
                    // nếu 2 mật khẩu không giống nhau trở về trang cũ

                } else {
                    ?>
                    <script>
                        alert("Mật khẩu không khớp");
                        window.history.go(-1);
                    </script>
                <?php
                }
                // nếu để trống mật khẩu trở về trang cũ
            } else {
                ?>
                <script>
                    alert("Không được để trống mật khẩu");
                    window.history.go(-1);
                </script>
            <?php
            }
            // nếu mật khẩu cũ không trùng khớp với mật khẩu đã được mã hóa trở về trang cũ
        } else {
            ?>
            <script>
                alert("Sai mật khẩu");
                window.history.go(-1);
            </script>
    <?php
        }
    }
    // nếu để trống mật khẩu cũ
} else {
    ?>
    <script>
        alert("Vui lòng nhập thông tin");
        window.history.go(-1);
    </script>
<?php
}
?>