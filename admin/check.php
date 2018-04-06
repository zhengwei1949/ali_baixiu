<?php 
header('content-type:text/html;charset=utf8');
//1. 接收表单提交的验证码
$user_code = $_POST['code'];
//2. 从session中获取系统产生的验证码
session_start();
$sys_code = $_SESSION['code'];
//3. 判断两个验证码是否一致
if($user_code != $sys_code){
    echo "验证码错误";
    header('refresh:2;url=login.html');
    die();
}

//4. 接收表单提交的用户名和密码
$name = $_POST['email'];
$pwd = $_POST['pwd'];

//5. 连接数据库
include 'include/mysql.php';

//6. 编写SQL语句
$sql = "select * from ali_user where user_email = '$name'";
$res = mysql_query($sql);
$user_info = mysql_fetch_assoc($res);

if($user_info['user_pwd'] == md5($pwd)){
    $_SESSION['id'] = $user_info['user_id'];
    $_SESSION['email'] = $user_info['user_email'];
    $_SESSION['nickname'] = $user_info['user_nickname'];
    echo "登录成功";
    header('refresh:2;url=index.php');
}else{
    echo "用户名或密码失败";
}
?>