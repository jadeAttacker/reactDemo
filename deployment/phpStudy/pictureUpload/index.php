<!DOCTYPE html>
<html>
<head>
    <meta  http-equiv="Content-type" content="text/html;charset=utf-8">
	<title>图片的上传和下载</title>
</head>
<body>
    <center>
            <h2>图片的上传和下载</h2>
           <!--  发送方式必须是post，类型必须是multipart/form-data
           服务端接收用全局数组：$_FILES,每个上传文件都有5个上传信息 
           1 name  上传文件名
           2 type 文件类型
           3 tmp_name 上传成功后的临时文件名
           4 error 和该文件上传相关的错误代码
           5 size 上传文件的大小
           -->
            <form  action="doupload.php" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
                 上传图片：<input type="file" name="pic"/>&nbsp<input type="submit" name="" value="上传"/>
            </form>
		    <table width="500" border="0" >
		        <tr bgcolor='#CCCCCC'><th >序号</th><th>图片</th><th>添加时间</th><th>操作</th></tr>
		        <?php
		           $i=1;
		           $dir=opendir("./uploads");
		           while ( $f=readdir($dir)) {//$f不带路径！！！
		           	if ($f=="."||$f=="..") {
		           		continue;
		           	}
    		           echo "<tr>";
    		           echo "<td align='center'>{$i}</td>";
    		           echo "<td align='center'><img src='./uploads/{$f}' width='30' height='40'/></td>";//里面的东西居中对齐（这里指的就是图片）
    		           echo "<td>".date('Y-m-d',filectime("./uploads/{$f}"))."</td>";//文件上次修改时间
    		           echo "<td><a href='./uploads/{$f}'>查看</a> <a href='download.php?name=${f}'>下载</a></td>";
    		           echo "</tr>";
    		           $i++;
		           }
              closedir($dir);
		        ?>
		    </table>
    </center>
</body>
</html>