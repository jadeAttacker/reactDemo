<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
	<title>新闻分页查看</title>
</head>
<body>
    <center>
       <?php  include("menu.php");  ?>
       <h3>新闻分页</h3>
       <form action="list2.php" method="get">
           标题：<input type=text  name='title'  size="8" value="<?php echo isset($_GET["title"])? $_GET['title']: "";?>">
           关键字：<input type=text  name='keyword'  size="8" value="<?php echo isset($_GET["keyword"])? $_GET['keyword']: "";?>">
           作者：<input type=text name='author'  size="8" value="<?php echo isset($_GET["author"])? $_GET['author']: "";?>">&nbsp;&nbsp;
           <input type="submit" value="搜索">&nbsp;
           <br><br>
       </form>
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
              //搜索信息
           if (!isset($_GET["title"])&&!isset($_GET["keyword"])&&!isset($_GET["author"])) {
                  echo "检测url是否有搜索条件：什么也没输入！<br>";
                  $where="";
                  $url="";
           }else{
                 /*获取搜索信息,保留搜索信息 */
                 $wherelist=array();
                 $urllist=array();
                 $where="";
                 $url="";
                 /*给数组赋值*/
                 if (!empty($_GET["title"])) {
                    $wherelist[]=" title like '%{$_GET['title']}'";
                    $urllist[]="title={$_GET['title']}";
                 }
                 if(!empty($_GET["keyword"])) {
                    $wherelist[]="keyword like '%{$_GET['keyword']}'";
                    $urllist[]="keyword={$_GET['keyword']}";
                 }
                 if (!empty($_GET["author"]) ){
                    $wherelist[]="author like '%{$_GET['author']}'";
                    $urllist[]="author={$_GET['author']}";
                 }
                /*var_dump($wherelist);*/
                /* 组装搜索条件*/
                if (count($wherelist)>0) {
                  /*数组转化为字符串，用and符号隔开*/
                  $where="where ".implode(" and ",$wherelist);
                 }
                if (count($urllist)>0) {
                  /*数组转化为字符串，用and符号隔开*/
                  $url="&".implode(" & ",$urllist);
                 }
                  echo "根据搜索条件：".$where."<br>";
                  echo "记录搜索条件：".$url."<br>";
           }

             /*分页限制！*/
             /*echo "检测！".isset($_GET["page"]) ."!检测";*/
             $page=(empty(!isset($_GET["page"]))? $_GET["page"]:1);//无变量时，isset返回的值是1和空。
             $pageSize=3;
             /*获取数据一共有几条*/
             $sql="select * from news {$where}";
             $result=mysqli_query($link,$sql);
             /*
              $sql="select count(*) from news ";
              $result=mysqli_query($link,$sql);
              $total=mysql_result($result,0,0);
                     关于$result:结果集  object(mysqli_result)[2]
                                        public 'current_field' => null
                                        public 'field_count' => null
                                        public 'lengths' => null
                                        public 'num_rows' => null
                                        public 'type' => null
              */
;            $totalPages=ceil(mysqli_num_rows($result)/$pageSize);/*获取行数*/
             if ($page>$totalPages) {
               $page=$totalPages;
             }
             if ($page<1) {
               $page=1;
             }
             $limit="limit ".($page-1)*$pageSize.",{$pageSize}";
             $sql="select * from news {$where} order by time desc {$limit}";
             echo $sql;
             $result=mysqli_query($link,$sql);
             while($row=mysqli_fetch_assoc($result)){
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
       <?php  

          echo "<a href='list2.php?page=".(int)($page-1).$url."'>上一页</a>&nbsp;&nbsp;&nbsp;";
          echo "<a href='list2.php?page=".(int)($page+1).$url."'>下一页</a>&nbsp;&nbsp;&nbsp;";
         echo "第".$page."页/共". $totalPages."页"; 

       ?>
    </center>
</body>
</html>