<?php
	if(!defined("APPID"))
		define("APPID","wx7fa6fd4b94f47973");
	if(!defined("APPSECRET"))
		define("APPSECRET","bd7ec0f1b39c565d46f4082c27fb6400");
	if(!defined("APPNAME"))
		define("APPNAME","wsestarservice");

	/* if(!defined("APPID"))
		define("APPID","wxd15f2060944c23ba");
	if(!defined("APPSECRET"))
		define("APPSECRET","743defb56a6a64852961ce1452a1139d");
	if(!defined("APPNAME"))
		define("APPNAME","mzone029service"); */
	
	if(!defined("DB"))
		define("DB","salesmanagement");
	if(!defined("URL_BASE"))
		// define("URL_BASE","http://www.wsestar.com/test/YanAn2016/");
		define("URL_BASE","http://www.wsestar.com/test/Smoke-Yanan/");
	if(!defined("PATH_FUNCTION"))
		//define("PATH_FUNCTION","functions.V4.php");
		define("PATH_FUNCTION","../../common/functions.V4.php");
	if(!defined("PATH_DBACCESS"))
		//define("PATH_DBACCESS","dbaccess.v5.php");
		define("PATH_DBACCESS","../../common/dbaccess.v5.php");
	
	if(!defined("DEBUG"))
		define("DEBUG",false);
	
	date_default_timezone_set('Asia/Shanghai');

	include PATH_FUNCTION;
	include PATH_DBACCESS;

	
	$dbms='mysql';     //数据库类型
	$host='localhost'; //数据库主机名
	$dbName='yanan2016';    //使用的数据库
	$dbUser='root';      //数据库连接用户名
	$dbPass='lim1hou';          //对应的密码
	//$dbPass='root'; 
	
	
?>