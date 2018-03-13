<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 14:24
 */
session_start();
if(isset($_SESSION['text'])){
    echo '你已经登陆了用户名是'.$_SESSION['text'];
}else{
    echo "请登录后访问";
    exit();
}
?>
