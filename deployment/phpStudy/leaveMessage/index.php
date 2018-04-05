<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>文本留言</title>
</head>
<body>
     <center>
          <?php include("config.php") ?>
          
          <form  action="doAdd.php" method="post" width="">
              <table border="0" width="380" cellpadding="4"><!--   cellpadding和cellspacing -->
                  <tr>
                       <td align="right">标题：</td>
                       <td><input type="text" name="title"></td>
                  </tr>
                  <tr>
                       <td  align="right">留言者：</td>
                       <td><input type="text" name="author"></td>
                  </tr>
                  <tr>
                      <td align="right" valign="top">留言内容：</td>
                       <td><textarea name="contents"  title="contents" cols="30" rows="5"></textarea></td>
                  </tr>
                  <tr>

                      <td colspan="2" align="center">  <!-- 该列内容居中 -->
                          <input type="submit" name="重置" value="重置">&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="submit" name="提交">

                      </td>

                  </tr>

              </table>





          </form>




     </center>

</body>
</html>