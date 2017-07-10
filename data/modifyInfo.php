<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/8
 * Time: 11:57
 */

include_once 'common.php';
session_start();

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$qq = trim($_POST['qq']);
$personInfo = trim($_POST['personInfo']);

$arr = ['code'=>-1,'msg'=>""];

if(!isset($_SESSION['uniq']) && !isset($_SESSION['username']) ){ //不存在，那么重新登录
    $arr['code'] = 1; //
    $arr['msg'] = 'please login again';
    echo json_encode($arr);
    exit();
}
$uniq = $_SESSION['uniq']; //！！！,由于之前测试数据中，没有uniq值为空，所以造成读取为空的情况
$oldUsername = $_SESSION['username'];

$selectSql = "select uniq from user where username='$oldUsername'";
$result = mysqli_query($link,$selectSql);
$row = mysqli_fetch_assoc($result);

//更新之前先验证下uniq，
if( isset($row['uniq']) && $uniq == $row['uniq']){
    $updateSql = "update user set username='$username',email='$email',qq='$qq',person_info='$personInfo' where username='$oldUsername'";
    $result = mysqli_query($link,$updateSql);
    if($result){
        $num = mysqli_affected_rows($link);
        if($num == 1){
            //更新成功
            $arr['code'] = 0;
            $arr['msg'] = 'update success';
            $_SESSION['username'] = $username;
            $_SESSION['uniq'] = $uniq;
//            setcookie('uniq',$uniq,time()+3600,'/');
//            setcookie('username',$username,time()+3600,'/');
        }
    }
}else{
    //非法操作
    $arr['code'] = -1;
    $arr['msg'] = 'Illegal operation';
}
echo json_encode($arr);





