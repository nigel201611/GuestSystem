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
$commentArr = [
    'code'=>-1,
    'msg'=>"",
    'pageSize'=>2,     //当前页记录数
    'recordCount'=>0,  //总记录数，
    'pagesCount'=>0,   //总页数
    'curPage'=>1,      //当前页
    'info'=>[]          //获取到的结果
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];  //当前用户
}else{
    $commentArr['code'] = 2;//需要重新登录
    $commentArr['msg'] = "login timeout,please login again";
    echo json_encode($commentArr);
    exit();
}

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $commentArr['curPage'] = $_GET['page'];
}
$article_id = $_GET['article_id'];

//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id",
    'where'=>"article_id={$article_id}"
];
$result = $db->fetchAll('comment',$config);

if($result){
    $commentArr['recordCount'] = count($result);
}
//计算总页数
$commentArr['pagesCount'] = ceil($commentArr['recordCount']/$commentArr['pageSize']);

//分页获取数据，同时向user表中获取头像，comment获取相关信息
$start = ($commentArr['curPage']-1)*$commentArr['pageSize'];
$config1 = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"comment.*,user.head_img",
    'where'=>"article_id={$article_id} and comment.comment_username=user.username",
    'limits'=>"{$start},{$commentArr['pageSize']}"
];

$result1 = $db->fetchAll('comment,user',$config1);
if($result1){
    $commentArr['code'] = 0;//成功获取到分页数据
    $commentArr['msg'] = "success";
    foreach ($result1 as $key => $value){
        $commentArr['info'][] = $value;
    }
}

echo json_encode($commentArr);


