<?php 
//1.清除所有的session
session_start();
session_destroy();
//2.跳转到login.php页面
header('location:login.html');
?>