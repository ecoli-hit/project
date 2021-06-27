<?php     //获取表单
        session_start();
        $username = $_POST['username'];
        $password = trim($_POST['password']);
        $password_confirm = trim($_POST['confirm']);
        $checknum = $_POST['checkNum'];
        $stuNum = $_POST['stuNum'];
        $code = $_SESSION['validcode'];
        $feedback = '注册失败';
        $falg = 0;
        function str_check($str){
            if(!preg_match("/^[A-Za-z0-9]+$/",$str)){
                return TRUE;
            }
            else 
                return FALSE;
        }
        if (isset($_POST['submit'])){
            if(empty($username)||empty($password)||empty($password_confirm)||empty($checknum)||empty($stuNum)){
                header("refresh:3;url='signin.html'");
                echo "请填写完整表单"."<br>";//表单需要非空
            }
            elseif(!preg_match("/^[0-9]*$/",$stuNum)){
                header("refresh:3;url='signin.html'");
                echo "学号为纯数字"."<br>";
            }
            elseif(str_check($username)){
                header("refresh:3;url='signin.html'");
                echo '用户名请使用请使用英文或数字'."<br>";
            }
            elseif($password!=$password_confirm){
                header("refresh:3;url='signin.html'");
                echo "两次输入的密码不相同"."<br>";
            }
            elseif(!preg_match("/^(?![^a-zA-Z]+$)(?!\D+$).{6,16}$/",$password)){
                header("refresh:3;url='signin.html'");
                echo '您的密码必须含有英文和数字，不能有特殊字符，长度6到16个字符'."<br>";
            }
            elseif($checknum!=$code){
                header("refresh:3;url='signin.html'");
                echo '验证码错误';
            }
            else{
                $flag = 1;
            }
        }
        require_once ("signinchecksql.php");//验证用户名是否重复
        if (isset($_POST['submit'])&&(!$row==NULL)){
            header("refresh:3;url='signin.html'");
            $falg = 0;
            echo "$feedback"."用户名重复"."<br>";
        }
        if($flag==1){//注册成功转到login页面
            header("refresh:1;url='login.html'");
            echo 'welcome.'."<br>";
            require_once ("sqlsignin.php");
        }
        else 
    ?>