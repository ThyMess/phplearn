<?php
define('IN_TG',true);
define('SCRIPT','face');
require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径
?>
<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>选择头像</title>
    <?php
    require  ROOT_PATH.'includes\title.inc.php'
    ?>
</head>
<body>
    <div id="face">
        <h3>选择头像</h3>
        <dl>
            <?php foreach(range(1,9) as $num){?>
                <dd><img src="face/m0<?php echo $num?>.jpg" alt=""></dd>
            <?php } ?>
        </dl>
        <dl>
            <?php foreach(range(10,20) as $num){?>
                <dd><img src="face/m<?php echo $num?>.jpg" alt=""></dd>
            <?php } ?>
        </dl>
    </div>
</body>
</html>