<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=utf-8"/>
    <title>修改新闻</title>
</head>
<body>
<?php
    require_once("conn.php");
    $dbc = mysqli_connect(HOST,USER,PASS,DBN)
        or die ("connected error");
    $id = $_GET['id'];
    $query = "SELECT * FROM `news` WHERE id=$id";
    $result = mysqli_query($dbc,$query)
        or die ("quering error");
    echo $id;
    $row = mysqli_fetch_array($result);

?>

<form action="action-editnews.php" method="post">
    <label>新闻ID: </label><input type="text" name="id" value="<?php echo $row['id']?>">
    <label>标题：</label><input type="text" name="title" value="<?php echo $row['title']?>">
    <label>关键字：</label><input type="text" name="keywords" value="<?php echo $row['keywords']?>">
    <label>作者：</label><input type="text" name="author" value="<?php echo $row['author']?>">
    <label>发布时间：</label><input type="date" name="addtime" value="<?php echo $row['addtime']?>">
    <label>内容：</label><input type="text" name="content" value="<?php echo $row['content']?>">
    <input type="submit" value="提交">
</form>

</body>
</html>