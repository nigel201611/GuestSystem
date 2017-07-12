<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/4
 * Time: 16:40
 */

include_once 'common.php';


session_start();


$username = trim($_POST['username']);
$pwd = trim($_POST['pwd']);

$result = [];
//判断用户名（手机号，邮箱名）是否存在
$selectSql = "select id from user where username=?";
$stmt1 = mysqli_prepare($link,$selectSql);//预编译
mysqli_stmt_bind_param($stmt1,'s',$username);//绑定参数
mysqli_stmt_execute($stmt1);
mysqli_stmt_store_result($stmt1); //保存结果集
$num1 = mysqli_stmt_num_rows($stmt1);//获取结果集中行数
if($num1 == 0){
    $result['code'] = 2;
    $result['msg'] = 'Not have this username';
    echo json_encode($result);
    exit; //退出
}
mysqli_stmt_close($stmt1);



$insertSql = "select id,uniq from user where username=? and pwd=?";

$stmt = mysqli_prepare($link,$insertSql);//预编译
mysqli_stmt_bind_param($stmt,'ss',$username,$pwd);//绑定参数
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$id,$uniq);

mysqli_stmt_store_result($stmt); //保存结果集
mysqli_stmt_fetch($stmt);
$num = mysqli_stmt_num_rows($stmt);//获取查询的结果集的行数
mysqli_stmt_close($stmt);

if($num == 1){
    //用户登录成功后，保存用户登录信息
    $_SESSION['uniq'] = $uniq;
    $_SESSION['username'] = $username;

    //登录成功后，应该是登录次数增加一次
    $updateSql = "update user set login_count=login_count+1 where username='$username'";
    mysqli_query($link,$updateSql);


    //用户名和uniq保存到cookie中，有效时间为1个小时
//    setcookie('username',$username,time()+3600,'/');
//    setcookie('uniq',$uniq,time()+3600,'/');
    $result['code'] = 0;
    $result['msg'] = 'success';
}else{
    $result['code'] = -1;
    $result['msg'] = 'failure';
}
echo json_encode($result);

