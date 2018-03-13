<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29
 * Time: 17:09
 * 执行商品信息的增删改操作
 */
//1导入配置文件和函数库
require("config.php");
require("functions.php");

//2连接mysql 选择数据库

$link = mysqli_connect(HOST,USER,PASS,DBNAME) or die('connect error').mysqli_error($link);
mysqli_set_charset($link,'utf8');
//3获取action参数的值并做对应的操作

switch($_GET['action']){
    case "add":
        //1.获取添加信息
        $name = $_POST["name"];
        $typeid = $_POST["typeid"];
        $price = $_POST["price"];
        $total = $_POST["total"];
        $note = $_POST["note"];
        $addtime = time();
        //2.验证省略
        //3.执行图片上传
        $upinfo=uploadFile("pic",'./uploads');
        if($upinfo["error"]===false){
            die("图片信息上传失败".$upinfo["info"]);
        }else{
            //上传成功
            $pic = $upinfo["info"];//获取上传成功的图片名字
        }
        //4.执行图片缩放
        imageupdatesize('./uploads/'.$pic,50,50);

        //5.拼装sql语句执行添加
        $sql = "insert into goods VALUES (null,'{$name}','{$typeid}','{$price}','{$total}','{$pic}','{$note}','{$addtime}')";
        mysqli_query($link,$sql);
        //6.判断并输出结果
        if(mysqli_insert_id($link)>0){
            echo "商品信息发布成功";
        }else{
            echo "商品发布失败".mysqli_error($link);
        }
        echo "<br/><a href='index.php'>查看商品信息</a>";
        break;

    case "del":
        //获取要删除的id并且拼装删除语句执行
        $sql = "delete from goods where id={$_GET['id']}";
        mysqli_query($link,$sql);

        //执行图片删除
        if(mysqli_affected_rows($link)>0){
            @unlink("./uploads/".$_GET['picname']);
            @unlink("./uploads/_s".$_GET['picname']);
        }

        header("location:index.php");
        break;
    case "update"://Xiugai
        //1.获取要修改的信息
        $name = $_POST["name"];
        $typeid = $_POST["typeid"];
        $price = $_POST["price"];
        $total = $_POST["total"];
        $note = $_POST["note"];
        $id = $_POST['id'];
        $pic = $_POST['oldpic'];
        //2.数据验证

        //3.判断有没有图片上传
        if($_FILES['pic']['error']!=4){
            //执行上传
            $upinfo=uploadFile("pic",'./uploads');
            if($upinfo["error"]===false){
                die("图片信息上传失败".$upinfo["info"]);
            }else{
                //上传成功
                $pic = $upinfo["info"];//获取上传成功的图片名字
                //4.有图片上传执行缩放
                imageupdatesize('./uploads/'.$pic,50,50);
            }
        }


        //5.执行修改
            $sql = "update goods set name='{$name}',typeid={$typeid},price={$price},total={$total},note='{note}',pic='{$pic}' WHERE id={$id}";
            mysqli_query($link,$sql);
        //6.判断是否修改成功
            if(mysqli_affected_rows($link)>0){
                //若有图片上传就删除老图片
                      if($_FILES['pic']['error']!=4){
                          @unlink("./uploads/".$_POST['oldpic']);
                          @unlink("./uploads/_s".$_POST['oldpic']);
                      }
                echo "修改成功";
          }
                  else{
                      echo "修改失败";
                  }
        echo "<br/><a href='index.php'>查看商品信息</a>";
        break;
}

//4关闭数据库
mysqli_close($link);






?>
