<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/18
 * Time: 16:13
 */

session_start();
require_once 'phpClass/MySQL.class.php';

$db = MySQL::getObj('localhost','root','root','nigel');


//分页获取别人发给自己的信息,to_user=$_COOKIE['username']
$messageArr = [
    'code'=>-1,
    'msg'=>"",
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $to_user = $_SESSION['username'];
}else{
    $messageArr['code'] = 2;//需要重新登录
    $messageArr['msg'] = "login timeout,please login again";
    echo json_encode($messageArr);
    exit();
}

$ids = $_GET['ids'];


$data = [
    'message_state'=>1
];

$idsArr = explode(',',$ids);
$where = "";
if(count($idsArr) > 1){
    for($i=0;$i<count($idsArr)-1;$i++){
        $where .= " id={$idsArr[$i]} or ";
    }
    $where .= " id={$idsArr[$i]}";
}else{
    $where .= " id={$ids}";
}

$num = $db->update('message',$data,$where);
if($num){
    $messageArr['code'] = 0;//成功获取到分页数据
    $messageArr['msg'] = "update success";
    //重新查看数据库，还有多少条该用户未读消息
    $config = [
        'mode'=>MYSQLI_ASSOC,
        'fileds'=>"id",
        'where'=>"message_state=0 and to_user='{$to_user}'",
    ];
    $messageArr['count'] = count($db->fetchAll('message',$config));
}

echo json_encode($messageArr);



