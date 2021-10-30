<?php
    //kiểm tra st_id đưuọc khởi tạo hay chưa
    if (isset($_GET['st_id'])) {
        //lấy id student
        $id = $_GET['st_id'];
    } else {
        //nếu không lấy được quay lại trang student.php
        header("Location: dexuat-list-student.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include_once ("config/config.php");
   //câu lệnh sql
    $query = "delete from db_student where st_id = ?";
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
        //quay lại trang student
        header("Location: dexuat-list-student.php");
    } else {
        //nếu lõi hiển thị lỗi và đóng kết nối
        echo "Lỗi: ".$conn->error;
        $conn->close();
    }   
?>