<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 19:05
 */
uploadfile('ups','./uploads');
function uploadfile($filename,$path,$typelist = null){
    //1.获取上传文件的名字
    $upinfo = $_FILES["$filename"];
    if(empty($typelist)){
        $typelist = array("image/jpeg","image/png","image/gif","image/jpg");
    }
    //指定文件上传路径
    //$path = "uploads"
    //2.过滤文件上传的错误
    $res = array("error"=>false);
    if($upinfo["error"]>0){
        switch($upinfo["error"]){
            case 1:
                //
                echo "上传文件的大小超过php配置的大小,请重新上传";
                break;
            case 2:
                //
                echo "上传文件的大小超过了html限制的大小,请重新上传";
                break;
            case 3:
                //
                echo "文件仅有部分被上传,请刷新重试";
                break;
            case 4:
                //
                echo "没有上传";
                break;
            case 6:
                //
                echo "找不到临时文件";
                break;
            case 7:
                //
                echo "文件写入失败";
                break;
            default:
                echo "未知错误";
        }
        return $res;

    }
    //3.本次文件大小的限制
    if($upinfo['size']>1000000){
        $res["info"] = "文件上传大小超过限制";
        return $res;
    }

    //4.过滤类型
    if(!in_array($upinfo['type'],$typelist)){
        $res['info'] = "文件类型错误";
    }
    //5.初始化信息,产生随机图片名字
    $fileinfo = pathinfo($upinfo['name']);

    do{
        $newfile = date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];
    }while(file_exists($newfile));

    // //6.执行上传处理;
    if(is_uploaded_file($upinfo["tmp_name"])){
        if(move_uploaded_file($upinfo["tmp_name"],$path."/".$newfile)){
            $res["info"] = $newfile;
            $res["error"] = true;
        }else{
            $res["info"] = "上传失败";
        }
    }else{
        $res["info"] ="上传的不是一个文件";
    }
    echo "闪传成功";
    return $res;
}
?>
