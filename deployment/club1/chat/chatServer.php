<?php
//require "config.php";
$conn=mysqli_connect('localhost','root','') or die("over");
mysqli_select_db($conn,'test');//数据库
mysqli_query($conn,"SET NAMES gbk");
$sql="select * from  message";
if($_POST['action']=="postmsg"){
     mysqli_query($conn,"insert into message (user,msg,time)  values ({$_POST['name']},{$_POST['message']},{$_POST['time']})");
}
$result=mysqli_query($conn,$sql);//有顺序
if(mysqli_num_rows($result)==0){
     $code=0;
}else{
     $code=1;
}
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<response>\n";
echo "<status>$code</status>\n";//双引号内部变量会执行
echo "</br>";
echo "<time>".time()."</time>\n";
echo "</br>";
if($code==1){
		while ($row = mysqli_fetch_assoc($result)) {
			echo "\t<message>";
			echo "</br>";
		    echo "\t\t<author>{$row['user']}</author>\n";
		    echo "</br>";
		    echo "\t\t<text>{$row['msg']}</text>\n";
		    echo "</br>";
		    echo "\t</message>\n";
		    echo "</br>";
		}

}
echo "</response>\n";
mysqli_close($conn);
?>