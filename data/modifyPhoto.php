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

@$photoName = $_POST['photoName'];
@$originalPhotoName = $_POST['origianlPhotoName'];
$id = $_POST['id'];//相册id



$modifyRsp = ['code'=>-1,'msg'=>""];
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $modifyRsp['code'] = 2;
    $modifyRsp['msg'] = "login timeout,please login again";
    echo json_encode($modifyRsp);
    exit;
}
$conn = MySQL::getObj('localhost','root','root','nigel');

//根据id获取相册路径或目录
$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>'album_dir',
    'where'=>'id='.$id
];
$result = $conn->fetchOne('album',$config);
$album_dir = $result['album_dir'];

//修改指定目录下的照片名字rename
$oldImg = '../img/'.$album_dir.'/'.$originalPhotoName;
$newImg = '../img/'.$album_dir.'/'.$photoName;
$flag = rename($oldImg,$newImg);
//创建一个相册目录

if($flag){
    $modifyRsp['code'] = 1;
    $modifyRsp['msg'] = "modify success";
}else{
    $modifyRsp['code'] = -1;
    $modifyRsp['msg'] = "modify failed";
}

echo json_encode($modifyRsp);




