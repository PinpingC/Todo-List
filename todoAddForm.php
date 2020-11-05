<?php
session_start();
require("dbconnect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>
<body>
<h1>Add New Task</h1>
<form method="post" action="todoAdd.php">

      task title: <input name="title" type="text" id="title" /> <br>

      task description: <input name="msg" type="text" id="msg" /> <br>
	  
	  Urgent Level: <select  name="urgent" type="select" id="urgent" /> 
					<option value='一般'>一般</option>
					<option value='重要'>重要</option>
					<option value='緊急'>緊急</option>
					</select>
	  <br>

      <input type="submit" name="Submit" value="送出" />
	</form>
  </tr>
</table>
</body>
</html>
