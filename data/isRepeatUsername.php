<?php
/**
 * Created by PhpStorm.
 * User: nigel-php
 * Date: 2017/7/9
 * Time: 12:01
 */

include_once "common.php";
$username = $_REQUEST['username'];

$selectSql = "select * from user where username=?";
$stmt = mysqli_prepare($link,$selectSql);
mysqli_stmt_bind_param($stmt,'s',$username);
mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt);
$num = mysqli_stmt_num_rows($stmt);

$arr = ['code'=>-1,'msg'=>''];
if($num == 1){
    $arr['code'] = 0;
    $arr['msg'] = "username is exists";
}else{
    $arr['code'] = 1;
    $arr['msg'] = "username is valid";
}
echo json_encode($arr);