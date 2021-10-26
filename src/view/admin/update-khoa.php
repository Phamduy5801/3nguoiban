<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Cập nhật thông tin</h1>
        <br>
        <?php
        if (isset($_GET['ma_khoa'])) {
            $id = $_GET['ma_khoa'];
        } else {
            header("Location: khoa.php");
        }
        include "../config/config.php";
        $conn = new mysqli($hn, $username, $password, $db);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $caulenh = "Select * from db_khoa where ma_khoa=?";
        $stmt = $conn->prepare($caulenh);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            die($conn->error);
        }
        $khoa = $result->fetch_array(MYSQLI_BOTH);
        $result->close();
        $conn->close();
        ?>

        <div class="container">

            <form method="POST" action="update-khoa.php?ma_khoa=<?php echo $id ?>" enctype="multipart/form-data">

                Mã khoa: <input class="form-control" type="text" name="ma_khoa" value="<?php echo $khoa['ma_khoa'] ?>" /><br>
                Tên khoa: <input class="form-control" type="text" name="ten_khoa" value="<?php echo $khoa['ten_khoa'] ?>" /><br>
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
if (isset($_REQUEST['ma_khoa']) && isset($_REQUEST['ten_khoa'])) {
    $id = $_GET['ma_khoa'];

    include "../config/config.php";
   
    $query = "update db_khoa set ma_khoa = ?, ten_khoa = ? where ma_khoa = ?";
    $stmt = $conn->prepare($query);

    $ma_khoa = $_POST['ma_khoa'];
    $ten_khoa = $_POST['ten_khoa'];

    $stmt->bind_param("sss", $ma_khoa, $ten_khoa, $ma_khoa);
    $stmt->execute();
    $conn->close();
    header("Location: khoa.php");
}
?>