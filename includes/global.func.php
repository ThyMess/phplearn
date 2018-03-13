<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/27
 * Time: 14:54
 * _runtime()是用来获取耗时的
 * @access public 表示函数对外公开;
 * @return float 表示返回出来的是一个浮点数;
 */

function _runtime(){
    $_mtime = explode(' ',microtime());
    return $_mtime[1]+$_mtime[0];
}

function _code(){
    $_nmsg = null;
    for($i=0;$i<4;$i++){
        $_nmsg.= dechex(mt_rand(0,15));
    }
//保存在session 会话控制中讲到
    $_SESSION['code'] = $_nmsg;
//创建一张图像;
    $_width = 75;
    $_height = 25;
    $_img = imagecreatetruecolor($_width,$_height);

//baise
    $_white = imagecolorallocate($_img,255,255,255);
    imagefill($_img,0,0,$_white);
//ed

//biankuang

    $_black = imagecolorallocate($_img,0,0,0);
    imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
//ed
//随机画出一些线条
    for($i=0;$i<6;$i++){
        $_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
    }
//ed

//随机雪花
    for($i=0;$i<100;$i++){
        $_lnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_lnd_color);
    }

//输出验证码
    for($i=0;$i<strlen($_SESSION['code']);$i++){
        $_fnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imagestring($_img,mt_rand(3,5),$i*$_width/4+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_fnd_color);
    }
//输出销毁;
    header('Content-Type:image/png');

    imagepng($_img);

    imagedestroy($_img);
}

function _alert_back($_str){
    echo "<script>alert('".$_str."');history.back()</script>";
    exit();
}
?>
