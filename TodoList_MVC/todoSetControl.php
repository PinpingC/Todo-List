<?php
require("todoModel.php");

$msgID=(int)$_GET['id'];
$act =$_GET['act'];
// 預設訊息
$msg = "Message:$msgID, Action: $act completed.";
// 做檢查 正常狀況 id 不會小於 0
if ($msgID>0) {
    switch($act) {
        case 'finish':
            // call model API
            setFinished($msgID);
            // $sql = "update todo set status = 1, finishTime=NOW() where id=$msgID and status = 0;";
            break;
        case 'reject':
            rejectJob($msgID);
            //$sql = "update todo set status = 0 where id=$msgID and status = 1;";
            break;
        case 'close':
            setClosed($msgID);
            // $sql = "update todo set status = 2 where id=$msgID and status = 1;";
            break;
        case 'cancel':
            cancelJob($msgID);
            // $sql = "update todo set status = 3 where id=$msgID and status <> 2;";
            break;
        // 如果要做的動作沒有在上面的話，回傳一個訊息
        default:
        $msg="Invalid action. Ignored.";
            break;
    }
}
header("Location: todoView.php?m=$msg");
?>

