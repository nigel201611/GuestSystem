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

$id = $_GET['id'];
$where = " id={$id}";

$num = $db->delete('album',$where);
if($num>0){
    $deleteArr['code'] = 0;
    $deleteArr['msg'] = "delete successs";
}
echo json_encode($deleteArr);