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
    'pageSize'=>4,     //当前页记录数
    'recordCount'=>0,  //总记录数，
    'pagesCount'=>0,   //总页数
    'curPage'=>1,      //当前页
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

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $albumArr['curPage'] = $_GET['page'];
}
//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id"
];
$result = $db->fetchAll('album',$config);

if($result){
    $albumArr['recordCount'] = count($result);
}
//计算总页数
$albumArr['pagesCount'] = ceil($albumArr['recordCount']/$albumArr['pageSize']);

//分页获取数据
$start = ($albumArr['curPage']-1)*$albumArr['pageSize'];

$config1 = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"*",
    'limits'=>"{$start},{$albumArr['pageSize']}"
];

$result1 = $db->fetchAll('album',$config1);
if($result1){
    $albumArr['code'] = 0;//成功获取到分页数据
    $albumArr['msg'] = "success";
    foreach ($result1 as $key => $value){
        $albumArr['info'][] = $value;
    }
}

echo json_encode($albumArr);


