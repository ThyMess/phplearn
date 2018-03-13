<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/27
 * Time: 11:27
 */
if(!defined('IN_TG')){
    exit('Access Defined!');
}

//转换路径
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

if(PHP_VERSION<'5.1.0'){
    exit('Version is to Low');
}
//执行耗时
require ROOT_PATH.'includes/global.func.php';

define('START_TIME',_runtime());
?>
