<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/17
 * Time: 10:28
 */

header('content-type:application/json;');
session_start();
require_once 'phpClass/MySQL.class.php';
date_default_timezone_set('prc');

@$to_user = $_POST['to_user'];

$isFriendRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $from_user = $_SESSION['username'];
    //加的时候，需要判断是否已经是好友，已经是好友或者还处于验证状态，就没必要加了
    $config = [
        'fileds'=>'friend_state',
        'where'=>"(to_user='{$to_user}' and from_user='{$from_user}') or (to_user='{$from_user}' and from_user='{$to_user}') ",
        'mode'=>MYSQLI_ASSOC
    ];
}else{
    $isFriendRsp['code'] = 2;
    $isFriendRsp['msg'] = "login timeout,please login again";
    echo json_encode($insertRsp);
    exit;
}
$conn = MySQL::getObj('localhost','root','root','nigel');
$result = $conn->fetchAll('friend',$config);
if( count($result)>=1){
    $isFriendRsp['code'] = 3;
    $isFriendRsp['msg'] = "your have been friends,can't repeat add";
    echo json_encode($isFriendRsp);
    exit;
}else{
    $isFriendRsp['code'] = 0;
    $isFriendRsp['msg'] = "not been friend";
    echo json_encode($isFriendRsp);
}



