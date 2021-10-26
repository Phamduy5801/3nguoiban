<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Cập nhật thông tin</h1>
        <br>
        <?php
        if (isset($_GET['user_id'])) {
            $id = $_GET['user_id'];
        } else {
            header("Location: user.php");
        }
        include "../config/config.php";
        $conn = new mysqli($hn, $username, $password, $db);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $caulenh = "Select * from db_user where user_id=?";
        $stmt = $conn->prepare($caulenh);
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            die($conn->error);
        }
        $user = $result->fetch_array(MYSQLI_BOTH);
        $result->close();
        $conn->close();
        ?>

        <div class="container">

            <form method="POST" action="update-user.php?user_id=<?php echo $id ?>" enctype="multipart/form-data">

                Username: <input class="form-control" type="text" name="username" value="<?php echo $user['username'] ?>" /><br>
                Email: <input class="form-control" type="text" name="email" value="<?php echo $user['email'] ?>" /><br>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>
<?php
if (isset($_REQUEST['username']) && isset($_REQUEST['email'])) {
    $id = $_GET['user_id'];

    include "../config/config.php";
    $conn = new mysqli($hn, $username, $password, $db);
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
    $query = "update db_user set username = ?, email = ? where user_id = ?";
    $stmt = $conn->prepare($query);

    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt->bind_param("ssd", $username, $email, $id);
    $stmt->execute();
    $conn->close();
    header("Location: user.php");
}
?>