<head>
	<title>简陋注册页面</title>
	<meta charset="utf-8">

</head>

<form action="" method="post">
 	<p>用户: <input type="text" name="username" /></p>
 	<p>密码: <input type="password" name="password" /></p>
 	<p><input type="submit" name="login" value="注册"/></p>
</form>
<a href = "login.php">点我返回</a>


<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting (E_ERROR);ini_set ("display_errors","Off");
session_start();
require("sql.php");

function xss_clean($data)
{
    // 先去除可能存在的转义字符
    $data = stripslashes($data);
    //使用htmlspecialchars函数过滤用户输入
    $data = htmlspecialchars($data);
    // 再过滤不安全的HTML标签
    $data = strip_tags($data);
    // 再过滤不安全的JS代码
    $data = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $data);
    // 返回安全的数据
    return $data;
}

$username=xss_clean($_POST['username']);
$password=xss_clean($_POST['password']);
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

// $sql="insert into user(username,password) values('$username','$password')";
$sql_n="select username from user where username='$username'";
$sql_p="select password from user where and password='$password'";

$result_n=mysqli_query($db,$sql_n);
$n=mysqli_fetch_array($result_n);

// $result_p=mysqli_query($db,$sql_p);
// $p=mysqli_fetch_array($result_p);

$username = $_POST['username'];
$password = $_POST['password'];
// if($a['username']==$username){
// 	echo "<script>alert('该用户名已被注册！');;</script>";
// }else{
// 	echo "<script>alert('注册成功');;</script>";
// }
if(!empty($_POST['username'])){

    if($n['username']!=$username){
        if(!empty($_POST['password'])){
                $insert=mysqli_query($db,"insert into user (username,password) values('$username','$password')");
                echo "<script>alert('注册成功！');window.location='login.php';</script>";
        }else{
            echo "<script>alert('输入不能为空')</script>";
        }
    }else{
        echo "<script>alert('该用户名已被注册！')</script>";
    }
}
?>

