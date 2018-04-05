<?php
header()
$my=mysqli_connect("localhost","root","");
if (!$my)
  {
  die('Could not connect: ' . mysql_error());
  }
else{echo "hello world";}


    $mysql_server_name="localhost"; //���ݿ����������
    $mysql_username="root"; // �������ݿ��û���[Ĭ��Ϊroot��������ǿ���ͨ��select * from mysql.user ��ʽ��ѯ]
    $mysql_password=""; // �������ݿ�����
    $mysql_database="test"; // ���ݿ������
    $conn=mysqli_connect($mysql_server_name, $mysql_username,$mysql_password);
    
    // �ӱ�����ȡ��Ϣ��sql���
    $strsql="select * from t1";
    // ִ��sql��ѯ
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    // ��ȡ��ѯ���
    $row=mysqli_fetch_row($result);
    
    echo $row;