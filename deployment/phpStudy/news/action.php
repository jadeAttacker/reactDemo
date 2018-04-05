<?php 
header("Content-type:text/html;charset=utf-8");
include("config.php");
$link=mysqli_connect(HOST,USER,PASS);
mysqli_select_db($link,DBNAME);
switch ($_GET['action']) {
	case 'add':
		    $title=$_POST['title'];
			$keyword=$_POST['keyword'];
			$contents=$_POST['contents'];
			$author=$_POST['author'];
			/*检查是否为空！*/
			if (empty($title)||empty($keyword)||empty($contents)||empty($author)) {
				echo "不能为空！<br>";
			}else{
				$time=time();
				$sql="insert into news values(null,'$title','$keyword','$author','$time','$contents')";
				mysqli_query($link,$sql);
				if (mysqli_insert_id($link)) {
					echo "写入成功";
					echo $title."<br>".$keyword."<br>".$contents."<br>".$author;
				}else{
					echo "写入失败";
				}
			}
		break;
	case 'del':
		echo "要删除的是第".$_GET['id']."条<br>";
		$id=$_GET["id"];
		$sql="delete from  news where id={$id}";
		mysqli_query($link,$sql);
		if (mysqli_affected_rows($link)>0) {
			echo "删除成功！<br>";
		}
		break;
	case 'update':
		echo "要修改的是第".$_POST['id']."条<br>";
		$id=$_POST["id"];
		$title=$_POST["title"];
		$keyword=$_POST["keyword"];
		$author=$_POST["author"];
		$time=time();
		$contents=$_POST["contents"];
		$sql="update news set title='{$title}',keyword='{$keyword}',author='{$author}',time={$time},contents='{$contents}' where id={$id}";
	    /*key是关键字！！！！*/
	    echo $sql;
	    mysqli_query($link,$sql) or die("数据库连接有误".mysqli_error($link));
	    if (mysqli_affected_rows($link)>0) {
			echo "成功！<br>";
		}else{
			echo "失败！<br>";
		}
		break;
	default:
		break;
}
mysqli_close($link);
echo "<a href='index.php'>返回</a>";





 ?>