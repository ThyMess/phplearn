<?php
define('IN_TG',true);/*防止恶意调用*/
define('SCRIPT','reg');/*页面识别*/
require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径

session_start();
if(@$_GET['action']=='register'){
    //为了防止恶意注册/跨站攻击
    if(!($_POST['yzm']==$_SESSION['code'])){
        _alert_back('验证失败');
    }
    require ROOT_PATH.'includes/regster.func.php';
//创建一个空数组用来存放提交过来的合法数据
    $_clean = array();

    //通过表识识别身份;
    $_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
    //激活
    $_clean['active'] = sha1(uniqid(rand(),true));
    //验证用户名;
    $_clean['username'] =_check_username($_POST['username'],2,20);

    $_clean['password'] =_check_password($_POST['password'],$_POST['notpassword'],6);

    $_clean['question'] = _check_question($_POST['question'],2,20);

    $_clean['answer'] = _check_answer($_POST['question'],$_POST['answer'],2,20);

    $_clean['sex'] = $_POST['sex'];

    $_clean['email'] = _check_email($_POST['email']);

    $_clean['qq'] =_check_qq($_POST['qq']) ;
    print_r($_clean);
}
    //唯一表示符
    $_SESSION['uniqid'] = $_uniqid = sha1(uniqid(rand(),true));
?>

<!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <script src="js/face.js"></script>
    <?php
    require ROOT_PATH.'includes\title.inc.php';
    ?>
    <link rel="stylesheet" href="styles/1/index.css">
    <style>
        #code{
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
require ROOT_PATH.'includes\header.inc.php';
?>
<div id="register">
    <h2>会员注册</h2>
    <form action="register.php?action=register" method="post">
        <input  type="hidden" name="uniqid" value="<?php echo $_uniqid ?>">
        <dl>
            <dt>请认真填写一下内容:</dt>
            <dd>用&nbsp; 户&nbsp; 名:<input  type="text" name="username" class="text"></dd>
            <dd>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:<input  type="password" name="password" class="text"></dd>
            <dd>确认密码:<input  type="password" name="notpassword" class="text"></dd>
            <dd>密码提示:<input  type="text" name="question" class="text"></dd>
            <dd>密码回答:<input  type="text" name="answer" class="text"></dd>
            <dd>性    别:<input  type="radio" name="sex" value="男" checked="checked">男<input  type="radio" name="sex" value="女">女</dd>
            <dd>头像:<input type="hidden" value="" id="opic"><img src="face/m01.jpg" alt="头像选择" class="head_img" id="img_id"></dd>
            <dd>电子邮件:<input  type="text" name="email" class="text"></dd>
            <dd>QQ:<input  type="text" name="qq" class="text"></dd>
            <dd>验证码:<input  type="text" name="yzm" class="text yzm"><img src="code.php" alt="" id="code"></dd>
            <dd><input type="submit" value="注册"></dd>
        </dl>
    </form>
</div>
<?php
require ROOT_PATH.'includes\footer.inc.php';
?>
<script>
    window.onload = function () {
        var ele  = document.getElementById('code');
        ele.onclick = function () {
            this.src = 'code.php?tm="'+Math.random()+'"';
        }
    }
</script>
</body>
</html>