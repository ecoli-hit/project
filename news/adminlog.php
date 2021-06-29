<?php
    session_start();
    $username=$_SESSION['username'];
    require_once("conn.php");
    $dbc = mysqli_connect(HOST,USER,PASS,DBN)
        or die ("connected error");
    $query="SELECT $username FROM `signin`";
    $result = mysqli_query($dbc,$query)
        or die ("quering error");
    $row = mysqli_fetch_array($result);
    if ($row['admin']==1){
        echo "抱歉，您没有管理员权限。";
        header("refresh:3;url=../index.php");
    }else{
        echo "欢迎您，管理员".$username;
        header("refresh:3;url='admin.php'");
    }
?>