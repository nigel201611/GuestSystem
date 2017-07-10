<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/6
 * Time: 9:40
 */

include_once 'common.php';

@$pageno = $_REQUEST['pageno'];

//定义一个分页数组
$pageArr = [
    'pageSize'=>6, //页面数量
    'recordCount'=>0, //总记录数
    'pageNo'=>1,//当前页面no
    'pageCount'=>0,//总页面数
    'pageInfo'=>[]
];

$selectSql = "select count(*) from user"; //查询总记录数
$result = mysqli_query($link,$selectSql);
$row = mysqli_fetch_array($result);
$pageArr['recordCount'] = $row[0]; //1 获取到总记录数

//2 总页面数
$pageArr['pageCount'] = ceil($pageArr['recordCount']/$pageArr['pageSize']);
//echo json_encode($pageArr);
//3 当前页面no
if(isset($pageno) && $pageno>0 ){
    $pageArr['pageNo'] = intval($pageno);
}
if($pageno>$pageArr['pageCount']){
    $pageArr['pageNo'] = $pageArr['pageCount'];
}


$start = ($pageArr['pageNo']-1)*$pageArr['pageSize'];
$count = $pageArr['pageSize'];

$selectSql2 = "select *  from user limit $start,$count";
$result = mysqli_query($link,$selectSql2);

while($row = mysqli_fetch_assoc($result)){
    $pageArr['pageInfo'][] = $row;
}
echo json_encode($pageArr);