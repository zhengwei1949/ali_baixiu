<?php
//1.连接数据库
$link = @mysql_connect('localhost','root','root') or die('数据库连接失败');
@mysql_query('set names utf8');
@mysql_query('use alishow');
?>