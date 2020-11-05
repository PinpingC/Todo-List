<?php
require("dbconnect.php");
$title=mysqli_real_escape_string($conn,$_POST['title']);
$msg=mysqli_real_escape_string($conn,$_POST['msg']);
$urgent=mysqli_real_escape_string($conn,$_POST['urgent']);

if ($title) { //if title is not empty
	$sql = "insert into todo (title, content, urgent,status, addTime) values ('$title', '$msg','$urgent',0, NOW());";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
	echo "Message added";
} else {
	echo "Message title cannot be empty";
}

?>
<a href="todoList.php">Back</a>