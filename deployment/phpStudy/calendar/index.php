<?php
header("Content-type:text/html;charset=utf-8");
$year=$_GET['y']?$_GET['y']:date("Y");
$month=$_GET['m']?$_GET['m']:date("m");//m获得月，d获得几号，w获得星期几。
/*Month()函数，获取日期，并选择格式，上述是获取年和月等等信息*/
$day=date("t",mktime(0,0,0,$month,1,$year));//获取对应月的天数。时分秒月日年;t:给定月份包含的天数。
$w=date("w",mktime(0,0,0,$month,1,$year));//mktime返回时间戳   当月的1号是星期几
$k=0;
echo $year;
echo $month."有".$day."天";
$array = array('0' =>'日' , '1' =>'一', '2' =>'二', '3' =>'三', '4' =>'四', '5' =>'五', '6' =>'六');//key可以是字符串或者数组
echo "<center><table border='1'>";
echo "<tr >";
for ($i=0; $i < 7; $i++) { 
	if ($i==0) {
		echo $i;
		echo "<th width='75' align='center' style='color:#ff0000'>星期{$array[$i]}</th>";
	}
	else if ($i==6) {
		    echo "<th width='75' align='center' style='color:#008'>星期{$array[$i]}</th>";
		 }else{
			echo "<th width='75' align='center'>星期{$array[$i]}</th>";
		 }
	
}
echo "</tr>";
//输出日历
for ($i=1; $i<=$day;) {
	   echo "<tr>";
	   if ($i<7-$w+1) {//处理第一行
	   	   for ($j=0; $j<7; $j++) { 
	   	   	    if ($j<$w) {
	   	   	    	echo "<td>&nbsp;</td>";
	   	   	    }else{
	   	   	    	echo "<td>{$i}</td>";
	   	   	    	$i++;
	   	   	    }
	   	   }
	   }else{//处理其他行
	   	  for ($j=0; $j<7; $j++) { 
		    	if ($i<=$day) {
		    		echo "<td>{$i}</td>";
		    	}else{
		    		echo "<td>&nbsp;</td>";
		    	}
		    	$i++;
	      }
	   }
	    echo "</tr>";
}

echo "</table>";
echo "<h2><a href='./index.php?y=".getMonth($year,$month,0)[0]."&&m=".getMonth($year,$month,0)[1]."'>上一月</a><a href='./index.php?y=".getMonth($year,$month,1)[0]."&&m=".getMonth($year,$month,1)[1]."'>下一月</a></h2>";
echo "</center>";
function getMonth($y,$m,$i){
	if ($i==1) {//下一月
		 if($m==12) {
		 	$y=$y+1;
		 	$m=1;
		 }else{
            $m=$m+1;
		 }
		
	}else{//上一月 
       if($m==1) {
		 	$y=$y-1;
		 	$m=12;
		 }else{
            $m=$m-1;
		 }  
	}
    return array($y, $m );

}
?>