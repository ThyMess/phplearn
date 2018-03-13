<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>编辑信息</title>
    <style>
        .ba{
            display: block;
            width: 40px;
        }
    </style>
</head>
<body>
<center>
    <?php include("menu.php");
    include("config.php");
     $link = mysqli_connect(HOST,USER,PASS,DBNAME) or die('connect error').mysqli_error($link);
        mysqli_set_charset($link,'utf8');
        //3.huoqu 要修改的商品信息
        $sql = "select * from goods where id={$_GET['id']}";
        $result = mysqli_query($link,$sql);

        if($result && mysqli_num_rows($result)>0){
            $shop = mysqli_fetch_assoc($result);
        }else{
            die("没有找到要修改的商品信息");
        }
    ?> <!--导入导航栏-->
    <h3>发布商品信息</h3>
    <form action="action.php?action=update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="id" value="<?php echo $shop['id'] ?>">
        <input type="hidden" name="oldpic" value="<?php echo $shop['pic'] ?>">
        <table width="300" >

            <tr>
                <td align="right" class="ba">名称:</td>
                <td><input type="text" name="name" value="<?php echo $shop['name']; ?>"></td>
            </tr>
            <tr>
                <td align="right" class="ba">类型:</td>
                <td>
                    <select name="typeid">
                        <?php
                        /*include("config.php");*/
                        foreach($stylelist as $k=>$v){
                            $sd = ($shop['typeid']== $k)?"selected":"";
                            echo "<option value='{$k}' {$sd}>$v</option>";
                        }
                        ?>
                    </select>
                </td
            </tr>
            <tr>
                <td align="right" class="ba">单价:</td>
                <td><input type="text" name="price" value="<?php echo $shop['price']; ?>"></td>
            </tr>
            <tr>
                <td align="right" class="ba">库存:</td>
                <td><input type="text" name="total" value="<?php echo $shop['total']; ?>"></td>
            </tr>
            <tr>
                <td align="right" class="ba">图片:</td>
                <td><input type="file" name="pic"></td>
            </tr>
            <tr>
                <td align="right" class="ba">描述:</td>
                <td>
                    <textarea name="note" id="" cols="20" rows="5" value="<?php echo $shop['note']; ?>"></textarea>
                    <br>
                    <input type="submit" value="修改">
                    <input type="reset" value="重置">
                    <br>
                    <img src="./uploads/_s<?php echo $shop['pic'] ?>" alt="">
                </td>
            </tr>
            <tr>

            </tr>

        </table>
    </form>
</center>
</body>
</html>