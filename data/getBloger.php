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
$blogerArr = [
    'code'=>-1,
    'msg'=>"",
    'pageSize'=>6,     //当前页记录数
    'recordCount'=>0,  //总记录数，
    'pagesCount'=>0,   //总页数
    'curPage'=>1,      //当前页
    'info'=>[]          //获取到的结果
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];  //当前用户
}else{
    $blogerArr['code'] = 2;//需要重新登录
    $blogerArr['msg'] = "login timeout,please login again";
    echo json_encode($blogerArr);
    exit();
}

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $blogerArr['curPage'] = $_GET['page'];
}
//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id"
];
$result = $db->fetchAll('user',$config);

if($result){
    $blogerArr['recordCount'] = count($result);
}
//计算总页数
$blogerArr['pagesCount'] = ceil($blogerArr['recordCount']/$blogerArr['pageSize']);

//分页获取数据
$start = ($blogerArr['curPage']-1)*$blogerArr['pageSize'];

$config1 = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"*",
    'limits'=>"{$start},{$blogerArr['pageSize']}"
];

$result1 = $db->fetchAll('user',$config1);
if($result1){
    $blogerArr['code'] = 0;//成功获取到分页数据
    $blogerArr['msg'] = "success";
    foreach ($result1 as $key => $value){
        $blogerArr['info'][] = $value;
    }
}

echo json_encode($blogerArr);


