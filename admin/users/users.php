<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php 
//1.连接数据库
include "../include/mysql.php";
//2.编写SQL语句并执行
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;//当前页号
$pagesize = 3;//每页显示数量
$start = ($pageno - 1) * $pagesize;
$sql = "select * from ali_user limit $start,$pagesize";
$res = mysql_query($sql);
// var_dump($res);

//获取总条数
$sql = "select count(*) as num from ali_user";
$res1 = mysql_query($sql);
$tmp = mysql_fetch_assoc($res1);
$count = $tmp['num'];
$pages = ceil($count / $pagesize);
// var_dump($pages);
?>
  <div class="main">
    <?php 
    include "./include/nav.php";
    ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input type="button" value="添加新用户" onclick="adduser()">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-12">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row=mysql_fetch_assoc($res)):?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>
                <td><?=$row['user_email']?></td>
                <td><?=$row['user_slug']?></td>
                <td><?=$row['user_nickname']?></td>
                <td><?=$row['user_state']==1?'激活':'未激活'?></td>
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php endwhile;?>
            </tbody>
          </table>
          <ul class="pagination pagination-sm pull-right">
            <li><a href="users.php?pageno=1">首页</a></li>
            <li><a href="users.php?pageno=<?=$pageno==1?1:$pageno-1?>">上一页</a></li>
            <?php for($i=1;$i<=$pages;$i++):?>
            <li><a href="users.php?pageno=<?=$i?>"><?=$i?></a></li>
            <?php endfor;?>
            <li><a href="users.php?pageno=<?=$pageno==$pages?$pages:$pageno+1?>">下一页</a></li>
            <li><a href="users.php?pageno=<?=$pages?>">尾页</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include "../include/aside.php"; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/layer/layer.js"></script>
  <script>NProgress.done()</script>
  <script>
  function adduser(){
    layer.ready(function(){
      layer.open({
        type:2,
        title:'弹出层测试',
        maxmin:false,
        area:['800px','550px'],
        content:'adduser.html'
      })
    })
  }
  </script>
</body>
</html>