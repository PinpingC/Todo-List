<?php
session_start();
require("userModel.php");

$userName = $_POST['id'];
$passWord = $_POST['pwd'];

if (checkUserIDPwd($userName, $passWord)) {
	$_SESSION['uID'] = $userName;
	header("Location: todoView.php");
} else {
	$_SESSION['uID']="";
	header("Location: loginForm.php");
}
?>