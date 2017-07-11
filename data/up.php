<?php
session_start();
include_once "common.php";
$uploaddir = '../img/headPhoto';
$name = $_FILES['file']['name'];
$uploadfile = $uploaddir . $name;
$type = strtolower(substr(strrchr($name, '.'), 1));

$typeArr = array("jpg","png","gif",'bmp','jpeg');
$result = ['code'=>-1,'msg'=>'','imgSrc'=>''];
//判断文件类型
if (!in_array($type, $typeArr)) {
    $result['code']=-1;
    $result['msg']= "请上传jpg,png,gif,jpeg,bmp格式图片";
    exit;
}
function getFN($filename){
    $extArr = explode('.', $filename);
    $ext = $extArr[count($extArr)-1];
    $newName = md5(microtime(true).mt_rand(0, 10000)).'.'.$ext;
    return $newName;
}
$uniqimgName = getFN($name);//避免重名
$username = $_SESSION['username'];
$target = $uploaddir.'/'.$uniqimgName;//目标路径
//首先用户名要存在
if($username){
    if ( move_uploaded_file($_FILES['file']['tmp_name'], $target)  ) {
        $result['code']=0;
        $result['msg']= "上传成功";
        $result['imgSrc']=$uniqimgName;
        //上传成功，将user表中的head_img字段设置为$uniqimgName
        $updateSql = "update user set head_img='$uniqimgName' where username='$username'";
        mysqli_query($link,$updateSql);
    }
}else{
    $result['code']=1;
    $result['msg']="用户名有误，请重新登录";
    $result['imgSrc']=$uniqimgName;
}
echo json_encode($result);
?>