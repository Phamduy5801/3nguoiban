<?php
session_start();
include('../../../config/config.php');
$username = $_SESSION['student'];
$oldpass = $_POST['oldpass'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
if ($oldpass != null) {
    $sql = "SELECT `password` from db_user where username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $dbpass = $row['password'];
        }
        if ($oldpass == $dbpass) {
            $finalpass = $pass1;
            if ($pass1 != null) {
                if ($pass1 == $pass2) {
                    $sql1 = "UPDATE db_user set `password` = '$finalpass' where username = '$username'";
                    $result1 = mysqli_query($conn, $sql1);
                    if ($result1 == true) {
?>
                        <script>
                            window.location.replace(<?php header("Location: ../../../../login.php"); ?>);
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Mật khẩu không khớp");
                        window.history.go(-1);
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Không được để trống mật khẩu");
                    window.history.go(-1);
                </script>
                <?php
            }
        } else if (password_verify($oldpass, $dbpass)) {
            $finalpass = password_hash($pass1, PASSWORD_DEFAULT);
            if ($pass1 != null) {
                if ($pass1 == $pass2) {
                    $sql1 = "UPDATE db_user set `password` = '$finalpass' where username = '$username'";
                    $result1 = mysqli_query($conn, $sql1);
                    if ($result1 == true) {
                ?>
                        <script>
                            window.location.replace(<?php header("Location: ../../../../login.php"); ?>);
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Mật khẩu không khớp");
                        window.history.go(-1);
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Không được để trống mật khẩu");
                    window.history.go(-1);
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Sai mật khẩu");
                window.history.go(-1);
            </script>
    <?php
        }
    }
} else {
    ?>
    <script>
        alert("Vui lòng nhập thông tin");
        window.history.go(-1);
    </script>
<?php
}
?>