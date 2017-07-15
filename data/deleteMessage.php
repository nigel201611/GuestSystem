<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/15
 * Time: 15:29
 */
session_start();
require_once "phpClass/MySQL.class.php";

$db = MySQL::getObj('localhost','root','root','nigel');

$messageArr = [
    'code'=>-1,
    'msg'=>""
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];
}else{
    $messageArr['code'] = 1;//需要重新登录
    $messageArr['msg'] = "login timeout,please login again";
    echo json_encode($messageArr);
    exit();
}

$ids = $_GET['ids'];

$idsArr = explode(',',$ids);
$where = "";
if(count($idsArr) > 1){
    for($i=0;$i<count($idsArr)-1;$i++){
        $where .= " id={$idsArr[$i]} or ";
    }
    $where .= " id={$idsArr[$i]}";
}else{
    $where .= " id={$ids}";
}

$num = $db->delete('message',$where);
if($num>0){
    $messageArr['code'] = 0;
    $messageArr['msg'] = "delete successs";
}
echo json_encode($messageArr);