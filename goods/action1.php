<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 10:37
 */
require("functions.php");
$upinfo=uploadFile("pic",'./uploads');
if($upinfo["error"]===false){
    die("图片信息上传失败".$upinfo["info"]);
}
else{
    echo "上传成功";
}
?>
