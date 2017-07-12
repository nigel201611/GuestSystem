<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/12
 * Time: 19:46
 */
header('content-type:application/json;');
session_start();
require_once 'phpClass/MySQL.class.php';
date_default_timezone_set('prc');

$content = $_POST['content'];
$to_user = $_POST['to_user'];

$insertRsp = ['code'=>-1,'msg'=>""];

//
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $from_user = $_SESSION['username'];
}else{
    $insertRsp['code'] = 2;
    $insertRsp['msg'] = "login timeout,please login again";
    echo json_encode($insertRsp);
    exit;
}
$datetime = date("Y:m:d H:i:s");
$conn = new MySQL('localhost','root','root','nigel');

$data = ['to_user'=>$to_user,'from_user'=>$from_user,'message_date'=>$datetime,'message_content'=>$content];
//添加消息
$num = $conn->insert('message',$data);


if($num == 1){
    $insertRsp['code'] = 1;
    $insertRsp['msg'] = "insert success";
}else{
    $insertRsp['code'] = -1;
    $insertRsp['msg'] = "insert failed";
}

echo json_encode($insertRsp);




