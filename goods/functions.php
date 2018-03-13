<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29
 * Time: 17:14
 * 图片上传函数
 */
function uploadFile($filename,$path,$typelist=null){
    //1.获取上传文件的名字
    $upfile = $_FILES[$filename];
    if(empty($typelist)){
        $typelist = array("image/gif","image/jpeg","image/png","image/jpg");//允许的图片类型
    }
    //指定文件上传路径
    //$path = "uploads"
    $res = array("error"=>false);//存放返回的结果
    //2.过滤文件上传的错误
    if($upfile["error"]>0){
        switch($upfile["error"]){
            case 1:
                //
                $res["info"] = "上传文件超过配置限制";
                break;
            case 2:
                //
                $res["info"] = "上传文件超过html限制";
                break;
            case 3:
                //
                $res["info"] = "部分上传";
                break;
            case 4:
                //
                $res["info"] = "没有上传";
                break;
            case 6:
                //
                $res["info"] = "找不到临时文件";
                break;
            case 7:
                //
                $res["info"] = "文件写入失败";
                break;
            default:
                $res["info"] = "未知错误";
        }
        return $res;
    }
    //3.本次文件大小的限制
    if($upfile['size']>100000){
        $res['info'] = "文件超过大小限制";
        return $res;
    }
    //4.过滤类型
    if(!in_array($upfile['type'],$typelist)){
        $res['info'] = "上传类型错误";
        return $res;
    }
    //5.初始化信息,产生随机图片名字
    $fileinfo = pathinfo($upfile["name"]); //返回:Array ( [dirname] => . [basename] => QQ截图20171123110456.png [extension] => png [filename] => QQ截图20171123110456 )

    do{
        $newfile = date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];  //$fileinfo["extension"] 文件类型后缀
    } while(file_exists($newfile));

    //6.执行上传处理;
    if(is_uploaded_file($upfile["tmp_name"])){
        if(move_uploaded_file($upfile["tmp_name"],$path."/".$newfile)){//执行成功返回一个bool
            $res["info"] = $newfile;
            $res["error"]=true;
            return $res;
        }else{
            $res["info"]="上传失败";
        }
    }else{
        $res["info"]="不是一个上传的文件!";
    }
    return $res;
}

/*图片尺寸函数*/

/*公共函数库
$picname 被缩放的处理图片源
$maxx 缩放后图片的最大宽度
$maxx 缩放后图片的最大高度
$pre 缩放后图片名的前缀名
*/
function imageupdatesize($picname,$maxx=100,$maxy=100,$pre="_s"){
    $info=getimagesize($picname); //获取图片的基本信息
    $w=$info[0];//获取宽度
    $h=$info[1]; // 获取高度
    switch($info[2]){
        case 1: //gif
            $im=imagecreatefromgif($picname);
            break;
        case 2: //jpg
            $im=imagecreatefromjpeg($picname);
            break;
        case 3: //png
            $im=imagecreatefrompng($picname);
            break;
        default;
            die("图片类型错误");
    }
//计算缩放比例
    if(($maxx/$w)>($maxy/$h)){
        $b=$maxy/$h;
    }else{
        $b=$maxx/$w;
    }
//计算缩放后的尺寸
    $nw=floor($w*$b);
    $nh=floor($h*$b);
//创建一个新的图像源
    $nim=imagecreatetruecolor($nw,$nh);
//执行等比缩放
    imagecopyresampled($nim,$im,0,0,0,0,$nw,$nh,$w,$h);
//输出图像
    $picinfo=pathinfo($picname);
    $newpicname=$picinfo["dirname"]."/".$pre.$picinfo["basename"];
    switch($info[2]){
        case 1:
            imagegif($nim,$newpicname);
            break;
        case 2:
            imagejpeg($nim,$newpicname);
            break;
        case 1:
            imagepng($nim,$newpicname);
            break;
    }
//释放图片资源
    imagedestroy($im);
    imagedestroy($nim);
//返回结果
    return $newpicname;
}
?>
