<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/6
 * Time: 20:06
 */


$pageArr = [
    "status"=>"ok",
    "message"=> "success",
    "datas"=>[]
];
include_once 'common.php';

$selectSql = "select *  from user";
$result = mysqli_query($link,$selectSql);
while($row = mysqli_fetch_assoc($result)){
    $pageArr['datas'][] = $row;
}
echo json_encode($pageArr);