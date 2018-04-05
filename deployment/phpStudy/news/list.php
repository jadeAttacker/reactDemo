<!-- 实现搜索功能 -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>新闻搜索</title>
</head>
<body>
    <center>
       <?php  include("menu.php"); ?>
       <h3>搜索新闻</h3>
       <form action="list.php" method="get">
           标题：<input type=text  name='title'  size="8" value="<?php echo isset($_GET["title"])? $_GET['title']: "";?>">
           关键字：<input type=text  name='keyword'  size="8" value="<?php echo isset($_GET["keyword"])? $_GET['keyword']: "";?>">
           作者：<input type=text name='author'  size="8" value="<?php echo isset($_GET["author"])? $_GET['author']: "";?>">&nbsp;&nbsp;
           <input type="submit" value="搜索">&nbsp;
           <br><br>
       </form>
       <table border="1"  width="800"  style="border-collapse:collapse;background:#CCCCCCC">
	       <tr>
	         <th>新闻id</th>
	         <th>新闻标题</th>
	         <th>关键字</th>
	         <th>作者</th>
	         <th>发布时间</th>
	         <th>新闻内容</th>
	         <th>操作</th>
	      </tr>
      <!-- 注意导入的这部分 在前面 -->
       <?php 
          include("config.php");
          /*变量检测则是使用isset，注意变量未声明或声明时赋值为NULL，isset均返回FALSE,$_GET["keyword"]这个东西算是变量*/
          if (!(isset($_GET["title"])&&isset($_GET["keyword"])&&isset($_GET["author"]))) {
          	echo "什么也没输入！！！！";
          	$where="";
          }else{

          	 /*获取搜索信息 */
	           $wherelist=array();
	           $where="";
	           /*给数组赋值*/
	           if (!empty($_GET["title"])) {
	              $wherelist[]=" title like '%{$_GET['title']}'";
	           }
	           if(!empty($_GET["keyword"])) {
	              $wherelist[]="keyword like '%{$_GET['keyword']}'";
	           }
	           if (!empty($_GET["author"]) ){
	           	  $wherelist[]="author like '%{$_GET['author']}'";
	           }
	          var_dump($wherelist);
	          /* 组装搜索条件*/
	          if (count($wherelist)>0) {
	          	/*数组转化为字符串，用and符号隔开*/
	          	$where="where ".implode(" and ",$wherelist);
	          }
	          echo $where;
          }
          

          $link=mysqli_connect(HOST,USER,PASS);
          mysqli_select_db($link,DBNAME);
          $sql="select * from news ".$where;
          $result=mysqli_query($link,$sql);
          while ($row=mysqli_fetch_assoc($result)) {
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