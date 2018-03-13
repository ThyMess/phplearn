<?php
//防止恶意调用
define('IN_TG',true);
define('SCRIPT','index');
require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径
//执行耗时
?>
<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>MILIFE</title>
    <?php
    require ROOT_PATH.'includes\title.inc.php';
    ?>
</head>
<body>
<?php
require ROOT_PATH.'includes\header.inc.php';
?>
<div id="list">
    list
</div>
<div id="user">
    user
</div>
<div id="pics">
    pic
</div>
<?php
require ROOT_PATH.'includes\footer.inc.php';
?>
</body>
</html>