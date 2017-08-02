<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/17
 * Time: 11:08
 */

session_start();
require_once 'phpClass/MySQL.class.php';

$db = MySQL::getObj('localhost','root','root','nigel');

//分页获取别人发给自己的信息
$albumArr = [
    'code'=>-1,
    'msg'=>"",
    'info'=>[]          //获取到的结果
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];  //当前用户
}else{
    $albumArr['code'] = 2;//需要重新登录
    $albumArr['msg'] = "login timeout,please login again";
    echo json_encode($albumArr);
    exit();
}

$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"*",
];

$result = $db->fetchAll('album',$config);
if($result){
    $albumArr['code'] = 0;//成功获取到分页数据
    $albumArr['msg'] = "success";
    foreach ($result as $key => $value){
        $albumArr['info'][] = $value;
    }
}

echo json_encode($albumArr);


