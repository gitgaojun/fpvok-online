<?php

try {
	 //$authKey="abc123";
	 //if(!isset($_REQUEST['authKey'])||md5($authKey)!=trim($_REQUEST['authKey'])){
		 //exit;
	 //}
 
	require_once('../includes/configure.php');
	$mysql_servicer=DB_SERVER;//数据库服务器地址
	$mysql_username=DB_SERVER_USERNAME;//mysql用户名
	$mysql_passwrod=DB_SERVER_PASSWORD;//mysql用户密码
	$mysql_database=DB_DATABASE; //选择的数据库
	$DB_PREFIX = DB_PREFIX;
	$sql_table_prefix = $DB_PREFIX;
	
	
	$requestKind = isset($_REQUEST["requestKind"])?$_REQUEST["requestKind"]:"";
	//连接数据库
	$conntion=mysql_connect($mysql_servicer,$mysql_username,$mysql_passwrod) or die ("0=不能连接数据库:");
	mysql_select_db($mysql_database) or die("0=不能选择这个数据库，或数据库不存在");  
	mysql_query("SET CHARACTER SET utf8");	
	//授权验证
	$can_continue = true;	
	/* 	$user_id = $_REQUEST["user_id"];
	$pwd = $_REQUEST["pwd"];
	$sql="SELECT admin_pass as password FROM `".$sql_table_prefix."admin` WHERE admin_name = '".$user_id."'";	
	$result=mysql_query($sql,$conntion) or die("0=查询失败！错误是：".mysql_error());
	$count=mysql_num_rows($result);
	if($count=="0")
	{
		echo "0=授权验证失败，用户不存在";
	}
	else
	{
		$row = mysql_fetch_array($result);
		$password = $row["password"];
		if($pwd == $password)
		{
			$can_continue = true;			
		}
		else echo "0=授权验证失败，密码错误";
	} */	
 }
 catch(Exception $e){
	echo $e->getMessage();
	exit;
}