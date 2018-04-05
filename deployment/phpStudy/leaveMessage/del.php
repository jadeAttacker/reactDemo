<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>删除页面</title>
</head>
<body>
     <center>
            <?php include("config.php") ?>
		    <?php
		         $id=$_GET["id"];
		         $info=file_get_contents("leaveMessage.txt");
		
		         	$infoTrim=rtrim($info,"@");
			         $oneMeaasge=explode("@@@",$infoTrim);//包含多条留言的数组
			         echo $oneMeaasge[$id];
			         unset($oneMeaasge[$id]);
			         $info2=implode("@@@", $oneMeaasge);
			         echo  $info2;
			         file_put_contents("leaveMessage.txt",$info2);
			         echo "删除成功！";

		    ?>
  






     </center>
   
</body>
</html>