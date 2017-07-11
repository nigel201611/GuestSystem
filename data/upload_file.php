<?php
header('content-type:application/json;');
function getFN($filename){
	$extArr = explode('.', $filename);
	$ext = $extArr[count($extArr)-1];
	$newName = md5(microtime(true).mt_rand(0, 10000)).'.'.$ext;
	return $newName;
}

$fileName = $_FILES['userfile']['tmp_name'];//上传的文件存储在临时路径下
$name = $_FILES['userfile']['name'];//文件名
$target = 'upload/'.getFN($name);//目标路径
$suc = move_uploaded_file($fileName, $target);

echo $suc ? '上传成功':'上传失败';
?>