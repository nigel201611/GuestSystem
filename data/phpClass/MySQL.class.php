<?php
/**
 * Created by PhpStorm.
 * User: danei-php
 * Date: 2017/7/11
 * Time: 11:43
 */
//定义数据库类,设计模式--单例模式

/*
 * 增删改查
 * */
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('prc');
class MySQL{
    public $link;
    public $mode;
    private static $obj = null;
    private function __construct($server,$username,$password,$dbname){
        $this->link = mysqli_connect($server,$username,$password,$dbname);
    }
    static function getObj($server,$username,$password,$dbname){
        if(is_null(self::$obj)){
            self::$obj = new MySQL($server,$username,$password,$dbname);
        }
        return self::$obj;
    }
    function setMode($mode){
        if($mode!=MYSQLI_BOTH&&$mode!=MYSQLI_ASSOC&&$mode!=MYSQLI_NUM) {
            $this->mode = MYSQLI_ASSOC;
        }else{
            $this->mode = $mode;
        }
    }
    //增
    function insert($tbname,$data){
        $fileds = implode(',',array_keys($data));
        $values = '\''.implode('\',\'',$data).'\'';
        $query = "insert into {$tbname}({$fileds}) values({$values})";

        mysqli_query($this->link,$query);
        return mysqli_affected_rows($this->link);
    }
    //删
    function delete($tbname,$where=null){
        //$where应该是可选参数
        if($where){
            $query = "delete from {$tbname} where {$where}";
        }else{
            $query = "delete from {$tbname}";
        }
        mysqli_query($this->link,$query);
        return mysqli_affected_rows($this->link);
    }
    //改
    function update($tbname,$data,$where=null){
        $setings = "";
        foreach ($data as $key => $value){
            if(!strlen($setings)){
                $setings .= $key."='".$value."'";
            }else{
                $setings .= ",".$key."='".$value."'";
            }
        }
       $where? $query = "update {$tbname} set {$setings} where {$where}": $query = "update {$tbname} set {$setings}";
        mysqli_query($this->link,$query);
        return mysqli_affected_rows($this->link);
    }
    //获取查到的所有结果行
    function fetchAll($tbname,$config){
        $query = $this->buildQuery($tbname,$config);
        $result = mysqli_query($this->link,$query);
        //从结果集中获取关联数组
        //设置获取模式
        $this->setMode($config['mode']);
        $sets = mysqli_fetch_all($result,$this->mode);
        return $sets;
    }
    //获取一行
    function fetchOne($tbname,$config){
        $query = $this->buildQuery($tbname,$config);
        $result = mysqli_query($this->link,$query);
        //从结果集中获取关联数组
        //设置获取模式
        $this->setMode($config['mode']);
        $sets = mysqli_fetch_array($result,$this->mode);
        return $sets;
    }
    function buildQuery($tbname,$config){
        $query = "select {$config['fileds']} from {$tbname}";
        if( isset($config['where'])&&$config['where'] ){
            $query .= " where ".$config['where'];
        }
        if( isset($config['group_fileds'])&&$config['group_fileds'] ){
            $query .= " group by ".$config['group_fileds'];
        }
        //注意having的顺序
        if( isset($config['havings'])&&$config['havings'] ){
            $query .= " having ".$config['havings'];
        }
        if( isset($config['order_fileds'])&&$config['order_fileds'] ){
            $query .= " order by ".$config['order_fileds'];
        }
        if( isset($config['limits'])&&$config['limits'] ){
            $query .= " limit ".$config['limits'];
        }

        return $query;
    }

    private function __clone(){

    }
}


