<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>查看留言</title>
	<script type="text/javascript">
        function del(id) {
        	if(confirm("确定要删除吗？")){
                 window.location="del.php?id="+id;
        	}
        }



	</script>
</head>
<body>
    <center>
        <?php include("config.php") ?>
       <table border="1"  width="580" cellpadding="4"  style="border-collapse: collapse;">
           <tr>
               <th>标题</th>
               <th>留言者</th>
               <th>内容</th>
               <th>IP地址</th>
               <th>时间</th>
               <th>操作</th>
          </tr>
         <!-- php哪用放哪 -->
         <?php 
            $info=file_get_contents("leaveMessage.txt");
             $infoTrim=rtrim($info,"@");
             //拆分为数组
         if (strlen($infoTrim)>=8) {//判断是否为空
		           
		            $infoArr=explode("@@@",  $infoTrim);

		            foreach ( $infoArr as $k=>$v) { //$k是数组键值，$v是每一个数组的具体内容，即一条完整的留言
		            	$oneMeaasge=explode("##",$v);
		            	echo"<tr>";
		            	echo "<td>".$oneMeaasge[0]."</td>";
		            	echo "<td>".$oneMeaasge[1]."</td>";
		            	echo "<td>".$oneMeaasge[2]."</td>";
		            	echo "<td>".$oneMeaasge[3]."</td>";
		            	echo "<td>".date("Y-m-d H:i:m",$oneMeaasge[4])."</td>";
		            	echo "<td><a href='javascript:del($k)'>删除</a></td>";
		            	echo "</tr>";
		           
		            }
		         
         }




         ?>








       </table>




    </center>

</body>
</html>