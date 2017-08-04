<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/17
 * Time: 16:57
 */

session_start();
require_once "phpClass/MySQL.class.php";

$db = MySQL::getObj('localhost','root','root','nigel');

$deleteArr = [
    'code'=>-1,
    'msg'=>""
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $deleteArr['code'] = 2;//需要重新登录
    $deleteArr['msg'] = "login timeout,please login again";
    echo json_encode($deleteArr);
    exit();
}

$photoName = $_GET['photoName'];
$photoArr = explode('/',$photoName,2);
$dirPathImg = '../img/'.$photoArr[1];
//删除指定目录下的照片
$flag = unlink($dirPathImg);
if($flag){
    $deleteArr['code'] = 0;
    $deleteArr['msg'] = "delete successs";
}
echo json_encode($deleteArr);