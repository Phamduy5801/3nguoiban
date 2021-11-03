<?php
const Host = 'localhost';
const User = 'root';
const Pass = '';
const DB = 'projectcuoiki';
$conn = new mysqli(Host, User, Pass, DB);
if (!$conn) {
    die('Không thể kết nối'.$conn->connectio_error);
}
?>