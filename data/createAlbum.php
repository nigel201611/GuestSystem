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




$insertRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $insertRsp['code'] = 2;
    $insertRsp['msg'] = "login timeout,please login again";
    echo json_encode($insertRsp);
    exit;
}
$datetime = date("Y:m:d H:i:s");
$conn = MySQL::getObj('localhost','root','root','nigel');

//创建一个相册目录
$dir = "../img/";
$albumDir = date("YmdHis");
if( !file_exists($albumDir) ){
    mkdir($dir.$albumDir,'0777');
}

$data = [
    'album_name'=>$albumName,
    'album_content'=>$albumContent,
    'album_create_time'=>$datetime,
    'album_type'=>$choose_type,
    'album_dir'=>$albumDir
];


//添加消息
$num = $conn->insert('album',$data);
if($num == 1){
    $insertRsp['code'] = 1;
    $insertRsp['msg'] = "insert success";
}else{
    $insertRsp['code'] = -1;
    $insertRsp['msg'] = "insert failed";
}

echo json_encode($insertRsp);




