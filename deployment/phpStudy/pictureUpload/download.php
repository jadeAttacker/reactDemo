<?php
//本地图片上传到服务器，从服务器上下载图片到本地。
//执行图片下载

//1.获取要下载的文件名（加上路径）
$file="./uploads/".$_GET["name"];//实际中获取的也是服务器中的一个路径。
     
//2. 重设响应类型
$info=getimagesize($file);//该图片相关信息组成的一个数组
header("Content-type:".$info["mime"]);//规定文件类型，与上传文件有关

//3.执行下载的文件名
header("Content-Disposition:attachment;filename=".$_GET["name"]);//MIME协议，以什么方式下载（附件方式）

//4.指定文件的大小
header("Content-length".filesize($file));
//5相应内容
readfile($file);

?>