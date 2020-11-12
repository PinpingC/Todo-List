<?php
// 很底層共用的東西
require_once("dbconnect.php");

function addJob($title, $msg, $urgent){
    global $conn;
	$sql = "insert into todo (title, content,urgent, addTime) values ('$title','$msg', '$urgent', NOW());";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
    // check the $jobProfile first (是否合法，有沒有缺東西)

    // insert into DB with $jobProfile

    // return T/F
}

function cancelJob($jobID){
    global $conn;
    $sql = "update todo set status = 3 where id=$jobID and status <> 2;";
    // 執行資料庫 (資料庫去執行操作)
    mysqli_query($conn,$sql);
    // check the $jobID first (是否合法，有沒有缺東西)

    // 1. delete the job with $jobID from DB
    // 2. update the job's status to cancel
    // (兩種做法)

    // return T/F
}

// 新增工作
function updateJob($id, $title, $msg ,$urgent){
    global $conn;
    if ($id== -1) {
		addJob($title,$msg, $urgent);
	} else {
		$sql = "update todo set title='$title', content='$msg', urgent='$urgent' where id=$id;";
		mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
	}
}

// 取得所有工作清單
function getJobList($bossMode){
    // 需要用到其他model定義的變數，所以要加上 global
    global $conn;
    if ($bossMode) {
        // 老闆工作清單資料
        $sql = "SELECT *, TIME_TO_SEC(TIMEDIFF(NOW(), addTime)) diff FROM todo ORDER BY `status`, `urgent` DESC;";
    } else { // 員工工作清單資料
        $sql = "SELECT *, TIME_TO_SEC(TIMEDIFF(NOW(), addTime)) diff FROM todo where status = 0;";
    }

    $result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message. getJobList");
    return $result;
}

// 將工作設為已完成
function getJobDetail($id){
    global $conn;
    if ($id == -1) { //-1 stands for adding a new record
        $rs=[
            "id" => -1,
            "title" => "new title",
            "content" => "job description",
            "urgent" => "一般"
        ];
    } else {
        $sql = "select id, title, content, urgent from todo where id=$id;";
        $result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message. getJobDetail");
        $rs=mysqli_fetch_assoc($result);
    }
    return $rs;
}
function setFinished($jobID){
    global $conn;
    $sql = "update todo set status = 1, finishTime=NOW() where id=$jobID and status = 0;"; // 資料庫寫法
    mysqli_query($conn,$sql) or die("MySQL query error"); // 執行SQL
}

// 退回以完成的工作
function rejectJob($jobID){
    global $conn;
    $sql = "update todo set status = 0 where id=$jobID and status = 1;";
    mysqli_query($conn,$sql);
}

// 已經完工的工作
function setClosed($jobID){
    global $conn;
    $sql = "update todo set status = 2 where id=$jobID and status = 1;";
    mysqli_query($conn,$sql);
}

?>