<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form  enctype="multipart/form-data" method="post" action="ceshi.php?">
    <input type="file" name="ups">
    <input type="submit" value="提交">
</form>
<?php
require("global.func.php");
    $rel=uploadFile("ups","./uploads/");
if($rel['info']){
    echo "<img src='./uploads/{$rel['info']}'>";
}
?>

</body>
</html>