<?php
    error_reporting(E_ALL || ~E_NOTICE);
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
        $save_path="upload/text_picture/".$filename;//将文件存储在upload目录下
        move_uploaded_file($file_array['temp_name'],$save_path);
        $upload['save_path']=$save_path;
        $upload['return']=true;
        return $upload['save_path'];
    }
    //处理用户设置信息
    if(isset($_POST['submit'])){
        //接受用户提交的信息
        $title=trim($_POST['title']);
        $author=trim($_POST['author']);
        $content=trim($_POST['content']);
        //将用户设置的信息插入数据库
        $sql="INSERT INTO article(titlt,author,content,save_path)
        VALUE('title','author','content','picture_savepath')";
        $result = mysqli_query($conn,$sql)
            or die("query failed");
    }
?>