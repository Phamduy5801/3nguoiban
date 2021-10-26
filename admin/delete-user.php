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
    $query = "delete from db_user where user_id = ?";
    $stmt = $conn->prepare($query);     
    if(!$conn->error) {
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: user.php");
    } else {
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>
