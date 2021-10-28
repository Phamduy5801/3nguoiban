<?php
const SITEADURL = 'http://localhost/3nguoiban/src/view/admin/';
const SITESDURL = 'http://localhost/3nguoiban/src/view/student/';
const Host = 'localhost';
const User = 'root';
const Pass = '';
const DB = 'projectcuoiki';
$conn = new mysqli(Host, User, Pass, DB);
if (!$conn) {
    die('Không thể kết nối'.$conn->connectio_error);
}
?>