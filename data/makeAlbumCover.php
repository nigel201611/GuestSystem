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

function getFN($filename){
    $extArr = explode('.', $filename);
    $ext = $extArr[count($extArr)-1];
//    $newName = md5(microtime(true).mt_rand(0, 1000)).'.'.$ext;
    $newName = md5(microtime().mt_rand(0, 1000)).'.'.$ext;
    return $newName;
}
$name = $_FILES['file']['name'];
$coverImgName = getFN($name);//避免重名

$modifyRsp = ['code'=>-1,'msg'=>""];
$datetime = date("Y:m:d H:i:s");
$conn = MySQL::getObj('localhost','root','root','nigel');

if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    $modifyRsp['code'] = 2;
    $modifyRsp['msg'] = "login timeout,please login again";
    echo json_encode($modifyRsp);
    exit;
}

$id = $_GET['id'];//相册id
if(!isset($id)){
    $modifyRsp['msg'] = 'not exist album id';
   exit;
}
//获取该相册的album_dir
$config = [
    'fileds'=>'album_dir',
    'where'=>'id='.$id,
    'mode'=>MYSQLI_ASSOC
];

$result = $conn->fetchOne('album',$config);
$album_dir = $result['album_dir'];
//将上传的照片保存到指定相册路径下，之后将该照片设置成该相册的缩略图，并且设置thumbnail_option=2
$targetDir = '../img/'.$album_dir.'/';
$targetDir_file = $targetDir.$coverImgName;
if ( move_uploaded_file($_FILES['file']['tmp_name'], $targetDir_file)  ) {
    $data = [
        'thumbnail_option'=>2,
        'album_thumbnail'=>'img/'.$album_dir.'/'.$coverImgName
    ];
    $where = 'id=\''.$id.'\'';
//添加消息
    $num = $conn->update('album',$data,$where);
    if($num == 1){
        $modifyRsp['code'] = 0;
        $modifyRsp['msg'] = "modify success";
    }else{
        $modifyRsp['code'] = -1;
        $modifyRsp['msg'] = "modify failed";
    }
}

echo json_encode($modifyRsp);




