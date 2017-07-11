<?php

$uploaddir = '../img/headPhoto';
$name = $_FILES['file']['name'];
$uploadfile = $uploaddir . $name;
$type = strtolower(substr(strrchr($name, '.'), 1));

$typeArr = array("jpg","png","gif",'bmp','jpeg');
$result = ["code"=>-1,'msg'=>'','imgSrc'=>''];
//判断文件类型
if (!in_array($type, $typeArr)) {
    $result['code']=-1;
    $result['msg']=-"请上传jpg,png,gif,jpeg,bmp格式图片";
    exit;
}
function getFN($filename){
    $extArr = explode('.', $filename);
    $ext = $extArr[count($extArr)-1];
    $newName = md5(microtime(true).mt_rand(0, 10000)).'.'.$ext;
    return $newName;
}

$uniqimgName = getFN($name);
$target = $uploaddir.$uniqimgName;//目标路径
if ( move_uploaded_file($_FILES['file']['tmp_name'], $target) ) {
    $result['code']=0;
    $result['msg']=-"请上传jpg,png,gif,jpeg,bmp格式图片";
    $result['imgSrc']=$uniqimgName;
    //上传成功，将user表中的head_img字段设置为$uniqimgName

}
echo json_encode($result);
?>