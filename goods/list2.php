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
    <h3>浏览商品信息</h3>
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


        //2.1分页处理的代码
        //=====================================================
        //1.定义一些分页变量
        $page=isset($_GET['page'])?$_GET['page']:1;    //当前页号
        $pagesize=3;  //页大小//每页多少条
        //$maxrows;       //最大数据条数
        //$maxpages;      //最大页数

        //2.获取最大数据条数

        $sql = "select count(*) from goods";
        $res = mysqli_query($link,$sql);

        function sql_result($result, $number, $field=0) {
            mysqli_data_seek($result, $number);
            $row = mysqli_fetch_array($result);
            return $row[$field];
        }
        $maxrows=sql_result($res,0,0);//整数/条数




        //3.计算出最大页数
        $maxpages = ceil($maxrows/$pagesize);
        //4.效验当前页数 //*********************************************顺序不能颠倒,特别注意
        if($page>$maxpages){
            $page = $maxpages;
        }
        if($page<1){
            $page=1;
        }
        //5.拼装分页sql
        //起始位置,当前页减一乘页大小
        $limit=" limit ".(($page-1)*$pagesize).",{$pagesize}";

        //=====================================================
        //3.执行信息查询
        $sql = "select * from goods ORDER BY addtime DESC {$limit}";
        //echo $sql;
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
    <?php
    echo "<br><br>";
    echo "当前{$page}/{$maxpages}页 共计{$maxrows}条";
    echo "<br>";
    echo "<a href='list2.php?page=1'>首页</a>";
    echo "<a href='list2.php?page=".($page-1)."'>上一页</a>";
    echo "<a href='list2.php?page=".($page+1)."'>下一页</a>";
    echo "<a href='list2.php?page={$maxpages}'>尾页</a>";
    ?>
</center>
</body>
</html>