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

$photoArr = [
    "status"=>"error",
    "message"=>"fail",
    'datas'=>[]          //获取到的结果
];
if(isset( $_SESSION['username']) && !empty( $_SESSION['username'])){
    $username = $_SESSION['username'];  //当前用户
}else{
    $photoArr['code'] = 2;//需要重新登录
    $photoArr['msg'] = "login timeout,please login again";
    echo json_encode($photoArr);
    exit();
}

//得到当前页
if(isset($_GET['page']) && !empty($_GET['page'])){
    $photoArr['curPage'] = $_GET['page'];
}
$id =  $_GET['id'];

$config = [
    'mode'=>MYSQLI_ASSOC,
    'fileds'=>"album_dir",
    'where'=>'id='.$id
];

//根据相册id获取该相册目录album_dir
$result = $db->fetchOne('album',$config);
$album_dir = $result['album_dir'];

//从指定相册目录下读取照片，只是读取名称而已
$dir = '../img/'.$album_dir.'/';
$sum=0;
$filetime = [];
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if($file!='.'&&$file!='..'){
                $sum++;
                $arr = [
                    'path'=>'',
                    'img_name'=>''
                ];
                $arr['path'] = "img/".$album_dir.'/'.$file;
                $arr['img_name'] = $file;
                $filetime[] = date("Y-m-d H:i:s",filemtime($dir.$file));//获取文件最近修改日期
                $photoArr['datas'][]= $arr;
            }
        }
        $photoArr['status'] = 'ok';
        $photoArr['message'] = 'success';
        array_multisort($filetime,SORT_DESC,SORT_STRING, $photoArr['datas']);//按时间排序
        closedir($dh);
    }
}
echo json_encode($photoArr);

