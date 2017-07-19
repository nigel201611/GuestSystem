<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/14
 * Time: 14:49
 */
session_start();
require_once 'phpClass/MySQL.class.php';

$db = MySQL::getObj('localhost','root','root','nigel');


//分页获取别人发给自己的信息,to_user=$_COOKIE['username']
$flowerArr = [
    'code'=>-1,
    'msg'=>"",
    'pageSize'=>4,     //当前页记录数
    'recordCount'=>0,  //总记录数，
    'pagesCount'=>0,   //总页数
    'curPage'=>1,      //当前页
    'info'=>[]          //获取到的结果
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];
}else{
    $flowerArr['code'] = 2;//需要重新登录
    $flowerArr['msg'] = "login timeout,please login again";
    echo json_encode($flowerArr);
    exit();
}

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $flowerArr['curPage'] = $_GET['page'];
}
//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id",
    'where'=>"to_user='{$to_user}'",  //条件是，别人发给自己的
];
$result = $db->fetchAll('flower',$config);

if($result){
    $flowerArr['recordCount'] = count($result);
}
//计算总页数
$flowerArr['pagesCount'] = ceil($flowerArr['recordCount']/$flowerArr['pageSize']);

//分页获取数据
$start = ($flowerArr['curPage']-1)*$flowerArr['pageSize'];

$config1 = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"*",
    'where'=>"to_user='{$to_user}'",
    'limits'=>"{$start},{$flowerArr['pageSize']}"
];

$result1 = $db->fetchAll('flower',$config1);
if($result1){
    $flowerArr['code'] = 0;//成功获取到分页数据
    $flowerArr['msg'] = "success";
    foreach ($result1 as $key => $value){
        $flowerArr['info'][] = $value;
    }
}

echo json_encode($flowerArr);

