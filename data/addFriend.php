<?php
/**
 * Created by PhpStorm.
 * User: danei-php
 * Date: 2017/7/16
 * Time: 15:06
 */

header('content-type:application/json;');
session_start();
require_once 'phpClass/MySQL.class.php';
date_default_timezone_set('prc');

@$content = $_POST['content'];
@$to_user = $_POST['to_user'];

//加的时候，需要判断是否已经是好友，已经是好友，就没必要加了


$insertRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $from_user = $_SESSION['username'];
}else{
    $insertRsp['code'] = 2;
    $insertRsp['msg'] = "login timeout,please login again";
    echo json_encode($insertRsp);
    exit;
}
$datetime = date("Y:m:d H:i:s");
$conn = MySQL::getObj('localhost','root','root','nigel');

$data = [
    'to_user'=>$to_user,
    'from_user'=>$from_user,
    'friend_date'=>$datetime,
    'friend_content'=>$content
];
//添加消息
$num = $conn->insert('friend',$data);
if($num == 1){
    $insertRsp['code'] = 1;
    $insertRsp['msg'] = "insert success";
}else{
    $insertRsp['code'] = -1;
    $insertRsp['msg'] = "insert failed";
}

echo json_encode($insertRsp);




