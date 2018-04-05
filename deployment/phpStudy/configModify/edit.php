<?php
    header("charset=utf-8");
    header("Content-type:text/html;charset=utf-8");
    $info=file_get_contents("config.php");
	preg_match_all("/define\(\"(.*?)\", \"(.*?)\"\)/iU",$info,$a);//.*? 任意字符任意数量，拒绝贪婪匹配，到下一个引号出现就结束。(注意空格)
	echo "<pre>";
	var_dump($a);
	echo "</pre>";
	$keyinfo= array("HOST"=>"主机","USER"=>"用户","PASS"=>"密码","DBNAME"=>"库名");
	echo "<center>";
	echo "<h2>编辑配置文件</h2>";	
	/*    加上all，输出一个二维数组
	    array (size=2)
	  0 => 
	    array (size=1)
	      0 => string 'define("HOST", "localhost")' (length=27)
	  1 => 
	    array (size=1)
	      0 => string 'HOST' (length=4)*/
    echo "<form action='doupdate.php' method='post' >";//不能用get，会把要提交的东西写url后面。
    foreach ($a[1] as $key => $value) {
    	echo "{$keyinfo[$value]}:&nbsp;&nbsp;"."<input type='text' value={$a[2][$key]} name='{$value}'/>"."</br></br>";
    }
    echo "<input type='submit' value='提交' />&nbsp;&nbsp;";
    echo "<input type='reset' value='重置'/>";
    echo "</form>";
    echo "</center>";
   









?>