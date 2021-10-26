<?php

    if (isset($_GET['role_id'])) {
        //lấy id của người dùng
        $id = $_GET['role_id'];
    } else {
        //nếu không lấy được quay lại trang user.php
        header("Location: role.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include "../config/config.php";
   //câu lệnh sql
    $query = "delete from role where role_id = ?";
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
        header("Location: role.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>
