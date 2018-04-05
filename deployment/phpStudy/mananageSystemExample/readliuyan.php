<?php
/**
 * Created by PhpStorm.
 * User: dw
 * Date: 2017/6/15
 * Time: 20:17
 */
header("Content-type:text/html;charset=utf-8");
$_conn=mysqli_connect("localhost","root","");
mysqli_query($_conn,'use test');
mysqli_query($_conn,"set names utf8");
$_sql="select * from liuyan";
$rs=mysqli_query($_conn,$_sql);//每一行的管道。
while($_row=mysqli_fetch_assoc($rs)){//调用一次向下移动一次，从管道取出的一行
   echo "<li><a href='a.php?id=".$_row['id']."'>".$_row["id"]. "<br>"."</a></li>";
}//mysqli_fetch_all一个包括三行数组的大数组(下标是012）
mysqli_close($_conn);


