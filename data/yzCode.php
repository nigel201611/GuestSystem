<?php
/*
 * 1.资源，背景色浅色，颜色随机
 * 2.文字
 * 3.干扰
 * 4.输出
 */

session_start();
//填充背景布
$width = 80;
$height = 30;
$im = imagecreatetruecolor($width,$height);
$bgColor = imagecolorallocate($im,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
imagefill($im,0,0,$bgColor);



//干扰
//100个颜色随机的点和10条颜色随机的线
for($i=0;$i<100;$i++){
	$pixelColor = imagecolorallocate($im,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
	imagesetpixel($im,mt_rand(1,79),mt_rand(1,29),$pixelColor);
}
for($i=0;$i<10;$i++){
	$lineColor = imagecolorallocate($im,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
	imageline($im,mt_rand(0,80),mt_rand(0,30),mt_rand(0,80),mt_rand(0,30),$lineColor);
}


//文字
$string = '0123456789abcdefghijklmnopqrstuvwxyz';
$yzcode = "";
for($i=0;$i<4;$i++){
	$char = substr($string,mt_rand(0,strlen($string)-1),1);
	$textColor = imagecolorallocate($im,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
	imagestring($im,5,20*$i+4,mt_rand(5,10),$char,$textColor);
    $yzcode .= $char;
}
$_SESSION['yzcode'] = $yzcode;
setcookie("yzcode",$yzcode,time()+3600,'/');
header('Content-Type:image/png');
imagepng($im);
imagedestroy($im);