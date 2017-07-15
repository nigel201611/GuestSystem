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
$messageArr = [
    'code'=>-1,
    'msg'=>"",
    'pageSize'=>4,     //当前页记录数
    'recordCount'=>0,  //总记录数，
    'pagesCount'=>0,   //总页数
    'curPage'=>1,      //当前页
    'pages'=>[],
    'info'=>[]          //获取到的结果
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];
}else{
    $messageArr['code'] = 2;//需要重新登录
    $messageArr['msg'] = "login timeout,please login again";
    echo json_encode($messageArr);
    exit();
}

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $messageArr['curPage'] = $_GET['page'];
}
//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id",
    'where'=>"to_user='{$to_user}'",  //条件是，别人发给自己的
];
$result = $db->fetchAll('message',$config);

if($result){
    $messageArr['recordCount'] = count($result);
}
//计算总页数
$messageArr['pagesCount'] = ceil($messageArr['recordCount']/$messageArr['pageSize']);

//分页获取数据
$start = ($messageArr['curPage']-1)*$messageArr['pageSize'];

$config1 = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"*",
    'where'=>"to_user='{$to_user}'",
    'limits'=>"{$start},{$messageArr['pageSize']}"
];

$result1 = $db->fetchAll('message',$config1);
if($result1){
    $messageArr['code'] = 0;//成功获取到分页数据
    $messageArr['msg'] = "success";
    foreach ($result1 as $key => $value){
        $messageArr['info'][] = $value;
    }
}

echo json_encode($messageArr);

