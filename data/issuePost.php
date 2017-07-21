<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/20
 * Time: 20:08
 */

//标题，内容，发布人，发布时间，
//查看次数，评论次数，
header('content-type:application/json;');
session_start();
require_once 'phpClass/MySQL.class.php';
date_default_timezone_set('prc');

@$tzTitle = $_POST['tzTitle'];
@$tzContent = $_POST['tzContent'];

$tzIssueRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $tzIssueRsp['code'] = 2;
    $tzIssueRsp['msg'] = "login timeout,please login again";
    echo json_encode($tzIssueRsp);
    exit;
}
$datetime = date("Y:m:d H:i:s");
$conn = MySQL::getObj('localhost','root','root','nigel');

$data = [
    'username'=>$username,
    'pub_date'=>$datetime,
    'put_title'=>$tzTitle,
    'pub_content'=>$tzContent,
    'pub_readCount'=>0,
    'pub_commentCount'=>0
];
//添加消息
$num = $conn->insert('article',$data);
if($num == 1){
    $tzIssueRsp['code'] = 0;
    $tzIssueRsp['msg'] = "pub success";
}else{
    $tzIssueRsp['code'] = -1;
    $tzIssueRsp['msg'] = "pub failed";
}
echo json_encode($tzIssueRsp);

