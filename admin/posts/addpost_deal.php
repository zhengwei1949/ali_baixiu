<?php 
header('content-type:text/html;charset=utf8');

// print_r($_POST);
// echo '<br>';
// print_r($_FILES);
//1.接收表单数据
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$created = strtotime($_POST['created']);
$status = $_POST['status'];

//手动补充表单中没有的数据
$desc = substr($content,0,300);
session_start();
$author = $_SESSION['id'];
$updtime = $created;
$click = mt_rand(300,800);
$good = mt_rand(200,300);
$bad = mt_rand(5,200);

//0代表没有错误发生，文件上传成功。 
$upfile_path = '';
if($_FILES['feature']['error'] == 0){
    $ext = strrchr($_FILES['feature']['name'],'.');
    $upfile_path = '../../uploads/'.time().$ext;
    move_uploaded_file($_FILES['feature']['tmp_name'],$upfile_path);
}

include "../include/mysql.php";
$sql = "insert into ali_post values(null,'$title','$slug','$desc','$content','$author','$category','$upfile_path','$created','$updtime',$click,$good,$bad,'$status')";
// echo $sql;
mysql_query($sql);

//根据影响行数进行跳转
$num = mysql_affected_rows($link);
if($num > 0){
    echo "添加新文章成功";
    header('refresh:2;url=posts.php');
}else{
    echo "添加文章失败";
    header('refresh:2;url=addpost.php');
}