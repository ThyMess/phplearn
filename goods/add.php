<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>商品信息管理</title>
    <style>
        .ba{
            display: block;
            width: 40px;
        }
    </style>
</head>
<body>
    <center>
        <?php include("menu.php") ?> <!--导入导航栏-->
        <h3>发布商品信息</h3>
        <form action="action.php?action=add" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <table width="300" >

                <tr>
                    <td align="right" class="ba">名称:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td align="right" class="ba">类型:</td>
                    <td>
                        <select name="typeid">
                            <?php
                            include("config.php");
                            foreach($stylelist as $k=>$v){
                                echo "<option value='{$k}'>$v</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="ba">单价:</td>
                    <td><input type="text" name="price"></td>
                </tr>
                <tr>
                    <td align="right" class="ba">库存:</td>
                    <td><input type="text" name="total"></td>
                </tr>
                <tr>
                    <td align="right" class="ba">图片:</td>
                    <td><input type="file" name="pic"></td>
                </tr>
                <tr>
                    <td align="right" class="ba">描述:</td>
                    <td>
                        <textarea name="note" id="" cols="20" rows="5"></textarea>
                        <br>
                        <input type="submit" value="提交">
                        <input type="reset" value="重置">
                    </td>
                </tr>

            </table>
        </form>
    </center>
</body>
</html>