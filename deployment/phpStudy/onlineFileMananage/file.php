<?php
header("Content-type:text/html;charset=utf-8");
$path="./";
$filelist=array("file.php");

//一、根据action的信息，做对应的操作
 	switch ($_GET["action"]) {
	   	case 'del':
	   		unlink($_GET["filename"]);
	   		break;
	   	case 'create':
	   	     $filename=trim($path,"/")."/".$_POST["filename"];
	   	     if (file_exists($filename)) {
	   	     	die("要创建的文件已存在");
	   	     }
	   	     $f=fopen($filename,"w");
	   	     fclose($f);
	   		 break;
	   	case 'edit':
	   	//1 获取要编辑的文件名
	   	    $filename=$_GET['filename'];
	        $fileinfo=file_get_contents($filename);
	   		break;
		case 'update'://执行修改
	        $filename=$_POST["filename"];
		    $contents=$_POST["content"];
		    file_put_contents($filename,  $contents);
		    break;
	   	default:
	   		break;
   }
//二、浏览文件，输出文件,//浏览指定目录下的文件；
    //1 对path的过滤
	if (!file_exists($path)||!is_dir($path)) {
		die($path."目录无效");
	}
    //2 输出表头
	echo "<center>";
	echo "<h3>{$path}下的文件目录</h3>";
	echo "<h4><a href='file.php?action=add'>创建文件</a></h4>";
	echo "<table width='600' border='1' >";
	echo "<tr background='#CCCCCC'>";
	  echo "<th>序号</th><th>名称</th><th>类型</th><th>大小</th><th>创建时间</th><th>操作</th>";
	echo "</tr>";
	echo "</center>";

	//3 打开文件目录。（是目录，不是路径）
	$dir=opendir($path);
	if ($dir) {
		$i=0;
		while ($f=readdir($dir) ){//读取目录,对数组遍历的一种特殊方法。获得的是名称，也即资源引用
		      if ($f=="."||$f==".."||in_array($f, $filelist)) {//过滤
		      	    continue;
		      }
		        $file=trim($path,"/")."/".$f;//加上路径后的名称
				$i++;
				echo "<tr>";
				  echo "<td>{$i}</td>";
				  echo "<td>{$f}</td>";//名称
				  echo "<td>".filetype($file)."</td>";
				  echo "<td>".filesize($file)."</td>";
				  echo "<td>".filectime($file)."</td>";
				  echo "<td><a href='file.php?filename={$file}&&action=del'>删除</a></td>";//把文件名传过去
				  echo "<td><a href='file.php?filename={$file}&&action=edit'>编辑</a></td>";//把文件名传过去
				echo "</tr>";
		}
    }
    closedir($dir);
    /*  echo "<tr background='#CCCCCC' align='left'><td colspan='6'>&nbsp&nbsp</td></tr>";*/
    echo "</table>";

    if($_GET["action"]=="add"){
         echo "<form action='file.php?action=create' method='post'>";//发送方式是get的话，会把表单的内容传过去。
         echo "新建文件：<input type='text'   name='filename'/>";
         echo "<input type='submit'  value='新建文件'/>";
         echo "</form>";
    }
     if($_GET["action"]=="edit"){
         echo "<form action='file.php?action=update' method='post'>";//发送方式是get的话，会把表单的内容传过去。
         echo "<input type='hidden' value='{$filename}' name='filename'/>";
         echo "文件名:{$filename}</br></br>";
         echo "文件内容：<textarea name='content'>{$fileinfo}</textarea>";
         echo "<input type='submit' value='执行修改'/>";
         echo "</form>";
    }



?>