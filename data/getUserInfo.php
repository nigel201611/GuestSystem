<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/8
 * Time: 10:29
 */

include_once 'common.php';

$username = $_REQUEST['username'];
$selectSql = "select * from user where username='$username'";
$result = mysqli_query($link,$selectSql);

$arr = ['code'=>-1,'info'=>[]];
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $arr['code'] = 0;
        $arr['info'][] = $row;
    }
    echo json_encode($arr);
}
