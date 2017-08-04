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


$modifyRsp = ['code'=>-1,'msg'=>""];
$datetime = date("Y:m:d H:i:s");
$conn = MySQL::getObj('localhost','root','root','nigel');

if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $modifyRsp['code'] = 2;
    $modifyRsp['msg'] = "login timeout,please login again";
    echo json_encode($modifyRsp);
    exit;
}

$id = $_GET['id'];//相册id
$photoName = $_GET['photoName'];//相册id
if(!isset($id)){
    $modifyRsp['msg'] = 'not exist album id';
    exit;
}
//设置指定id相册的缩略图album_thumbnail
$data = [
    'thumbnail_option'=>2,
    'album_modify_cover_time'=>$datetime,
    'album_thumbnail'=>$photoName
];
$where = 'id=\''.$id.'\'';
//添加消息
$num = $conn->update('album',$data,$where);
if($num == 1){
    $modifyRsp['code'] = 0;
    $modifyRsp['msg'] = "modify success";
}else{
    $modifyRsp['code'] = -1;
    $modifyRsp['msg'] = "modify failed";
}

echo json_encode($modifyRsp);




