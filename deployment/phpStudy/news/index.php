<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
	<title>新闻信息管理</title>
</head>
<body>
    <center>
       <?php  include("menu.php");  ?>
       <h3>新闻查看</h3>
       <table border="1" width="800"  style="border-collapse:collapse;background:#CCCCCCC;opacity:0.5">
          <tr>
            <td align='center'>新闻id</td>
            <td align='center'>新闻标题</td>
            <td align='center'>关键字</td>
            <td align='center'>作者</td>
            <td align='center'>发布时间</td>
            <td align='center'>新闻内容</td>
            <td align='center'>操作</td>
          </tr>
          <?php 
             include("config.php");
             $link=mysqli_connect(HOST,USER,PASS);
             mysqli_select_db($link,DBNAME);
             $sql="select * from news";
             $result=mysqli_query($link,$sql);
             while($row=mysqli_fetch_assoc($result)){/*自动循环*/
             	echo "<tr align='center'>";
             	echo "<td>".$row['id']."</td>";
             	echo "<td>".$row['title']."</td>";
             	echo "<td>".$row['keyword']."</td>";
             	echo "<td>".$row['author']."</td>";
             	echo "<td>".date("Y-m-d H:i:s",$row['time'])."</td>";
             	echo "<td>".$row['contents']."</td>";
             	echo "<td>"."<a href='action.php?action=del&id=".$row["id"]."'>删除</a>|
             	             <a href='modify.php?id=".$row["id"]."'>修改</a>"."</td>";
             	echo "</tr>";
             }
          ?>
       </table>
    </center>
</body>
</html>