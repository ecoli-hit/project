<?php
if(isset($_POST)&&!empty($_POST['content-markdown-doc']))
{
    header("Location: ./index.php");
    $content=$_POST['content-markdown-doc']."\n";//markdown文本
    $content_html=$_POST['content-html-code']."\n";//html文本
    $title=trim($_POST['title'])."\n";
    $author=trim($_POST['author'])."\n";
    $myfile=fopen("data.txt","w") or die("Uabled to open file!");
    fwrite($myfile,$title);
    fwrite($myfile,$author);
    fwrite($myfile,$content);
    fclose($myfile);
    /*
    $dbServername="localhost";
    $dbUsername="root";
    $dbPassword="root";
    $dbName="user";
    $conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName) or die("connect failed");
    $sql="INSERT INTO article(titlt,author,content)
        VALUE($title,$author,$content)";
    $result = mysqli_query($conn,$sql) or die("query failed");
    */
    header("Location: ./view.html");
}
else
{
    $data=file_get_contents('data.txt');
    include_once('./view.html');
}
?>