<!DOCTYPE html>
<html>
<head lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新闻</title>
</head>
<style type="text/css">
form {
	margin: 20px;
}
</style>
<?php
    session_start();
    if(!isset($_session['username'])){
        echo "error";
    }
    $ueserid=$_COOKIE[username];
    echo $ueserid;
?>
<body>
	<form action="action-addnews.php" method="post">
		<label>标题：</label><input type="text" name="title"> 
        <label>摘要：</label><input type="text" name="abstract"> 
        <label>主题：</label><input type="text" name="theme">
        <label>作者：</label><input type="text"	name="author"> 
        <label>发布时间：</label><input type="date" name="time">
		<label>内容：</label><input type="text" name="content"> <input	type="submit" value="提交">
	</form>
</body>
</html>