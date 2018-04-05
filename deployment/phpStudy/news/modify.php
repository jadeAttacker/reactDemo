<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	  <title>新闻修改</title>
</head>
<body>
   <center>

       <?php   

          include("menu.php");
          include("config.php");
          $link=mysqli_connect(HOST,USER,PASS) or die("挂了！");
          mysqli_select_db($link,DBNAME);
          $id=$_GET['id'];
          $sql="select * from news where id={$id}";
          $result=mysqli_query($link,$sql);
          if ($result&&mysqli_num_rows($result)>0) {
          /*  几种检测对数据库的操作是否成功的方法：
              搜索数据后：mysqli_num_rows("$result")>0//搜索到的行数,仅仅对select有效。
              删除之后：mysqli_affected_rows($link)>0//INSERT，UPDATE 和DELETE影响到的行数
              插入之后：mysqli_insert_id($link);*/
              $row=mysqli_fetch_assoc($result);/* 取得一行数据，which 开启循环！  $row 接下来还可以使用*/
           
          }
         echo $row['title'];
       ?>
       <h3>发布新闻</h3>
       <form action="action.php?action=update" method="post"><!-- 涉及到图片什么的，有很多规定 -->
            <input type="hidden"  name="id" value="<?php echo $id;?>"/>
            <table>
               <tr>
                  <td align="right">标题：</td>
                  <td><input name="title" type="text"/ value="<?php echo $row['title'];?>"></td>
               </tr>
               <tr>
                  <td align="right">关键字：</td>
                  <td ><input name="keyword" type="text" value="<?php echo $row['keyword'];?>"/></td>
               </tr>
               <tr>
                  <td align="right">作者：</td>
                  <td><input name="author" type="text" value="<?php echo $row['author']; ?>"/></td>
               </tr>
               <tr valign="top">
                  <td align="right">内容：</td>
                  <td><textarea name="contents" cols="25" rows="5"><?php echo $row['contents'];?></textarea></td>
               </tr>
               <tr align="center">
                  <td colspan="2" align="center"><input type="submit" value="修改"/>&nbsp;&nbsp;
                  <input type="reset" value="重置"/></td>
               </tr>
            </table>
       </form>

   </center>

</body>
</html>