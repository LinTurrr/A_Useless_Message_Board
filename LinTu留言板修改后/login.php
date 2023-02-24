<head>
	<title>简陋登录页面</title>
	<meta charset="utf-8">
</head>
	<p>你懂什么大道至简（目移）</p>
	<p>页面简陋一些也没什么吧（悲）</p>

<form action="" method="post">
	<p>用户: <input type="text" name="username" /></p>
	<p>密码: <input type="password" name="password" /></p>
	<p><input type="submit" name="login" value="登录"/></p>
</form>
<a href = "register.php">立即注册</a>

<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting (E_ERROR);ini_set ("display_errors","Off");
session_start();
require("sql.php");

$username=$_POST['username'];
$password=$_POST['password'];

$sql="select username,password from user where username='$username' and password='$password'";
$result=mysqli_query($db,$sql);
$a=mysqli_fetch_array($result);

if($username!='' && $password!=''){
	if($a['username']==$username ){
		echo "<script>alert('登录成功！');window.location='guestbook.php';</script>";
	}else{
		echo "<script>alert('密码错误或未注册')</script>";
		}
}else{
	echo "输入不能为空。。（远目）";
}

?>
