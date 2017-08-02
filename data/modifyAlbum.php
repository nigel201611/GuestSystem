<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/16
 * Time: 15:06
 */

header('content-type:application/json;');
session_start();
require_once 'phpClass/MySQL.class.php';
date_default_timezone_set('prc');

@$albumName = $_POST['albumName'];
@$albumContent = $_POST['albumContent'];
@$choose_type = $_POST['choose_type'];
$id = $_POST['id'];//相册id



$modifyRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $modifyRsp['code'] = 2;
    $modifyRsp['msg'] = "login timeout,please login again";
    echo json_encode($modifyRsp);
    exit;
}
$datetime = date("Y:m:d H:i:s");
$conn = MySQL::getObj('localhost','root','root','nigel');

//创建一个相册目录

$data = [
    'album_name'=>$albumName,
    'album_content'=>$albumContent,
    'album_type'=>$choose_type,
];

$where = 'id=\''.$id.'\'';
//添加消息
$num = $conn->update('album',$data,$where);
if($num == 1){
    $modifyRsp['code'] = 1;
    $modifyRsp['msg'] = "modify success";
}else{
    $modifyRsp['code'] = -1;
    $modifyRsp['msg'] = "modify failed";
}

echo json_encode($modifyRsp);




