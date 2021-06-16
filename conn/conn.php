<?php
$conn = mysqli_connect("localhost","root","","mail") or die("数据库服务器连接失败！".mysqli_error($conn));
mysqli_query($conn,"set names utf-8");
?>