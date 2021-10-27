<?php
    //kiểm tra tea_id đã được khởi tạo hay chưa
    if (isset($_GET['tea_id'])) {
        //gán $id  = tea_cher
        $id = $_GET['tea_id'];
    } else {
        //nếu không lấy được quay lại trang teacher.php
        header("Location: teacher.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
   //câu lệnh sql
    $query = "delete from db_teacher where tea_id = ?";
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
        //quay lại trang teacher
        header("Location: teacher.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>