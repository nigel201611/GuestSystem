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

$showTzArr = [];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];  //当前用户
}else{
    $showTzArr['code'] = 2;//需要重新登录
    $showTzArr['msg'] = "login timeout,please login again";
    echo json_encode($showTzArr);
    exit();
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
}else{
    exit;
}
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"article.*,user.head_img",
    'where'=>"article.id={$id} and article.username=user.username"
];
$result = $db->fetchOne('article,user',$config);

if($result){
    $showTzArr['code'] = 0;//成功获取到分页数据
    $showTzArr['msg'] = "success";
    $showTzArr['info'] = $result;
    //更新阅读次数
    $updateSql = 'update article set pub_readCount=pub_readCount+1 where id='.$id;
    mysqli_query($db->link,$updateSql);
}

echo json_encode($showTzArr);


