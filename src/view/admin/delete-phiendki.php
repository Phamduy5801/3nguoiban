<?php

    if (isset($_GET['id'])) {
        //lấy id của phiên đăng kí
        $id = $_GET['id'];
    } else {
        //nếu không lấy được quay lại trang phiên đăng kí
        header("Location: phien_dki.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
   //câu lệnh sql
    $query = "delete from phien_dkihoc where id = ?";
    //Tạo đối tượng repare
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
        //chuyềN về trang trang phiên đăng kíe 
        header("Location: phien_dki.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>