<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 9:04
 */
function uploadFile($filename,$path,$typelist=null){
    //可调控上传类型,若不设置上传主要为主流图片格式
    if(empty($typelist)){
        $typelist = array("image/jpeg","image/jpg","image/gif","image/png");
    }
    //获取上传文件名字
    $upfile = $_FILES[$filename];
    //错误信息判断
    $res = array("error"=>false);
    if($upfile['error']>0){
        switch($upfile){
            case 1:
                //
                $res['info']="上传大小超过php.in限制";
                break;
            case 2:
                //
                $res['info']="上传大小超过html限制";
                break;
            case 3:
                //
                $res['info']="文件部分上传";
                break;
            case 4:
                //
                $res['info']="文件没有上传";
                break;
            case 6:
                //
                $res['info']="找不到临时文件";
                break;
            case 7:
                //
                $res['info']="文件写入失败";
                break;
            default:
                $res['info']="未知错误";
        }
        return $res;
    }
    //文件大小限制
    if($upfile['size']>100000){
        $res["info"] = "上传文件大小过大";
        return $res;
    }
    //文件类型限制
    if(!in_array($upfile['type'],$typelist)){
        $res['info'] = "文件类型错误";
        return $res;
    }
    //初始化名字
    $fileinfo = pathinfo($upfile['name']);

    do{
        $newfile = date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];
    }while(file_exists($newfile));

    //执行上传
    if(is_uploaded_file($upfile['tmp_name'])){
        if(move_uploaded_file($upfile['tmp_name'],$path."/".$newfile)){
            $res['info'] = $newfile;
            $res["error"] = true;
        }else{
            $res['info']="上传文件失败";
        }
    }else{
        $res["info"]="不是一个上传的文件!";
    }
    return $res;
}
?>
