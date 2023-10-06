<?php

require_once('commons.php');
require_once('deployment.php');
require_once('sqlsrv_sprocs.php');


//Cache (local Memcached interface):
class Cache
{
	public $mc;
	public $mcConnStrs;
	
	public function __construct($key)
	{
		global $mcConnStrs;
		$this->mcConnStrs = $mcConnStrs;
		$this->mc = new Memcache();
		$i = $this->GetShardIndexFromKey($key);
		$this->mc->connect($mcConnStrs[$i], MEMCACHED_DEFAULT_PORT);
	}
	private function GetShardIndexFromKey($key)
	{
		//var_dump($this->mcConnStrs);
		return floor( abs(crc32($key)) % count($this->mcConnStrs) ); 
	}
	public function Get($key)
	{
		return $this->mc->get($key);
	}
	public function Set($key, $value)
	{
		return $this->mc->set($key, $value);
	}
}


$_db = null;


//DB (local MSSQL interface):
class DB
{
	public $db;
	public $dbConnStrs;
	public $results = Array();
	
	public function __construct()
	{
		global $dbConnStrs;
		global $_db;
		
		if (!$_db)
		{
			/* $_db = new PDO($dbConnStrs[0], DB_DEFAULT_USER, DB_DEFAULT_PASS, array(PDO::ATTR_PERSISTENT => true) ); */
			$_db = new PDO($dbConnStrs[0], DB_DEFAULT_USER, DB_DEFAULT_PASS );
		}
		$this->db = $_db;
		
		//$this->dbConnStrs = $dbConnStrs;
		//$this->db = new PDO($dbConnStrs[0], DB_DEFAULT_USER, DB_DEFAULT_PASS);
	}
	
	public function ExecSproc($sprocName, $args, $invalidateCache=false)
	{
		global $sprocs;
		$str = $this->PrepareSprocString($sprocName);
		$st = $this->db->prepare($str);
		$sprocParameters = $sprocs->$sprocName->InputParameters;
		$i=1;
		foreach ($sprocParameters as $k)
		{
			$ParameterName = $k->Name;
			if (isset($args->$ParameterName))
			{
				$st->bindValue($i, $args->$ParameterName );
			}
			else
			{
				$st->bindValue($i, null );
			}
			$i++;
		}
		$st->execute();
		$this->results = Array();
		while ($result = $st->fetch(PDO::FETCH_ASSOC))
		{
			array_push($this->results, $result);
		}
	}
	
	public function PrepareSprocString($sprocName)
	{
		global $sprocs;
		$str = 'exec ' . $sprocName . ' ';
		$sprocParameters = $sprocs->$sprocName->InputParameters;
		foreach ($sprocParameters as $k)
		{
			//var_dump($k);
			$str = $str . '@' . $k->Name . '=?,';
		}
		$str = rtrim($str, ",");
		return $str;
	}
}


