<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>浏览商品信息</title>
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
    <h3>搜索信息</h3>
    <form action="list.php" method="get">
        <input type="text" name="name" size="8" value="<?php echo @$_GET['name'] ?>">
       <!-- <input type="text" name="total" size="8">-->
        <input type="submit" value="搜索">
        <input type="button" value="全部信息" onclick="window.location = 'list.php'">
    </form>
    <?php
    $wherelist = array();
    if(!empty($_GET['name'])){
        $wherelist[] = "name like '%{$_GET['name']}%'";
    }
   /* if(!empty($_GET['total'])){
        $wherelist[] = "total like '%{$_GET['total']}%'";
    }*/
    if(count($wherelist)>0){
        $where = " where ".implode(" and ",$wherelist);
    }
    ?>
    <br>
    <table border="1" width="700">
        <tr>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品单价</th>
            <th>库存量</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <?php
        //从数据库读取信息并且输出到浏览器
        //1.导入配置文件
        require("config.php");
        //2.连接数据库.并选择数据库
        $link = mysqli_connect(HOST,USER,PASS,DBNAME) or die('connect error').mysqli_error($link);
        mysqli_set_charset($link,'utf8');
        //3.执行信息查询
        @$sql = "select * from goods {$where} order by addtime desc";
        $result = mysqli_query($link,$sql);
        //4.解析商品信息,解析结果集s
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo '<td>'.         "<img src='./uploads/_s"."{$row['pic']}'>"         . '</td>';
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['total']}</td>";
            echo "<td>".date("Y-m-d H:i:s",$row['addtime'])."</td>";
            echo "<td>
                        <a href='action.php?action=del&id={$row['id']}&picname={$row['pic']}'>删除</a>
                        <a href='edit.php?id={$row['id']}'>修改</a>
                  </td>";
            echo "</tr>";
        }
        //5.释放结果集,关闭数据库
        ?>
    </table>
</center>
</body>
</html>