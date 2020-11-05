<?php
require("dbconnect.php");
$title=mysqli_real_escape_string($conn,$_POST['title']);
$msg=mysqli_real_escape_string($conn,$_POST['msg']);
$id=(int)$_POST['id'];
$urgent=mysqli_real_escape_string($conn,$_POST['urgent']);

if ($title) { //if title is not empty
	$sql = "update todo set title='$title', content='$msg', urgent='$urgent', addTime=NOW() where id=$id;";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
	$msg="Message updateded";
} else {
	$msg= "Message title cannot be empty";
}
header("Location: todoList.php?m=$msg");
?>