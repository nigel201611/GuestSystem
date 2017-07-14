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

    private $config = array(
        'width'=>80,
        'height'=>30,
        'length'=>4
    );

    private $bgs=array();

    function __construct($config=array())
    {

        $this->config = array_merge($this->config,$config);
        $this->width = $this->config['width'];
        $this->height = $this->config['height'];
        $this->length = $this->config['length'];

        $this->backGround();
        $this->getWord();
//        $this->distrub();
        $this->entry();
    }
    private function backGround(){
//        $this->img = imagecreatetruecolor($this->width,$this->height);
//        $bgColor = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
//        imagefill($this->img,0,0,$bgColor);

        //获取指定目录下的图片
        $this->getImgFile();
    //从数组$bgs[]随机取一张图片
        $type_array = array(1=>"gif",2=>"jpeg",3=>"png");
        $bgsFile = $this->bgs[array_rand($this->bgs)];
        list($src_width,$src_height,$type)=getimagesize($bgsFile);
    //需要分析背景图片格式
    //获取GD资源
        $fun = "imagecreatefrom";
        $funName = $fun.$type_array[$type];
        $src_img = $funName($bgsFile);
        $this->img = imagecreatetruecolor($this->config['width'],$this->config['height']);


 //将背景图片缩放到指定验证码大小
        imagecopyresampled($this->img,$src_img,0,0,0,0,
            $this->config['width'],$this->config['height'],$src_width,$src_height);

    }
    private function getImgFile(){
        $bgsPath = "bgs/";
        $dir = opendir($bgsPath);
        while(($filename=readdir($dir))!==false){
            if($filename!='.'&&$filename!=".."){
                $this->bgs[] = $bgsPath.$filename;
            }
        }
        closedir($dir);
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

$config = ['width'=>100,'height'=>25,'length'=>5];
$yzcode = new Verify($config);
//$yzcode = new Verify();
//$yzcode->backGround();
//$yzcode->getWord();
//$yzcode->distrub();
//$yzcode->entry();
