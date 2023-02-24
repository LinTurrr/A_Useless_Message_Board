<?php
session_start();
unset($_SESSION["username"]);
echo "<script>alert('登出成功！');window.location='login.php';</script>"; 
?>
