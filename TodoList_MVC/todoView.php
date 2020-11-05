<?php
session_start();
require("dbconnect.php");
require("todoModel.php");
if (isset($_GET['m'])){
	$msg="<font color='red'>" . $_GET['m'] . "</font>";
} else {
	$msg="Good morning";
}

// 以下可以利用 bossmode 來塞選很多東西
if (isset($_GET['boss'])){
    // boss 弄的網頁
    $bossMode = (int)$_GET['boss'];
} else {
    $bossMode=0;
}

$result = getJobList($bossMode);
$jobStatus = array('未完成','已完成','已結案','已取消');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>my Todo List !! </p>
<hr />
<div><?php echo $msg; ?></div><hr>
<a href="todoRpt.php">工作報表</a> | <a href="todoAddForm.php">Add Task</a> <br>
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>message</td>
	<td>Urgency</td>
    <td>status</td>
	<td>time used</td>
	<td>-</td>
  </tr>
<?php

while (	$rs=mysqli_fetch_assoc($result)) {
	switch($rs['urgent']) {
		case '緊急':
			$bgColor="#ff9999";
			$timeLimit = 60;
			break;
		case '重要':
			$bgColor="#99ff99";
			$timeLimit = 120;
			break;
		default:
			$bgColor="#ffffff";
			$timeLimit = 180;
			break;
	}

	if ($rs['diff']>$timeLimit) {
		$fontColor="red";
	} else {
		$fontColor="black";
	}

	echo "<tr style='background-color:$bgColor;'><td>" . $rs['id'] . "</td>";
	echo "<td>{$rs['title']}</td>";
	echo "<td>" , htmlspecialchars($rs['content']), "</td>";
	echo "<td>" , htmlspecialchars($rs['urgent']), "</td>";
	echo "<td>{$jobStatus[$rs['status']]}</td>" ;
	echo "<td><font color='$fontColor'>{$rs['diff']}</font></td><td>";
	switch($rs['status']) {
		case 0:
			if ($bossMode) {
				echo "<a href='todoEditForm.php?id={$rs['id']}'>Edit</a>  ";
				echo "<a href='todoSet.php?act=cancel&id={$rs['id']}'>Cancel</a>  " ;
			} else {
				echo "<a href='todoSetControl.php?act=finish&id={$rs['id']}'>Finish</a>  ";
			}

			break;
		case 1:
			echo "<a href='todoSet.php?act=reject&id={$rs['id']}'>Reject</a>  ";
			echo "<a href='todoSet.php?act=close&id={$rs['id']}'>Close</a>  ";
			break;
		default:
			break;
	}
	echo "</td></tr>";
}
?>
</table>
</body>
</html>
