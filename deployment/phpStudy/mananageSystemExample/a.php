<?php
header("Content-type:text/html;charset=utf-8");
$_conn=mysqli_connect("localhost","root","","test");
mysqli_query($_conn,"set names utf8");
$_sql="select * from liuyan";
$rs=mysqli_query($_conn,$_sql);//多行的管道
while ($row=mysqli_fetch_assoc($rs)){//每次用一行管道取内容
    if( $row['id']==$_GET['id']){
        echo "<h>". $row['title'] ."</h>";
        echo "<p>". $row['content']."</p>";
    }
}
