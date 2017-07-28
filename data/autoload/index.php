<?php 
/*
 * 自动加载类文件测试
*/
//实例化Person类,读取类中的成员属性username
//require_once 'Person.class.php';

function __autoload($class){   
    //autoload的参数是实例化的类名称
    require_once $class.'.class.php';
}


$p = new Person();
echo $p->username;

echo "<hr/>";
//实例化Student类,读取类中的成员属性school
$s = new Student();
echo $s->school;
























