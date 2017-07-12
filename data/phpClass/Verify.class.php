<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/12
 * Time: 15:28
 */

/*
 * 创建背景布（浅色且颜色随机）
 * 文字
 * 干扰
 * 输出
 * */
class Verify{
    //创建背景布,浅色且颜色随机
    private $img;
    private $width;
    private $height;
    private $length;

    private $yzcode;

    private $config = array(
        'width'=>80,
        'height'=>30,
        'length'=>4
    );

    function __construct($config=array())
    {

        $this->config = array_merge($this->config,$config);
        $this->width = $this->config['width'];
        $this->height = $this->config['height'];
        $this->length = $this->config['length'];

        $this->backGround();
        $this->getWord();
        $this->distrub();

        //将验证码文字存储到cookie中
        $this->saveCodeInCookie();

        $this->entry();
    }
    private function backGround(){
        $this->img = imagecreatetruecolor($this->width,$this->height);
        $bgColor = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagefill($this->img,0,0,$bgColor);
    }
    //文字
    private function getWord(){
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $font = 5;
        for($i=0;$i<$this->length;$i++){ //随机截取4位
            $color = imagecolorallocate($this->img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
            $code = substr($string,mt_rand(0,strlen($string)-1),1);
            $x = ($this->width/$this->length)*$i+5;
            $y = mt_rand(5,8);
            $this->yzcode .= $code;
            imagestring($this->img,$font,$x,$y,$code,$color);
        }
    }
    //干扰
    private function distrub(){
        $xWidth = $this->width-1;
        $yHeight = $this->height-1;
        //100个随机出现的点
        for($i=0;$i<100;$i++){
            $x = mt_rand(1,$xWidth);
            $y = mt_rand(1,$yHeight);
            $color = imagecolorallocate($this->img,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
            imagesetpixel($this->img,$x,$y,$color);
        }
        //10条随机出现的线
        for($i=0;$i<10;$i++){
            $color = imagecolorallocate($this->img,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
            $x1 = mt_rand(1,$xWidth);
            $y1 = mt_rand(1,$yHeight);
            $x2 = mt_rand(1,$xWidth);
            $y2 = mt_rand(1,$yHeight);
            imageline($this->img,$x1,$y1,$x2,$y2,$color);
        }
    }
    //获取验证码文字
    function getCode(){
        return $this->yzcode;
    }
    //将验证码存储到cookie中
    private function saveCodeInCookie(){
        setcookie("yz_classcode",$this->yzcode,time()+3600,'/');
    }
    //输出
    private function entry(){
        header('content-type:image/png');
        imagepng($this->img);
    }
    function __destruct()
    {
        imagedestroy($this->img);
    }

}

//生成验证码
$yzcode = new Verify();