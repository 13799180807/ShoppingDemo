<?php

//$a=ChaerCode::randomCode();
//ChaerCode::verificationCode($a);

class CharCode
{
    public static function verificationCode($str){
        header("Content-Type:image/jpeg");
        $width = 150;
        $height = 40;
        $img = imagecreatetruecolor($width, $height); //创建图像
        $colorBg = imagecolorallocate($img, rand(200, 255), rand(200, 255), rand(200, 255)); //设置背景色
        $colorBg1 = imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200)); //设置边框
        $cBg1 = imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200)); //设置点色
        imagefill($img, 0, 0, $colorBg); //区域填充

        for ($a = 1; $a < 50; $a++) {
            imagesetpixel($img, rand(0, $width - 1), rand(0, $height - 1), $cBg1);
        }
        for ($a = 1; $a < 5; $a++) {
            imageline($img, rand(0, $width / 2), rand(0, $height / 2), rand($width / 2, $width), rand($height / 2, $height), $cBg1);
        }
        imagestring($img,5,rand(0,($width/3)*2),rand(0,$height-15),$str,$colorBg1);
        imagejpeg($img);
        imagedestroy($img); //销毁图像
    }

    /**
     * @return string
     */
    public static function randomCode() :string
    {
        $element=array('q','w','e','r','t','y','u','i','o','p','l','k','j','h','g','f','d','s','a','z','x','c','v','b','n','m');
        rand(0,count($element)-1);
        $str='';
        for( $a1=1 ; $a1<=4 ; $a1++){
            $str.=$element[rand(0,count($element)-1)];
        }
        return $str;
    }


}