<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29
 * Time: 12:51
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}
if(!function_exists('_alert_back')){
    exit('_alert_back()函数不存在请检查');
}
function _check_username($_string,$_min,$_max){
    //去掉两边空格
    $_string = trim($_string);
    //判断长度限制mb_strlen(str,'utf-8');
    if(mb_strlen($_string,'utf-8')<$_min||mb_strlen($_string,'utf-8')>$_max){
        _alert_back('长度不能小于2位或者大于20位');
    }
    //限制敏感字符
    $_char_pattern='/[\'\"\ \  ]/';
    if(preg_match($_char_pattern,$_string)){
        _alert_back('用户名不得包含敏感字符');
    }


    //限制敏感用户名
    $_mg[0] = 'liming';
    $_mg[1] = 'luoyu';
    $_mg[2] = '习近平';
    //告诉用户哪些不能注册
    $_mg_string = null;
    foreach($_mg as $value){
        $_mg_string .=$value . '\n';
    }
    if(in_array($_string,$_mg)){
        _alert_back($_mg_string.'敏感字符不得注册');
    }

    $link = mysqli_connect('localhost','root','','liming');
    return mysqli_real_escape_string($link,$_string);
}
function _check_password($_first_pass,$_end_pass,$_min_num){
    //密码大于6位
    if(strlen($_first_pass)<$_min_num){
        _alert_back('密码不得小于'.$_min_num.'位');
        exit();
    }
    //密码和密码一致
    if($_first_pass!=$_end_pass){
        _alert_back('密码不一致');
        exit;
    }
    return sha1($_first_pass);
}
function _check_question($_string1,$_min,$_max){
    if(mb_strlen($_string1,'utf-8')<$_min||mb_strlen($_string1,'utf-8')>$_max){
        _alert_back('问题长度不能小于2位或者大于20位');
    }
    $link = mysqli_connect('localhost','root','','liming');
    return mysqli_real_escape_string($link,$_string1);
}
function _check_answer($_ques,$_answ,$_min,$_max){
    if(mb_strlen($_answ,'utf-8')<$_min||mb_strlen($_answ,'utf-8')>$_max){
        _alert_back('回答长度不能小于'.$_min.'位或者大于'.$_max.'位');
    }
    //密码提示与回答不能一致;
    if($_ques==$_answ){
        _alert_back('密码提示与回答不能一致');
    }
    //加密返回
    return sha1($_answ);
}
function _check_email($_string){
    if(empty($_string)){
        return null;
    }
   else{
       if(!empty($_string)){
           //验证邮箱
           if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_string)){
               _alert_back('邮件格式不正确');
           }
       }
   }
    return $_string;
}
function _check_qq($_string){
    if(empty($_string)){
        return null;
    }
    else{
        if(!preg_match('/[1-9]{1}[0-9]{3,9}$/',$_string)){
            _alert_back('QQ格式不正确');
        }
    }
    return $_string;
}
function _check_uniqid($_first,$_end){
    if($_first == $_end){
        return true;
    }
    else{
        exit('身份识别失败');
    }
}
?>
