<?php
	error_reporting(0);
	session_start();
	$host="localhost";
	$user="space4rb_bfj";
	$password="FXhwF_Fq%5Si";
	$db="space4rb_bfj";
	$con=mysql_connect($host,$user,$password);
	mysql_select_db($db,$con);
	//Facebook App Id and Secret
	$appID='611403968912012';
	$appSecret='3efdd9a1a50077df5271aca577c85209';

	//URL to your website root
	if($_SERVER['HTTP_HOST']=='test.vizzmedia.com'){
		$base_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}else{
		$base_url='http://'.$_SERVER['HTTP_HOST'];	
	}


?>