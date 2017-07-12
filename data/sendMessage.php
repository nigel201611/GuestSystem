<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/12
 * Time: 19:46
 */
include_once 'phpClass/MySQL.class.php';

$content = $_POST['content'];
$to_user = $_POST['to_user'];
$from_user = $_SESSION['username'];

$conn = new MySQL('localhost','root','root','nigel');



//增加消息
