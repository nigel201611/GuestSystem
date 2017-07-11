<?php

$uploaddir = 'img/headPhoto';
$name = $_FILES['file']['name'];
$uploadfile = $uploaddir . $name;
$type = strtolower(substr(strrchr($name, '.'), 1));
//获取文件类型
$typeArr = array("jpg","png","gif",'bmp');
if (!in_array($type, $typeArr)) {
    echo "请上传jpg,png或gif类型的图片！";
    exit;
}
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . $_FILES['file']['name'])) {
    echo $uploaddir . $_FILES['file']['name'];
}
?>