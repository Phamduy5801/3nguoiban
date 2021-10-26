<?php

    if (isset($_GET['ma_khoa'])) {
        //lấy mã khoa
        $id = $_GET['ma_khoa'];
    } else {
        //nếu không lấy được quay lại trang khoa.php
        header("Location: khoa.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include "../config/config.php";
   //câu lệnh sql
    $query = "delete from db_khoa where ma_khoa = ?";
    //Tạo đối tượng repared
    $stmt = $conn->prepare($query);  
    //kiểm tra kết nối   
    if(!$conn->error) {
        //Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("s", $id);
        //thực thi câu lệnh sql
        $stmt->execute();
        //đóng câu lệnh sql
        $stmt->close();
        //đóng kết nối
        $conn->close();
        header("Location: khoa.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>
