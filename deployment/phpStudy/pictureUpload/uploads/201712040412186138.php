<?php
header("Content-type:text/html;charset=utf-8");
echo "<pre>";
var_dump($_FILES);
echo "</pre>";

/*$_FILES数组内容如下: 
$_FILES['pic']['name'] 客户端文件的原名称。 
$_FILES['pic']['type'] 文件的 MIME 类型，需要浏览器提供该信息的支持，例如"image/gif"。 
$_FILES['pic']['size'] 已上传文件的大小，单位为字节。 
$_FILES['pic']['tmp_name'] 文件被上传后在服务端储存的临时文件名，一般是系统默认。可以在php.ini的upload_tmp_dir 指定，但 用 putenv() 函数设置是不起作用的。 
$_FILES['pic']['error'] 和该文件上传相关的错误代码。['error'] 是在 PHP 4.2.0 版本中增加的。下面是它的说明：(它们在PHP3.0以后成了常量) 
UPLOAD_ERR_OK 
值：0; 没有错误发生，文件上传成功。 
UPLOAD_ERR_INI_SIZE 
值：1; 上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 
UPLOAD_ERR_FORM_SIZE 
值：2; 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 
UPLOAD_ERR_PARTIAL 
值：3; 文件只有部分被上传。 
UPLOAD_ERR_NO_FILE 
值：4; 没有文件被上传。 
值：5; 上传文件大小为0. */
//执行图片上传
$arrayList=array("image/jpeg","image/jpg","image/png" );
$path="./uploads";//定义上传后的目录。
//1. 获取上传文件信息
$file=$_FILES["pic"];
//2. 过滤文件,查看错误号
if($file['error']>0) {
	switch ($file['error']>0) {
		case 1:
			$info="超出配置文件规定的大小";
			break;
		case 2:
			$info="上传文件超过了表单配置的大小";
			break;
		case 3:
			$info="文件只有部分上传（传到一半断网了）";
			break;
		case 4:
			$info="没有文件被上传";
			break;
		case 6:
			$info="找不到临时文件夹";
			break;
		case 7:
			$info="文件写入失败";
			break;
		default:
			# code...
			break;
		die("上传文件错误，原因：".$info);
	}
}
//3. 本次上传文件大小的过滤
if($file["size"]>100000000) {
	die("上传文件过大！");
}
//4 对文件类型的过滤
/*if (!in_array(needle, haystack)) {
	# code...
}*/
//5上传后的文件名定义
$fileinfo=pathinfo($file["name"]);//取得文件名（带后缀，即1timg.jpg）
do{
   $newfile=date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];//取得后缀，即jpg
}while (file_exists($path.$newfile));//文件已经存在,文件带后缀，带路径"./uploads/20170201201.jpg".

//6 移动文件，把上传的文件移动到相应文件夹
if(is_uploaded_file($file["tmp_name"])) {//判断是否是上传文件
	if (move_uploaded_file($file["tmp_name"], $path."/".$newfile)) {
		echo "上传成功！";
		echo "<h3><a href='index.php'>返回浏览</a></h3>";
	}else{
		die("上传图片失败！");
	}
}else{
	die("不是上传文件");
}



?>