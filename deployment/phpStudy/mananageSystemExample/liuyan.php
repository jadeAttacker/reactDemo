<?php
/**
 * Created by PhpStorm.
 * User: dw
 * Date: 2017/6/15
 * Time: 19:24
 */
header("Content-type:text/html;charset=utf-8");
$_conn=mysqli_connect("localhost","root","");
mysqli_query($_conn,'use test');
mysqli_query($_conn,"set names utf8");
//写mysql语句；
$_sql="insert into liuyan(title,content,pubtime) VALUES ('" . $_POST['title']. "','" . $_POST['content'] . "',". time().")";
mysqli_query($_conn,$_sql);
mysqli_close($_conn);
echo  nl2br("ok\n");
echo "ok";

