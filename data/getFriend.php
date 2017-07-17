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


//分页获取别人发给自己的信息,to_user=$_COOKIE['username']
$friendArr = [
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
    $friendArr['code'] = 2;//需要重新登录
    $friendArr['msg'] = "login timeout,please login again";
    echo json_encode($friendArr);
    exit();
}

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $friendArr['curPage'] = $_GET['page'];
}
//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id",
    'where'=>"(to_user='{$to_user}' and from_user='{$from_user}') 
    or (to_user='{$from_user}' and from_user='{$to_user}') "  //条件是，和当前用户是好友关系的
];
$result = $db->fetchAll('message',$config);

if($result){
    $friendArr['recordCount'] = count($result);
}
//计算总页数
$friendArr['pagesCount'] = ceil($friendArr['recordCount']/$friendArr['pageSize']);

//分页获取数据
$start = ($friendArr['curPage']-1)*$friendArr['pageSize'];

$config1 = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"*",
    'where'=>"(to_user='{$to_user}' and from_user='{$from_user}') 
    or (to_user='{$from_user}' and from_user='{$to_user}') ",  //条件是，和当前用户是好友关系的
    'limits'=>"{$start},{$friendArr['pageSize']}"
];

$result1 = $db->fetchAll('message',$config1);
if($result1){
    $friendArr['code'] = 0;//成功获取到分页数据
    $friendArr['msg'] = "success";
    foreach ($result1 as $key => $value){
        $friendArr['info'][] = $value;
    }
}

echo json_encode($friendArr);


