<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/16
 * Time: 15:06
 */

header('content-type:application/json;');
session_start();
require_once 'phpClass/MySQL.class.php';
date_default_timezone_set('prc');

@$comment_content = $_POST['comment_content'];
@$comment_title = $_POST['comment_title'];
@$article_id = $_POST['article_id '];
@$article_username = $_POST['article_username'];
$comment_username;

$comment_date = date("Y:m:d H:i:s");




$insertRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $comment_username = $_SESSION['username'];
}else{
    $insertRsp['code'] = 2;
    $insertRsp['msg'] = "login timeout,please login again";
    echo json_encode($insertRsp);
    exit;
}
$conn = MySQL::getObj('localhost','root','root','nigel');

$data = [
    'comment_content'=>$comment_content,
    'comment_title'=>$comment_title,
    'comment_username'=>$comment_username,
    'comment_date'=>$comment_date,
    'article_id'=>$article_id,
    'article_username'=>$article_username
];
//添加消息
$num = $conn->insert('comment',$data);
if($num == 1){
    //添加成功，应该更新article表中评论次数！！
    $insertRsp['code'] = 1;
    $insertRsp['msg'] = "add comment success";
}else{
    $insertRsp['code'] = -1;
    $insertRsp['msg'] = "add comment failed";
}

echo json_encode($insertRsp);




