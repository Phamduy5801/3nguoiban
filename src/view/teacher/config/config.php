<?php
const Host = 'localhost';
const User = 'root';
const Pass = '';
const DB = 'projectcuoiki';
$conn = mysqli_connect(Host, User, Pass, DB);
if (!$conn) {
    die('Không thể kết nối');
} else {
    // echo "Kết nối thành công";
}