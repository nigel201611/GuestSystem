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

function toChineseDate($date){
    $years = array('零','一','二','三','四','五','六','七','八','九');
    $months = array('零','一','二','三','四','五','六','七','八','九','十','十一','十二');
    $days = array('零','一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十','二十一','二十二','二十三','二十四','二十五','二十六','二十七','二十八','二十九','三十','三十一');
    preg_match_all("/^([1-9])(\d)(\d)(\d)\-(0?[1-9]|1[0-2])\-(0?[1-9]|[1-2]\d|3[0-1])$/",$date,$matches);
    $ystr = $years[$matches[1][0]] . $years[$matches[2][0]] . $years[$matches[3][0]] . $years[$matches[4][0]];
    $mstr = $months[(int)$matches[5][0]];
    $dstr = $days[(int)$matches[6][0]];
    $turnedDate = $ystr . '年' . $mstr . '月' . $dstr . '日';
    return $turnedDate;
}

?>