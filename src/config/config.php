<?php 
	const Host = 'localhost:3306';
    const User = 'root';
    const Pass = '12345678';
    const DB = 'projectcuoiki';
	$conn = mysqli_connect(Host, User, Pass, DB);
    if (!$conn) {
        die('Không thể kết nối');
    } else {
		echo "Kết nối thành công";
    }
?>
