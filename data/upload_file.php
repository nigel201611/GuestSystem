<?php
//发表帖子时，上传图片所用
header('content-type:application/json;');
function getFN($filename){
	$extArr = explode('.', $filename);
	$ext = $extArr[count($extArr)-1];
	$newName = md5(microtime(true).mt_rand(0, 10000)).'.'.$ext;
	return $newName;
}

$fileName = $_FILES['file']['tmp_name'];//上传的文件存储在临时路径下
$name = $_FILES['file']['name'];//文件名

$dirname = '../img/upload/';
if(!file_exists($dirname)){
    mkdir($dirname);
}
$target = $dirname.getFN($name);//目标路径
$suc = move_uploaded_file($fileName, $target);

$hashMap = [
    'link'=>''
];
if($suc){
    $filename = basename($target);
    $hashMap['link'] = "img/upload/".$filename;
}

echo json_encode($hashMap);

?>