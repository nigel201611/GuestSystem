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
$to_user = $_POST['flowerCount'];

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
$conn = MySQL::getObj('localhost','root','root','nigel');

$data = [
    'to_user'=>$to_user,
    'from_user'=>$from_user,
    'flower_date'=>$datetime,
    'flower_content'=>$content
];
//添加消息
$num = $conn->insert('flower',$data);


if($num == 1){
    $insertRsp['code'] = 1;
    $insertRsp['msg'] = "send success";
}else{
    $insertRsp['code'] = -1;
    $insertRsp['msg'] = "send failed";
}

echo json_encode($insertRsp);






