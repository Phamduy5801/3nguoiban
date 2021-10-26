<?php

    if (isset($_GET['user_id'])) {
        //lấy id của người dùng
        $id = $_GET['user_id'];
    } else {
        //nếu không lấy được quay lại trang user.php
        header("Location: user.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include "../config/config.php";
   //câu lệnh sql
    $query = "delete from db_user where user_id = ?";
    //Tạo đối tượng repared
    $stmt = $conn->prepare($query);  
    //kiểm tra kết nối   
    if(!$conn->error) {
        //Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("d", $id);
        //thực thi câu lệnh sql
        $stmt->execute();
        //đóng câu lệnh sql
        $stmt->close();
        //đóng kết nối
        $conn->close();
        header("Location: user.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>
