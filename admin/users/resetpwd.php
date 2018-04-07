<?php 
header('content-type:text/html;charset=utf8');
include "../include/checksession.php";
//1.接收旧密码
$oldpwd = $_POST['oldpwd'];
//2. 连接数据库
include "../include/mysql.php";
//3. 编写SQL语句
//从session中取出user_id
$id = $_SESSION['id'];
$sql = "select * from ali_user where user_id = $id";
$res = mysql_query($sql);
$user_info = mysql_fetch_assoc($res);
//4.判断旧密码是否和数据库表中的密码一致
if(md5($oldpwd)!=$user_info['user_pwd']){
    echo "旧密码不正确";
    header('refresh:2;url=password-reset.php');
    die();
}else{
    //5.检测两次新密码是否一致
    if($_POST['newpwd']!=$_POST['re-newpwd']){
        echo "两次新密码不一致";
        header('refresh:2;url=password-reset.php');
    }else{
        // 6.两次新密码一致，则修改数据库表
        $newpwd = md5($_POST['newpwd']);
        $sql = "update ali_user set user_pwd = '$newpwd'";
        mysql_query($sql);
        $num = mysql_affected_rows($link);
        if($num > 0){
            echo "修改密码成功";
            header('refresh:2;url=profile.php');
            die();
        }else{
            echo "修改密码失败";
            header('refresh:2;url=password-reset.php');
            die();
        }
    }
}