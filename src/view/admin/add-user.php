<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Thêm mới người sử dụng</h1>
        <br><br>
        <div class="container">

            <form method="POST" action="add-user.php" enctype="multipart/form-data">

                Username: <input class="form-control" type="text" name="username"/><br>
                Password: <input class="form-control" type="password" name="password" /><br>
                Email: <input class="form-control" type="text" name="email" /><br>
                Role:
                <select class="form-select form-control" name="role_id" aria-label="Default select example">
                    <?php
                    include "../config/config.php";
                    $conn = new mysqli($hn, $username, $password, $db);
                    if ($conn->connect_error) {
                        die($conn->connect_error);
                    }

                    $query = "Select role_id, role_name from role";
                    $result = $conn->query("$query");
                    if (!$result) {
                        die($conn->error);
                    }
                    $role = array();
                    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                        $role[] = $r;
                    }

                    foreach ($role as $ro) {
                    ?>
                        <option value="<?php echo $ro['role_id'] ?>"><?php echo $ro['role_name'] ?></option>
                    <?php
                   
                    }
                    ?>
                </select>

                <br></br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>

<?php
if (isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['email']) && isset($_REQUEST['role_id'])) {
    
    //kết nối sql
    include "../config/config.php";
    $conn = new mysqli($hn, $username, $password, $db);
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
    //câu lệnh sql
    $query = "INSERT INTO `db_user` (`username`, `password`, `email`, `role_id`) VALUES (?,?,?,?);";
    $stmt = $conn->prepare($query);

    //lấy dữ liệu từ form
    $id = $_GET['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role_id'];

    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bind_param('ssss', $username, $pass_hash, $email, $role);
    $stmt->execute();
    $conn->close();
    header("Location: user.php");
}
?>