<?php
/**
 * Created by PhpStorm.
 * User:nigel
 * Date: 2017/7/16
 * Time: 14:44
 */

class Upload{
    function buildFileInfo(){
        foreach($_FILES as $key => $value){
            if( is_string($value['name'])){  //字符串-单文件上传 $value = $_FILES['userfile'];
                $newArr[] = $value;
            }else{
                foreach ($_FILES as $key => $value) {
                    foreach ($value['name'] as $key1 => $value1) {
                        $arr['name'] = $value['name'][$key1];
                        $arr['type'] = $value['type'][$key1];
                        $arr['tmp_name'] = $value['tmp_name'][$key1];
                        $arr['error'] = $value['error'][$key1];
                        $arr['size'] = $value['size'][$key1];
                        $newArr[] = $arr;
                    }
                }
            }
        }//foreach
        return $newArr;
    }
    function uploadfile($destination="./"){
        if(!file_exists($destination)){
            mkdir($destination,0777);
        }
//        如果最后一位不是目录分隔符，那么添加一个
        if(substr($destination,-1)!='/'){
            $destination .="/";
        }
        $files = $this->buildFileInfo();
        foreach($files as $key => $value){
            $filename = $value['tmp_name'];//文件上传到服务器上的临时地址
            $destination = $destination.$this->getExtOfFile($value['name']);//文件上传目的地址
            move_uploaded_file($filename,$destination);
        }
    }

    function getExtOfFile($filename){
        //获取文件扩展名
//        $extArr = explode('.', $filename);
//        $ext = $extArr[count($extArr)-1];
        $ext = pathinfo($filename)['extension'];
        $newName =  $dstfilename = uniqid("php_").'.'.$ext;
        return $newName;
    }
}