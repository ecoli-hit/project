<?php session_start();?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
</head>
<body>
<?php
    error_reporting(E_ALL || ~E_NOTICE); 
    $username=$_SESSION['username'];
    $dbServername="localhost";
    $dbUsername="root";
    $dbPassword="root";
    $dbName="user";
    //建立链接
    $conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName)
            or die("connect failed");  
    //用户图片的处理
    function getFileInfo($file,&$file_array){
        $file_array=array();
        $file_array['name']=$_FILE[$file]["name"];
        $file_array['type']=$_FILE[$file]["type"];
        $file_array['size'] = $_FILES[$file]["size"];
        $file_array['temp_name'] = $_FILES[$file]["temp_name"];
    }
    function fileLimit($file){
        //获取文件类型
        //允许上传的图片后缀和文件的大小必须小于200kb
        $allowedExts=array("gif","jpeg","jpg","png");
        $temp=explode(".",$file['name']);
        $extension=end($temp);//获取文件后缀名
        $fileType=$file['type'];
        if ((($fileType=="image/gif")
		||($fileType=="image/jpeg")
		||($fileType=="image/jpg")
		||($fileType=="image/pjpeg")
		||($fileType=="image/x-png")
		||($fileType=="image/png"))
		&&($file['size']<204800)//小于200kb
		&&in_array($extension, $allowedExts)){
		    //验证成功
		    return true;
	    } else {
		    return false;
	    }
    }
    //将图片存储在本机
    function savepicture($file_array){
        $upload=array();
        $path='upload'.date('/Y/m/d');
        $str_path=str_replace("/",$file_array['type']);
        $type=end($temp);
        $str=substr(md5(time()),0,16);//根据时间随机生成文件名
        $filename=$str.".".$type;
        $save_path="upload/head_picture/".$filename;//将文件存储在upload目录下
        move_uploaded_file($file_array['temp_name'],$save_path);
        $upload['save_path']=$save_path;
        $upload['return']=true;
        return $upload['save_path'];
    }
    //处理用户设置信息
    if(isset($_POST['submit'])){
        //接受用户提交的信息
        $realname=trim($_POST['realname']);
        $email=trim($_POST['email']);
        $year_of_admission=trim($_POST['year_of_admissiion']);
        $department=trim($_POST['department']);
        $introduction=trim($_POST['introduction']);
        //将用户设置的信息插入数据库
        $sql="INSERT INTO infoset(realname,email,year_of_admission,department,save_path,introduction)
        VALUE('realname','email','year_of_admission','department','up_load['save_path']','introduction')";
        $result = mysqli_query($conn,$sql)
            or die("query failed");
    }
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <fieldset>
            <ul>
                <li>
                   <td>用户名：</td>
                   <td>
                       <?php echo $username;?> 
                   </td>
                </li>
                <li>
                    <a href="https://cn.bing.com/">修改密码</a>
                </li>
                <li>
                    <label>真实姓名：</label>
                    <input type="text" name="realname" placeholder="Raelname"/>
                </li>
                <li>
                    <label>邮箱：</label>
                    <input type="text" name="email" placeholder="Email"/>
                </li>
                <li>
                    <label>入学年份：</label>
                    <input type="text" name="year_of_admission" placeholder="Year of admission"/>
                </li>
                <li>
                    <label>院系：</label>
                    <input type="text" name="department" placeholder="Department"/>
                </li>
                <li>
                    <label>头像设置：</label>
                    <input enctype="multipart/form-data" type="file"/>
                    <input type="submit" name="up_load_picture" value="保存头像"/>
                </li>
                <li>
                    <label>简介：</label>
                    <input type="text" name="introduction" placeholder="Introduction"/>
                </li>
            </ul>
        </fieldset>
        <input type="submit" name="setting" value="提交"/>
    </form>
</body>
</html>