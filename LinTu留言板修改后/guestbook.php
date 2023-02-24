<head>
	<title>简陋留言板</title>
	<meta charset="utf-8">
</head>
	<p>你好捏。。。要写点什么不。。。？</p>

<form action="" method="post">
	<p>你的名字: <input type="text" name="id" /></p>
	<p>写点什么: <input type="text" name="message" style="width:500px; height:200px;" /></p>
	<p><input type="submit" name="login" value="提交"/></p>
</form>

<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting (E_ERROR);ini_set ("display_errors","Off");
session_start();
require("sql.php");

// if(!isset($_SESSION['username'])){
//     //未登录
//     echo "您还未登录，请先登录！";
//     echo "<a href='login.php'>登入</a><br><br>";
//     exit;
// }
// 不知道为什么无论如何都只能显示未登入。。。随缘吧。。。

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

$id=xss_clean($_POST['id']);
$message=xss_clean($_POST['message']);

// $sql="select message from guestbook where message='$message'";
$result=mysqli_query($db,"select * from guestbook");
$a=mysqli_fetch_array($result);

$datarow = mysqli_num_rows($result);

if($message!='' && $id!=''){
	// 预处理SQL语句，防止SQL注入攻击
    $stmt = mysqli_prepare($db, "INSERT INTO comments (id, message) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ss', $id, $message);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
//($db,"insert into guestbook (id,message) values ('\',',database())");#') ");

echo "<a href='123.php'>登出</a><br><br>";
echo "<span style='font-size: 32px'>一些前人留言。。</span><br><br>";

for($i=$datarow;$i>= 0;$i--){
	$sql_arr = mysqli_fetch_assoc($result);
	$id = $sql_arr['id'];
	$message = $sql_arr['message'];
	if($id!=''){
		echo "$id 说 $message<br>";
	}
	
}
// while($sql_arr = mysqli_fetch_assoc($result)){
// 	echo $sql_arr['message'].'<br/>';
// }

?>
<a href = "guestbook.php">刷新一下</a>
