<?php
require("dbconnect.php");

function addJob($jobProfile){
    // check the $jobProfile first (是否合法，有沒有缺東西)

    // insert into DB with $jobProfile

    // return T/F
}

function cancelJob($jobID){
    // check the $jobID first (是否合法，有沒有缺東西)

    // 1. delete the job with $jobID from DB
    // 2. update the job's status to cancel
    // (兩種做法)

    // return T/F
}

function updateJob($jobID ,$jobProfile){

}

function getJobList($jobID, $jobProfile){

}
function setFinished(){

}

function rejectJob(){

}

function setClosed(){

}


if ($title) { //if title is not empty
	$sql = "insert into todo (title, content, urgent,status, addTime) values ('$title', '$msg','$urgent',0, NOW());";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
	echo "Message added";
} else {
	echo "Message title cannot be empty";
}

?>
<a href="todoList.php">Back</a>