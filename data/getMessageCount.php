<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/17
 * Time: 19:47
 */

require_once 'phpClass/MySQL.class.php';

$db = MySQL::getObj('localhost','root','root','nigel');

$username = $_GET['username'];

//获取总记录数
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"id",
    'where'=>"to_user='{$username}' and message_state=0",  //条件是，别人发给自己的,并且未读的
];
$result = $db->fetchAll('message',$config);
if($result){
    echo count($result);
}

