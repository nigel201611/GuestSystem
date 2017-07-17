<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/6/28
 * Time: 23:35
 */

//获取当前运行时间
function _runTime(){
    $time = explode(' ',microtime());
    return $time[0]+$time[1];
}

function _mysql_string($link,$string){ //将注册的字段进行特殊符号转义
    if(get_magic_quotes_gpc()){  //get_magic_quotes_gpc()如果返回1说明自动开启了转义
        return $string;
    }else{
        return mysqli_real_escape_string($link,$string);
    }
}

?>