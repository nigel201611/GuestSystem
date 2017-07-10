<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/4
 * Time: 15:45
 */
session_start();

include_once 'common.php';
include_once 'common.func.php';

date_default_timezone_set('prc');


$username = _mysql_string($link,trim($_POST['username']));
$pwd = _mysql_string($link,trim($_POST['pwd']));//密码需要处理后存储，否则容易泄露密码信息，暂时不处理


$result = [];

//判断用户名，手机号，邮箱名不能重复
$selectSql = "select id from user where username=?";
$stmt1 = mysqli_prepare($link,$selectSql);//预编译
mysqli_stmt_bind_param($stmt1,'s',$username);//绑定参数
mysqli_stmt_execute($stmt1);
mysqli_stmt_store_result($stmt1); //保存结果集
$num1 = mysqli_stmt_num_rows($stmt1);//获取结果集中行数
if($num1 == 1){
    $result['code'] = 2;
    $result['msg'] = 'repeat username';
    echo json_encode($result);
    exit; //退出
}

$uniq = md5(uniqid(rand(),true));//生成唯一用户标识符
$active = md5(uniqid(rand(),true));//激活邮箱用
$time = date("Y:m:d H:i:s");
$userIP = $_SERVER['HTTP_HOST'];//获取客户端ip
$login_count = 1;



$insertSql = "insert into user(username,pwd,uniq,active,`time`,user_ip,login_count) values(?,?,?,?,?,?,?)";
//使用预编译可以提高性能，并且防止sql注入攻击
$stmt = mysqli_prepare($link,$insertSql);//预编译
mysqli_stmt_bind_param($stmt,'ssssssi',$username,$pwd,$uniq,$active,$time,$userIP,$login_count);//绑定参数
mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt); //保存结果集
$num = mysqli_stmt_affected_rows($stmt);//获取插入或者删除影响的行数


if($num == 1){ //插入成功，将用户名，密码添加到session中，下次自动登录用，第一次注册成功，应该登录，而不需要用户再次输入登录
    $_SESSION['username'] = $username;
    $_SESSION['pwd'] = $pwd;
    //存储uniq到cookie中,有效时间1个小时
    setcookie('uniq',$uniq,time()+3600,'/');
    $result['code'] = 0;
    $result['msg'] = 'success';
}else{
    $result['code'] = -1;
    $result['msg'] = 'failure';
}

echo json_encode($result);