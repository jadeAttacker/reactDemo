<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>新闻添加</title>
</head>
<body>
   <center>
       <?php   include("menu.php");?>
       <h3>发布新闻</h3>
       <form action="action.php?action=add" method="post"><!-- 涉及到图片什么的，有很多规定 -->
            <table>
               <tr>
                  <td align="right">标题：</td>
                  <td><input name="title" type="text"/></td>
               </tr>
               <tr>
                  <td align="right">关键字：</td>
                  <td ><input name="keyword" type="text"/></td>
               </tr>
               <tr>
                  <td align="right">作者：</td>
                  <td><input name="author" type="text"/></td>
               </tr>
               <tr valign="top">
                  <td align="right">内容：</td>
                  <td><textarea name="contents" cols="25" rows="5"></textarea></td>
               </tr>
               <tr align="center">
                  <td colspan="2" align="center"><input type="submit" value="添加"/>&nbsp;&nbsp;
                  <input type="reset" value="重置"/></td>
               </tr>
            </table>
       </form>

   </center>

</body>
</html>