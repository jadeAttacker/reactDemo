<?php
header("Content-type:text/html;charset=utf-8");
var_dump($_POST);
$info=file_get_contents('config.php');
foreach ($_POST as $key => $value) {
	$info=preg_replace("/define\(\"{$key}\", \".*?\"\)/","define(\"{$key}\", \"{$value}\")",$info);//文件中带的有空格！！！！！

}
var_dump($info);
file_put_contents('config.php',$info);
echo "修改成功！";
echo "<a href='edit.php'>返回修改界面</a>";


?>