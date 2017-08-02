<?php
require_once 'phpClass/MySQL.class.php';
$db = MySQL::getObj('localhost','root','root','nigel');
function getArrFile(){
    //单文件和多文件获取名字合一
    foreach($_FILES as $key => $value){
        //$key == 'userfile',$value=array();
        if( is_string($value['name'])){  //字符串-单文件上传 $value = $_FILES['userfile'];
            $newArr[] = $value;
        }else{
            foreach ($_FILES as $key => $value) {
                foreach ($value['name'] as $key1 => $value1) {
                    $arr['name'] = $value['name'][$key1];
                    $arr['type'] = $value['type'][$key1];
                    $arr['tmp_name'] = $value['tmp_name'][$key1];
                    $arr['error'] = $value['error'][$key1];
                    $arr['type'] = $value['type'][$key1];
                    $arr['size'] = $value['size'][$key1];
                    $newArr[] = $arr;
                }
            }
        }
    }//foreach
    return $newArr;
}

function getFN($filename){

    $extArr = explode('.', $filename);
    $ext = $extArr[count($extArr)-1];
//	$ext = end(explode('.', $filename));
    //防止文件重名 ,文件名字改为unix时间戳。并且加上0-10000间的随机数
    $newName = md5(microtime(true).mt_rand(0, 10000)).'.'.$ext;
    return $newName;
}
function uploadFile(){
    global $dir;
    global $album_name;
    $uploadFileResult = ['code'=>-1,'msg'=>'','imgPath'=>[]];
    $files = getArrFile();
    $conn = MySQL::getObj('localhost','root','root','nigel');
    foreach($files as $key => $value){
        $filename = $value['tmp_name']; //当前文件存储路径
        $tarFile = getFN($value['name']);
        $target = $dir.$album_name.$tarFile;
        $suc = move_uploaded_file($filename, $target);
        if($suc){
            $uploadFileResult['code'] = 0;
            $uploadFileResult['msg'] = 'success';
            $uploadFileResult['imgPath'][] = $target;
            //上传成功后，设置相册的默认缩略图，如果原来相册的缩略图，没有设置过的话,thumbnail_option = 2说明是主动编辑过该相册缩略图的
            $dir = 'img/'.$album_name.$tarFile;
            $data = [
                'album_thumbnail'=>$dir
            ];
            $albumDir = $_GET['album_name'];
            $where = 'thumbnail_option!=2 and album_dir='.$albumDir;
            $conn->update('album',$data,$where);
        }
    }
    echo json_encode($uploadFileResult);
}
//上传照片的目的路径
$dir = '../img/';
$album_name = $_GET['album_name'].'/';

if(empty($album_name)){
    $album_name = "default/";
}
uploadFile();

?>