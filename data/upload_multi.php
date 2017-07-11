<?php
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
    $uploadFileResult = ['code'=>-1,'msg'=>'','imgPath'=>''];
    $files = getArrFile();
    foreach($files as $key => $value){
        $filename = $value['tmp_name']; //当前文件存储路径
        $target = 'img/headPhoto/'.getFN($value['name']);
        $suc = move_uploaded_file($filename, $target);
        if($suc){
            $uploadFileResult['code'] = 0;
            $uploadFileResult['msg'] = 'success';
            $uploadFileResult['imgPath'] = $target;
            //上传成功后，将user表中的head_img设置成$target

        }
        echo json_encode($uploadFileResult);
    }
}

uploadFile();

?>