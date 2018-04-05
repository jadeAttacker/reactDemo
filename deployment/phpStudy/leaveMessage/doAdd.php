<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>添加页面</title>
</head>
<body>
    <center>
         <?php include("config.php") ?>
         <h3>添加留言</h3>
         <?php
            //把留言获取，存储，echo一个添加成功，主要在于对数据的获取和存储，步骤如下：
            //1 获取留言内容，补上辅助信息，如ip地址等
            //2 拼接留言信息
           // 3 写入到记事本
           // 4 echo 成功
           $title=$_POST["title"];
           $author=$_POST["author"];
           $contents=$_POST["contents"];
           $ip=$_SERVER["REMOTE_ADDR"];
           $addtime=time();
           $ly="{$title}##{$author}##{$contents}##{$ip}##{$addtime}@@@";
           $info=file_get_contents("leaveMessage.txt");
           file_put_contents("leaveMessage.txt", $info.$ly);
           echo "留言成功";


         ?>


    </center>

</body>
</html>