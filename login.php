<?php
    session_start();


    //对前台传来的数据进行特殊字符的转义，能够有效的防止sql注入等
    $username =trim($_POST['username']);
    $password = sha1(trim($_POST['password']));
    $checkNum = $_POST['checkNum'];
    require_once("loginsql.php");
    $feedback = "账户密码错误";
    if (empty($_POST['username'])){
        header("refresh:3;url=login.html");
        echo "请输入用户名";
        }
    elseif(empty($_POST['password'])){
        header("refresh:3;url=login.html");
        echo "请输入密码";
    }
    elseif (!isset($_POST['checkNum'])){
        header("refresh:3;url=login.html");
        echo "请输入验证码";
    }
    elseif($checkNum!=$_SESSION["validcode"]){
        header("refresh:3;url=login.html");
        echo "验证码错误";
    }
    else{
        if ($row==1){
            $_SESSION['username'] = $username;
		    $_SESSION['islogin'] = 1;
            $feedback="登录成功，将在3秒后跳转"; 
            echo $feedback;
            if ($_POST['remember'] == "yes") {
                setcookie('username', $username, time()+7*24*60*60);
                setcookie('code', sha1($username.sha1($password)), time()+7*24*60*60);
            } 
            else {
                // 没有勾选则删除Cookie
                setcookie('username', '', time()-999);
                setcookie('code', '', time()-999);
            }
            header("refresh:3;url='index.php'");
        }
        else{
        header("refresh:3;url=login.html");
        echo $feedback;
    }
}
?>