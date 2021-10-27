<?php
const SITEADURL = 'http://localhost/3nguoiban/src/view/admin/';
const SITESDURL = 'http://localhost/3nguoiban/src/view/student/';
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
?>