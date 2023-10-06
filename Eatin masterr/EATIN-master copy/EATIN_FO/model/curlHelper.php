<?php

	$settings = new stdClass();
	$settings->UseProxies = false;
	$proxies = Array();

	//MapProxiesFromFile();
	
	function MapProxiesFromFile()
	{
		//maps proxies from file to global proxies variable.
		global $proxies;
		$prox = Array();
		//$filename = "C:/wamp/www/DTPROJECTS/trunk/XONORO/etc/Proxies.txt";
		$fp = fopen( $filename, "r" ) or die("Couldn't open $filename");
		while ( ! feof( $fp ) ) 
		{
		   $line = fgets( $fp, 1024 );
		   $IP = strtok($line, ':');
		   $Port = strtok('\r\n');
		   $Port = str_replace("\r\n", '', $Port);
		   $o = new StdClass();
		   $o->IP = $IP;
		   $o->Port = $Port;
		   array_push($prox, $o);
		}
		$proxies = $prox;
	}
	

	function CURL($uri, $verb, $args, $headers, $useProxies=false, $fakeGoogle=false)
	{
		//create curl resource
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		//Uso los proxies de LUMINATI.IO:
		if ($useProxies)
		{
			curl_setopt($ch, CURLOPT_PROXY, 'zproxy.luminati.io:22225');
			srand(); $r = rand(10000,999999);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'lum-customer-xonoro-zone-gen-session-rand'. $r .':f419650a6b1f');
		}
		
		curl_setopt($ch, CURLOPT_ENCODING, "");
		//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
		curl_setopt($ch, CURLOPT_USERAGENT, "Nokia7650/1.0 Symbian-QP/6.1 Nokia/2.1");
		
		if ($verb=='GET')
		{
			$uri = $uri . ConcatenateArrayAsURL($args);
			$uri = str_replace(' ', '%20', $uri);
		}
		else if ($verb=='POST')
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		}		
		curl_setopt($ch, CURLOPT_URL, $uri);				//set url
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		//return the transfer as a string
		$output = new StdClass();
		$output->Response = curl_exec($ch);					//$output contains the output string
		$output->StatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$output->EffectiveURL = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		
		curl_close($ch);
		return $output;		
	}

	function mCURL($data)
	{
		error_reporting(0);
		global $settings;
		if ($settings->UseProxies)
		{
			return multiCURLThroughProxies($data);
		}
		else
		{
			return multiCURLNotThroughProxies($data, null);
		}		
	}	
	
	function multiCURLThroughProxies($data)
	{
		global $proxies;
		$proxy = GetRandomOne($proxies);
		$proxy = $proxy->IP . ':' . $proxy->Port;
		//echo $proxy;
		$options = array(CURLOPT_PROXY => $proxy,
						CURLOPT_TIMEOUT => 5,
						CURLOPT_USERAGENT => "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",
						CURLOPT_FOLLOWLOCATION => true
						);
		return multiCURL($data, $options);
	}

	function multiCURLNotThroughProxies($data)
	{
		$options = array(CURLOPT_TIMEOUT => 15,
						CURLOPT_USERAGENT => "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",
						CURLOPT_FOLLOWLOCATION => true
						);
		return multiCURL($data, $options);	
	}	
	
	function multiCURL($data, $options = array()) 
	{	 
		// array of curl handles
		$curly = array();
		// data to be returned
		$result = array();

		// multi handle
		$mh = curl_multi_init();

		// loop through $data and create curl handles
		// then add them to the multi-handle
		foreach ($data as $id => $d) {

		$curly[$id] = curl_init();

		$url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
		curl_setopt($curly[$id], CURLOPT_URL,            $url);
		curl_setopt($curly[$id], CURLOPT_HEADER,         0);
		curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
		
		// post?
		if (is_array($d)) {
		  if (!empty($d['post'])) {
			curl_setopt($curly[$id], CURLOPT_POST,       1);
			curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
		  }
		}

		// extra options?
		if (!empty($options)) {
		  curl_setopt_array($curly[$id], $options);
		}

		curl_multi_add_handle($mh, $curly[$id]);
		}

		// execute the handles
		$running = null;
		do {
		curl_multi_exec($mh, $running);
		} while($running > 0);


		// get content and remove handles
		foreach($curly as $id => $c) {
		$result[$id] = curl_multi_getcontent($c);
		curl_multi_remove_handle($mh, $c);
		}

		// all done
		curl_multi_close($mh);

		return $result;
	}
	
	
	
	function ConcatenateArrayAsURL($arr)
	{
		if (count($arr)==0) return "";
		$URL='';
		foreach ($arr as $key=>$val)
		{
			$URL = $URL . $key . '=' . $val . '&';
		}
		return $URL;	
	}

	