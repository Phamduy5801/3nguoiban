<?php
    //kiểm tra sb_id đưuọc khởi tạo hay chưa
    if (isset($_GET['sb_id'])) {
        //tạo biến $id = giá trị của sb_id
        $id = $_GET['sb_id'];
    } else {
        //nếu không lấy được quay lại trang subject.php
        header("Location: subject.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
   //câu lệnh sql
    $query = "delete from db_subject where sb_id = ?";
    //Tạo đối tượng repare
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
        //quay lại trang subject
        header("Location: subject.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>