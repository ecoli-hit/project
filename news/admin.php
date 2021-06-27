<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻后台管理系统</title>
</head>
<style type="text/css">
.wrapper {
	width: 1000px;
	margin: 20px auto;
}

h2 {
	text-align: center;
}

.add {
	margin-bottom: 20px;
}

.add a {
	text-decoration: none;
	color: #fff;
	background-color: red;
	padding: 6px;
	border-radius: 5px;
}

td {
	text-align: center;
}
</style>
<body>
	<div class="wrapper">
		<h2>新闻后台管理系统</h2>
		<div class="add">
			<a href="addnews.php">增加新闻</a>
		</div>
		<table width="980px" border="1">
			<tr>
				<th>ID</th>
				<th>发布者</th>
				<th>标题</th>
				<th>作者</th>
				<th>发布时间</th>
				<th>摘要</th>
				<th>查看全文</th>
				<th>操作</th>
			</tr>

			<?php
                // 1.导入配置文件
                require_once("conn.php");
                $dbc = mysqli_connect(HOST,USER,PASS,DBN)
                    or die ("connected error");
                $query = "SELECT * FROM `news` ORDER BY 'time' ASC";
                $result = mysqli_query($dbc,$query)
                    or die ("quering error");
                $rownum = mysqli_num_rows($result);
                $row = mysqli_fetch_array($result);
				$newname = $row['ID'].".".php;

                for($i=0; $i<$rownum; $i++){
                    echo "<tr>";
                    echo "<td>{$row['ID']}</td>";
                    echo "<td>{$row['producer']}</td>";
                    echo "<td>{$row['title']}</td>";
                    echo "<td>{$row['author']}</td>";
                    echo "<td>{$row['time']}</td>";
                    echo "<td>{$row['abstract']}</td>";
					?>
					<td>
					<script type="text/javascript">
					var url="<?php echo $row['ID']?>";//url是变量
					document.write("<a href=\"news/"+url+".php\">链接</a>");
					</script>
					</td>;
					<td>
					<script type="text/javascript">
					var url="<?php echo $row['ID']?>";//url是变量
					document.write("<a href=\"editnews.php?"+"id="+url+"\">修改</a>");
					</script>
					<?php
                    echo "<a href='javascript:del({$row['ID']})'>删除</a>";
					?>
					</td>;
					<?php
                }
                //释放结果集
                mysqli_free_result($result);
                mysqli_close($dbc);
            ?>
		</table>
	</div>

	<script type="text/javascript">
		function del(id) {
			if (confirm("确定删除这条新闻吗？")) {
				window.location = "action-del.php?id=" + id;
			}
		}
	</script>
</body>
</html>