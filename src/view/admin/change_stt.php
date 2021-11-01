<?php
    if (isset($_GET['id'])){
        //lấy id của phiên đăng kí học
        $id = $_GET['id'];
    } else {
        //nếu không lấy được quay lại trang phien_dki.php
        header("Location: phien_dki.php");
    }
    //gọi file kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
    
    $query = "select status from phien_dkihoc ";
    // thực thi câu lệnh sql
    $result = $conn->query($query);
    //kiểm tra sự tồn tại của $result
    if (!$result) {
        //nến không có thì die tại đây là hiển thị lỗi
        die($conn->error);
    }
    //khởi tạo $dkihoc = 1 mảng
    $dkihoc = array();
    //chạy vòng lặp để lấy dữ liệu theo từng hàng 
    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
        $dkihoc[] = $r;
    }
    //duyệt dữ liệu từ mảng gán vào biến $dki
    for ($i = 0; $i < count($dkihoc); $i++){
        $dki = $dkihoc[$i];
        if($dki['status']==0){
            //câu lệnh sql
            $query1 = "update phien_dkihoc set status = 1 where id = ?";
            //Tạo đối tượng repare
            $stmt = $conn->prepare($query1);  
            //kiểm tra kết nối   
            if(!$conn->error) {
            //Gán giá trị vào các tham số ẩn ('?')
            $stmt->bind_param("d", $id);
            //thực thi câu lệnh sql
            $stmt->execute();
            //đóng câu lệnh sql
            $stmt->close();
            }
        }else if ($dki['status']==1){
            //câu lệnh sql
            $query2 = "update phien_dkihoc set status = 0 where id = ?";
            //Tạo đối tượng repare
            $stmt = $conn->prepare($query2);  
            //kiểm tra kết nối   
            if(!$conn->error) {
            //Gán giá trị vào các tham số ẩn ('?')
            $stmt->bind_param("d", $id);
            //thực thi câu lệnh sql
            $stmt->execute();
            //đóng câu lệnh sql
            $stmt->close();
            }
        }
    }
        //đóng kết nối
        $conn->close(); 
        //chuyềN về trang role 
        header("Location: phien_dki.php");
?>