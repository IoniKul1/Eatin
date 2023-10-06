<?php

/*

 ________   ______   ________  ______  __    __ 
/        | /      \ /        |/      |/  \  /  |
$$$$$$$$/ /$$$$$$  |$$$$$$$$/ $$$$$$/ $$  \ $$ |
$$ |__    $$ |__$$ |   $$ |     $$ |  $$$  \$$ |
$$    |   $$    $$ |   $$ |     $$ |  $$$$  $$ |
$$$$$/    $$$$$$$$ |   $$ |     $$ |  $$ $$ $$ |
$$ |_____ $$ |  $$ |   $$ |    _$$ |_ $$ |$$$$ |
$$       |$$ |  $$ |   $$ |   / $$   |$$ | $$$ |
$$$$$$$$/ $$/   $$/    $$/    $$$$$$/ $$/   $$/ 
                                                
                                                
                                                

___  ____ ___  _    ____ _   _ _  _ ____ _  _ ___ 
|  \ |___ |__] |    |  |  \_/  |\/| |___ |\ |  |  
|__/ |___ |    |___ |__|   |   |  | |___ | \|  |  
*/


//error_reporting(E_ALL);
//ini_set('display_errors', 1);
error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set("America/Argentina/Buenos_Aires");


define ("ANONYMOUS_USER_LABEL", 'Usuario anónimo');
define ("ANONYMOUS_USER_PIC1", 'AnonymousUser.png');



define("ENV", "PROD");
switch (ENV)
{
	case "DEV":
		define ("UPLOADS_PATH", 'c:/uploads/EATIN/');
		define ("MAILTEMPLATES_PATH", 'c:/REPOS/EATIN/emails/');
		
		//path de la solución:
		define("SLN_PATH", "C:/REPOS/EATIN/");
		//strings de conexion a Memcached:
		$mcConnStrs = array(
		  'cache-01.gobozu.com',
		  'cache-02.gobozu.com',
		  'cache-03.gobozu.com',
		  'cache-04.gobozu.com',
		);
		define("MEMCACHED_DEFAULT_PORT", "11211");
		//strings de conexion a SQLServer:
		$dbConnStrs = array(
		  'sqlsrv:Server=127.0.0.1\SQL2012_2,1433;Database=EATIN',
		  'sqlsrv:Server=127.0.0.1\SQL2012_2,1433;Database=EATIN',
		  'sqlsrv:Server=127.0.0.1\SQL2012_2,1433;Database=EATIN',
		  'sqlsrv:Server=127.0.0.1\SQL2012_2,1433;Database=EATIN',
		);
		define("DB_DEFAULT_USER", "sa");
		define("DB_DEFAULT_PASS", "Kickassstrong140!");
		//definiciones de URLs:
		define("MAIN_DOMAIN", "eatin.gobozu.com");
		define("STATIC_URI", "http://static.".MAIN_DOMAIN.'/');
		define("CONTENT_URI", "http://content.".MAIN_DOMAIN.'/');
		define("SITE_URI", "http://www.".MAIN_DOMAIN.'/');
		define("SITE_SERVICES_URI", "http://api.".MAIN_DOMAIN.'/');
		define("FORGOTPASSWORD_URI", "http://www.".MAIN_DOMAIN.'/recoverpassword/');
		break;
		
		
		
		
		
	case "PROD":
		define ("UPLOADS_PATH", '/uploads/');
		define ("MAILTEMPLATES_PATH", '/usr/share/nginx/html/EATIN/emails/');
		
		
		//path de la solución:
		define("SLN_PATH", "/usr/share/nginx/html/EATIN/");
		//strings de conexion a Memcached:
		$mcConnStrs = array(
		  'cache-01.gobozu.com',
		  'cache-02.gobozu.com',
		  'cache-03.gobozu.com',
		  'cache-04.gobozu.com',
		);
		define("MEMCACHED_DEFAULT_PORT", "11211");
		//strings de conexion a SQLServer:
		//previous: 10.30.20.121 (corresp a FW-X-SRV-2)
		//actual: 10.30.10.90 (corresp a FW-X-SRV-1)
		
		$dbConnStrs = array(
		  'dblib:dbname=EATIN;host=192.168.1.146;charset=utf8',
		  'dblib:dbname=EATIN;host=192.168.1.146;charset=utf8',
		  'dblib:dbname=EATIN;host=192.168.1.146;charset=utf8',
		  'dblib:dbname=EATIN;host=192.168.1.146;charset=utf8',
		);
		define("DB_DEFAULT_USER", "sa");
		define("DB_DEFAULT_PASS", "Kickassstrong140!");
		//definiciones de URLs:
		define("MAIN_DOMAIN", "eatin.gobozu.com");
		define("STATIC_URI", "http://static.".MAIN_DOMAIN.'/');
		define("CONTENT_URI", "http://content.".MAIN_DOMAIN.'/');
		define("SITE_URI", "http://www.".MAIN_DOMAIN.'/');
		define("SITE_SERVICES_URI", "http://api.".MAIN_DOMAIN.'/');
		define("FORGOTPASSWORD_URI", "http://www.".MAIN_DOMAIN.'/recoverpassword/');
		
		break;

		
		
		
		

	case "PROD_WINDOWS":
		define ("UPLOADS_PATH", 'c:/uploads/');
		define ("MAILTEMPLATES_PATH", 'c:/REPOS/EATIN/emails/');
		
		//path de la solución:
		define("SLN_PATH", "C:/REPOS/EATIN/");
		//strings de conexion a Memcached:
		$mcConnStrs = array(
		  'cache-01.gobozu.com',
		  'cache-02.gobozu.com',
		  'cache-03.gobozu.com.',
		  'cache-04.gobozu.com',
		);
		define("MEMCACHED_DEFAULT_PORT", "11211");
		//strings de conexion a SQLServer:
		$dbConnStrs = array(
		  'sqlsrv:Server=192.168.1.146,1433;Database=EATIN',
		  'sqlsrv:Server=192.168.1.146,1433;Database=EATIN',
		  'sqlsrv:Server=192.168.1.146,1433;Database=EATIN',
		  'sqlsrv:Server=192.168.1.146,1433;Database=EATIN',
		);
		define("DB_DEFAULT_USER", "sa");
		define("DB_DEFAULT_PASS", "Kickassstrong140!");
		//definiciones de URLs:
		define("MAIN_DOMAIN", "eatin.gobozu.com");
		define("STATIC_URI", "http://static.".MAIN_DOMAIN.'/');
		define("CONTENT_URI", "http://content.".MAIN_DOMAIN.'/');
		define("SITE_URI", "http://www.".MAIN_DOMAIN.'/');
		define("SITE_SERVICES_URI", "http://api.".MAIN_DOMAIN.'/');
		define("FORGOTPASSWORD_URI", "http://www.".MAIN_DOMAIN.'/recoverpassword/');

		break;


		
	default:
		throw new Exception("System-define ENV not-set, or set to invalid value.");
}



