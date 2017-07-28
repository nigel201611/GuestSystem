<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/26
 * Time: 10:10
 */

//print_r(pathinfo(__FILE__));
//预定义变量,$_ENV,$_SERVER
//魔术常量，__LINE_,__FILE__(返回文件完整的路径和文件名),__CLASS__，__METHOD__(返回类的方法名称)，__FUNCTION__(返回函数名称)
//__DIR__（返回文件所在的目录）,__NAMESPACE__(返回当前命名空间名称)

$systemObj = [
    'php_version'=>PHP_VERSION,
    'operate_system'=>1,
];

echo "<pre>";
print_r($_ENV);
echo "</pre>";