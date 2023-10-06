<?php


//	Ejemplo de invocación a servicio:
//  https://api_eatin.gobozu.com/services/?service=Eatin_CheckStatus


require_once(__DIR__ . '/../model/dal.php');
require_once(__DIR__ . '/../model/curlHelper.php');


error_reporting(0);
error_reporting(E_ALL);


class Services
{
	
	public function run()
	{
		//determino si estoy en una pagina de la pinta:
		//https://services.shopsapps.gobozu.com/?service=CPI_GetTrending&AUToken=...				AUToken=AppUserToken	AOT=AppOwnerToken
		//Si es así, devuelvo el resultado del método en service y salgo.
		if (isset($_REQUEST['service']))
		{
			$service = trim($_REQUEST['service']);

			try
			{
				isset($_REQUEST['callback'])? $callback = $_REQUEST['callback']  : $callback=null;
				isset($_REQUEST['callbackAdditionalArgs'])? $callbackAdditionalArgs = $_REQUEST['callbackAdditionalArgs'] : $callbackAdditionalArgs=null;
			
				if ( method_exists($this, $service) )
				{
					$params = array_map('trim', $_REQUEST);		//quitamos todos los espacios en blanco del array $params.
					//TODO: sanitizar params para inyecciones de código, etc.
					$resp = $this->$service($params);
					if (isset($resp->message) ) $resp->localizedMessage = $this->GetLocalizedMessage($resp->message);
					if ( isset($params['RedirectTo']) )
					{
						header('Location:' . $params['RedirectTo']);
						return;
					}
				}
				else
				{
					$resp = new StdClass();
					$resp->retCode = 400;
					$resp->message = "Error";
					$resp->status = "Unknown method.";
				}

				echo jsonp_encode($resp, $callback, $callbackAdditionalArgs);
				return;
			}
			catch(Exception $e)
			{
				echo "Exception!: " . $e->getMessage();
				return;
			}
		}
	}



	public function GetLocalizedMessage($str)
	{
		switch($str)
		{
			case 'Error: invalid credentials.':
				return 'Email o Password inválidos';
				break;
			default:
				return $str;
		}
		return $str;
	}

	
	public function Eatin_PHPInfo($params)
	{
		phpinfo();
	}

	public function GoogleMaps_Geocode($params)
	{
		$address = $params['address'];
		$uri = "https://maps.googleapis.com/maps/api/geocode/json?address=". $address ."&key=AIzaSyDPTyAMfrLiw8JREJ25vHFvbuzMBcdbBJE";
		$verb = 'GET';
		$headers = Array();
		$args = Array();
		$curl = CURL($uri, $verb, $args, $headers, false, false);
		$doc = json_decode($curl->Response);
		return $doc;
	}
	
	public function Eatin_CheckStatus($params)
	{
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->status = "Eatin is OK.";
		//$retObj->dir = __DIR__;
		return $retObj;
	}
	
	public function Eatin_CheckStatus1($params)
	{
		$db = new DB();
		
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->status = "ShopsApps is OK.";
		$retObj->whatever = '{"retCode":200,"response":"OK","message":"OK. Listing Places.","results":[{"ID":"66","Name":"Tacita de Te","Description":"Lindo ambiente","Lat":"-34.5820203","Lon":"-58.4261644","Alt":null,"Pic1":"B43F2B67-2C99-4079-9977-7254677E13D0--5485679B-1ACF-FF58-B578-708CC8125073.jpg","Pic2":null,"Pic3":null,"VotesTotal":"3","VotesAvg":"3","OpenHours":null,"placecategory":{"id":"1","name":"Bar"},"UUID":null,"CanCheckinHere":true,"Distance":9.9871535692009,"isReported":false},{"ID":"67","Name":"Tacita de te","Description":"Te","Lat":"-34.5820249","Lon":"-58.4261805","Alt":null,"Pic1":"40E4FEE5-762F-1E52-B5C6-5A938A3093A3--A7FAAC6B-0189-7F06-FBCC-A2B4A1E9D458.jpg","Pic2":null,"Pic3":null,"VotesTotal":"2","VotesAvg":"2","OpenHours":null,"placecategory":{"id":"1","name":"Bar"},"UUID":null,"CanCheckinHere":true,"Distance":11.427821652699,"isReported":false},{"ID":"69","Name":"Hfyf","Description":"Jdjdydy","Lat":"-34.5820359","Lon":"-58.4261872","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"1","name":"Bar"},"UUID":null,"CanCheckinHere":true,"Distance":12.69685029906,"isReported":false},{"ID":"70","Name":"Yeyeue","Description":"Euduru","Lat":"-34.5820359","Lon":"-58.4261872","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"2","name":"Cafe"},"UUID":null,"CanCheckinHere":true,"Distance":12.69685029906,"isReported":true},{"ID":"74","Name":"La Carnicer\u00eda","Description":"+54 11 2071-7199","Lat":"-34.5828478","Lon":"-58.4237814","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"26","name":"Restaurant"},"UUID":"ChIJ-bHkb4S1vJURYMcjNGv1uR0","CanCheckinHere":false,"Distance":232.92464038812,"isReported":false},{"ID":"77","Name":"Las Pizarras","Description":"+54 11 4775-0625","Lat":"-34.5830549","Lon":"-58.4241968","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"26","name":"Restaurant"},"UUID":"ChIJdX2NaIS1vJURhzjb3PlEhjA","CanCheckinHere":false,"Distance":211.5266476744,"isReported":false},{"ID":"83","Name":"ESEADE","Description":"+54 11 4773-5825","Lat":"-34.580827","Lon":"-58.42303799999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":"1","VotesAvg":"5","OpenHours":null,"placecategory":{"id":"23","name":"Universidad"},"UUID":"ChIJreNIYIO1vJUReLrOqjY1tiM","CanCheckinHere":false,"Distance":306.02521087642,"isReported":false},{"ID":"88","Name":"Pepe bar","Description":"Hola","Lat":"-34.5820215","Lon":"-58.4261912","Alt":null,"Pic1":"21F28B4E-62D0-AFBC-AA19-70024F0352AC--9C1FD762-64DB-E870-60B1-411E0397E4D4.jpg","Pic2":null,"Pic3":null,"VotesTotal":"3","VotesAvg":"3","OpenHours":null,"placecategory":{"id":"1","name":"Bar"},"UUID":null,"CanCheckinHere":true,"Distance":11.968151427851,"isReported":false},{"ID":"102","Name":"Cafe Martinez","Description":null,"Lat":"-34.580726","Lon":"-58.42261999999999","Alt":null,"Pic1":"Martinez.png","Pic2":null,"Pic3":null,"VotesTotal":"1","VotesAvg":"3","OpenHours":null,"placecategory":{"id":"2","name":"Cafe"},"UUID":null,"CanCheckinHere":false,"Distance":345.56987944792,"isReported":false},{"ID":"105","Name":"Giramondo Hostel & Bar","Description":"+54 11 4772-6740","Lat":"-34.580364","Lon":"-58.4255539","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":"1","VotesAvg":"5","OpenHours":null,"placecategory":{"id":"27","name":"Bar"},"UUID":"ChIJ_8yI04S1vJURcUwxyKmjwIQ","CanCheckinHere":false,"Distance":183.86198814958,"isReported":false},{"ID":"106","Name":"Starbucks Coffee","Description":"+54 11 5530-7000","Lat":"-34.580396","Lon":"-58.42755500000001","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"28","name":"Cafe"},"UUID":"ChIJX4n3YsurSgARS2J5G9S9rfw","CanCheckinHere":false,"Distance":219.77228339953,"isReported":false},{"ID":"176","Name":"Uni. Siglo 21","Description":"","Lat":"-34.5822382","Lon":"-58.42701209999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"23","name":"Universidad"},"UUID":"ChIJlajoE4W1vJUR1Vrn24D9Vz0","CanCheckinHere":false,"Distance":90.380381505578,"isReported":false},{"ID":"207","Name":"Maria Felix","Description":"+54 11 4775-0380","Lat":"-34.5828829","Lon":"-58.42893739999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"26","name":"Restaurant"},"UUID":"ChIJ43ywiY-1vJURzSkGPlYgfMU","CanCheckinHere":false,"Distance":280.62019216693,"isReported":false},{"ID":"229","Name":"Testplce","Description":null,"Lat":"-34.581914966797","Lon":"-58.4261444023","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"1","name":"Bar"},"UUID":null,"CanCheckinHere":true,"Distance":7.2831854932134,"isReported":false},{"ID":"230","Name":"Homo Bar","Description":null,"Lat":"-34.581933362695","Lon":"-58.426079883708","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":"2","VotesAvg":"5","OpenHours":null,"placecategory":{"id":"1","name":"Bar"},"UUID":null,"CanCheckinHere":true,"Distance":2.84918012299,"isReported":false},{"ID":"236","Name":"Los recuerdos de ella","Description":"+54 11 3237-8840","Lat":"-34.58158009999999","Lon":"-58.4264102","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"27","name":"Bar"},"UUID":"ChIJGfRZIoW1vJURCisNtGsArQg","CanCheckinHere":false,"Distance":51.549919618798,"isReported":false},{"ID":"245","Name":"Peruvian","Description":"","Lat":"-34.5820935","Lon":"-58.4246985","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"26","name":"Restaurant"},"UUID":"ChIJbz6Q84S1vJURF3PSgyQ1G6g","CanCheckinHere":false,"Distance":127.82346838518,"isReported":false},{"ID":"246","Name":"Albornoz","Description":"+54 11 4771-4644","Lat":"-34.5822955","Lon":"-58.424891","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"26","name":"Restaurant"},"UUID":"ChIJgVN_9oS1vJURBXJmj7xoycM","CanCheckinHere":false,"Distance":115.55717469971,"isReported":false},{"ID":"247","Name":"Parrilla El Pensador","Description":"","Lat":"-34.5822592","Lon":"-58.42469159999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"26","name":"Restaurant"},"UUID":"ChIJGylQ9IS1vJURXmxVhWT_9HY","CanCheckinHere":false,"Distance":131.87765989494,"isReported":false},{"ID":"250","Name":"Elepants Distrito Arcos","Description":"+54 11 5789-4833","Lat":"-34.5812405","Lon":"-58.4282991","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJC2YZpcyrSgAR30aZBDATREk","CanCheckinHere":false,"Distance":217.85172083695,"isReported":false},{"ID":"251","Name":"Mabele SA","Description":"+54 11 4772-4469","Lat":"-34.5817886","Lon":"-58.4265754","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJ5f4aGIW1vJUR_i8IfVzMEsY","CanCheckinHere":true,"Distance":48.705676712273,"isReported":false},{"ID":"252","Name":"TOWN HOUSE SOHO II","Description":"+54 11 4778-9100","Lat":"-34.5826094","Lon":"-58.4267735","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJtW1YDoW1vJURduwYyt5-wJk","CanCheckinHere":false,"Distance":95.959305263336,"isReported":false},{"ID":"253","Name":"Hostel Crudivegano","Description":"","Lat":"-34.582627","Lon":"-58.4267115","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJp6wVD4W1vJURNqgbZDNWs24","CanCheckinHere":false,"Distance":93.87247981454,"isReported":false},{"ID":"254","Name":"Monserrat","Description":"","Lat":"-34.58154030000001","Lon":"-58.42558380000001","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJT3bI4IS1vJUROAJbqZPSfKI","CanCheckinHere":false,"Distance":65.344142366737,"isReported":false},{"ID":"255","Name":"CASA ENCANTADA","Description":"+54 11 4773-5404","Lat":"-34.582037","Lon":"-58.425411","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJE40y-4S1vJURv6Fs9tzN6xI","CanCheckinHere":false,"Distance":62.324709896726,"isReported":false},{"ID":"256","Name":"Vain Boutique Hotel","Description":"+54 11 4776-8246","Lat":"-34.583693","Lon":"-58.42488700000001","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJ-xVER4S1vJURTsgCOdyuLqk","CanCheckinHere":false,"Distance":221.86228532167,"isReported":false},{"ID":"257","Name":"HELADOS NICOLO CHARCAS","Description":"","Lat":"-34.581346","Lon":"-58.426208","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"30","name":"Comida"},"UUID":"ChIJk-JRIYW1vJURjzb7w8pihvM","CanCheckinHere":false,"Distance":69.043691041579,"isReported":false},{"ID":"258","Name":"Iglesia San Pablo","Description":"+54 11 4773-8291","Lat":"-34.5816202","Lon":"-58.42604660000001","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJ1wkgIIW1vJURe-33oFbJ35E","CanCheckinHere":true,"Distance":37.795711635547,"isReported":false},{"ID":"259","Name":"Museo Casa de Alfredo Palacios","Description":"","Lat":"-34.5810325","Lon":"-58.42650759999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJaVqUL4W1vJURvhsn3JDp3iQ","CanCheckinHere":false,"Distance":110.00488261023,"isReported":false},{"ID":"260","Name":"Hostel Suites Palermo","Description":"+54 11 4773-0806","Lat":"-34.5810629","Lon":"-58.42666209999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJq3w9MIW1vJURQQvHb-7aRhc","CanCheckinHere":false,"Distance":112.74106449089,"isReported":false},{"ID":"261","Name":"Residencial Oro","Description":"","Lat":"-34.5809837","Lon":"-58.4262394","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJm4WtKIW1vJURVP2o3HvZ-l0","CanCheckinHere":false,"Distance":109.32314753331,"isReported":false},{"ID":"262","Name":"Multiespacio Korova","Description":"+54 11 3970-3010","Lat":"-34.5833609","Lon":"-58.4259107","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJw3dMrYW1vJURoyWnjutNyMs","CanCheckinHere":false,"Distance":156.74119734562,"isReported":false},{"ID":"263","Name":"Kurata Dojo","Description":"+54 11 4774-4409","Lat":"-34.581811","Lon":"-58.4267552","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJweuUF4W1vJURP5kLyrGtIA0","CanCheckinHere":false,"Distance":63.505270813716,"isReported":false},{"ID":"264","Name":"Seveso Luis A Dr","Description":"+54 11 4771-7105","Lat":"-34.5825214","Lon":"-58.42607499999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJ5-2TAYW1vJURzqlZqebSpGg","CanCheckinHere":false,"Distance":62.584645226111,"isReported":false},{"ID":"265","Name":"aeropuerto ezeiza","Description":"","Lat":"-34.5822137","Lon":"-58.42508459999999","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJrV3I8IS1vJURwYDDpunC6Ds","CanCheckinHere":false,"Distance":95.88468107527,"isReported":false},{"ID":"266","Name":"Art Factory Hostel Soho","Description":"+54 11 4774-2639","Lat":"-34.5823924","Lon":"-58.4248382","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJUyx09oS1vJURKQ7dphQUlU0","CanCheckinHere":false,"Distance":123.92318387453,"isReported":false},{"ID":"267","Name":"Godoy Cruz Suites","Description":"+54 9 11 3589-9620","Lat":"-34.5812279","Lon":"-58.4273628","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJPzSxSYW1vJUR1UsPR6E_cpw","CanCheckinHere":false,"Distance":142.4238811057,"isReported":false},{"ID":"268","Name":"Amasoho Hostel","Description":"+54 11 4777-3834","Lat":"-34.5818279","Lon":"-58.4252692","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJ4-yf5YS1vJURRd37HVyGhRY","CanCheckinHere":false,"Distance":76.095278609062,"isReported":false},{"ID":"269","Name":"Maxifun Hobbies SRL","Description":"+54 11 4773-9189","Lat":"-34.5827994","Lon":"-58.4265188","Alt":null,"Pic1":null,"Pic2":null,"Pic3":null,"VotesTotal":null,"VotesAvg":null,"OpenHours":null,"placecategory":{"id":"32","name":"TYPE_POINT_OF_INTEREST"},"UUID":"ChIJFXDRB4W1vJUR_0ktIeQkSGU","CanCheckinHere":false,"Distance":101.57190208951,"isReported":false}],"localizedMessage":"OK. Listing Places."}';
		phpinfo();
		return $retObj;
	}

	public function Eatin_CheckStatus2($params)
	{
		error_reporting(-1);

		$db = new DB();
		$db->ExecSproc('Countries_View', $args, true);
		var_dump($db);

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->status = "ShopsApps is OK.";
		return $retObj;
	}
	
	

	public function Eatin_GetAppSettings($params)
	{
		$ret = new StdClass();
		$ret->STATIC_URI = STATIC_URI;
		$ret->CONTENT_URI = CONTENT_URI;
		$ret->CHAT_REFRESH_SECONDS = 15;
		$ret->APPS_TIMEOUT = 10;
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->status = "OK. Returning App settings.";
		$retObj->message = "OK. Returning App settings.";
		$retObj->settings = $ret;
		return $retObj;
	}
	

	public function Eatin_UploadFileTest($params)
	{
		$fichero = 'c:/uploads/gente.txt';
		// Abre el fichero para obtener el contenido existente
		$actual = file_get_contents($fichero);
		// Añade una nueva persona al fichero
		$actual .= "John Smith\n";
		// Escribe el contenido al fichero
		file_put_contents($fichero, $actual);
	}
	
	
	
	public function Cache_Test($params)
	{
		try
		{
			$k = fHash( rand() );
			$mc = new Cache($k);
			$mc->Set($k, 'value12345');
			$value = $mc->Get($k);
			if ($value=='value12345')
			{
				$retObj = new StdClass();
				$retObj->retCode = 200;
				$retObj->result = "OK";
				$retObj->status = "OK. Test passed.";
				return $retObj;
			}
			else
			{
				$retObj = new StdClass();
				$retObj->result = "Error";
				$retObj->retCode = 500;
				$retObj->status = "Failed. Test failed.";
				return $retObj;
			}
		}
		catch(Exception $e)
		{
			$retObj = new StdClass();
			$retObj->result = "Error";
			$retObj->retCode = 500;
			$retObj->status = "Failed. Test failed. " . $e->getMessage();
			$retObj->message = "Failed. Test failed. " . $e->getMessage();
			return $retObj;
		}
	}


	//Entidad Countries:
	public function Countries_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$country = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$country->ExecSproc('Countries_View', $args, true);
		if ($country->results)
		{
			foreach($country->results as $countryResult)
			{
				$arrElem = $this->Countries_Map($countryResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Countries.';
		return $retObj;
	}


	public function Countries_Map($countriesResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $countriesResult['ID'];
		$arrElem->Name = $countriesResult['Name'];
		return $arrElem;
	}
	




	//Entidad State:
	//Entidad Countries:
	public function State_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$state = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$state->ExecSproc('State_View', $args, true);
		if ($state->results)
		{
			foreach($state->results as $stateResult)
			{
				$arrElem = $this->State_Map($stateResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing States.';
		return $retObj;
	}


	public function State_Map($statesResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $statesResult['ID'];
		$arrElem->Name = $statesResult['Name'];
		return $arrElem;
	}	





	//Entidad Restaurant:
	public function Restaurant_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$restaurant = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$restaurant->ExecSproc('Restaurant_View', $args, true);
		if ($restaurant->results)
		{
			foreach($restaurant->results as $restaurantResult)
			{
				$arrElem = $this->Restaurant_Map($restaurantResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Restaurants.';
		return $retObj;
	}


	public function Restaurant_Map($restaurantResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $restaurantResult['ID'];
		$arrElem->ID_State = $restaurantResult['ID_State'];
		$arrElem->DateCreation = $restaurantResult['DateCreation'];
		$arrElem->Nombre = $restaurantResult['Nombre'];
		$arrElem->Lat = $restaurantResult['Lat'];
		$arrElem->Lon = $restaurantResult['Lon'];
		$arrElem->GoogleGeocodeAddress = $restaurantResult['GoogleGeocodeAddress'];
		$arrElem->Address = $restaurantResult['Address'];
		$arrElem->Email = $restaurantResult['Email'];
		$arrElem->LogoSize1 = $restaurantResult['LogoSize1'];
		$arrElem->LogoSize2 = $restaurantResult['LogoSize2'];
		$arrElem->AppCSS = $restaurantResult['AppCSS'];
		$arrElem->SplashVideo = $restaurantResult['SplashVideo'];
		return $arrElem;
	}	







	//Entidad Restaurant:
	public function Table_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$table = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		$table->ExecSproc('Table_View', $args, true);
		if ($table->results)
		{
			foreach($table->results as $tableResult)
			{
				$arrElem = $this->Table_Map($tableResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Tables.';
		return $retObj;
	}


	public function Table_Map($tableResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $tableResult['ID'];
		$arrElem->ID_Restaurant = $tableResult['ID_Restaurant'];
		$arrElem->Numero = $tableResult['Numero'];
		return $arrElem;
	}	







	//Entidad Categorias:
	public function Categorias_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$categorias = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		$categorias->ExecSproc('Categorias_View', $args, true);
		if ($categorias->results)
		{
			foreach($categorias->results as $categoriasResult)
			{
				$arrElem = $this->Categorias_Map($categoriasResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Categorias.';
		return $retObj;
	}


	public function Categorias_Map($categoriasResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $categoriasResult['ID'];
		$arrElem->ID_Restaurant = $categoriasResult['ID_Restaurant'];
		$arrElem->Nombre = $categoriasResult['Nombre'];
		$arrElem->NombreEN = $categoriasResult['NombreEN'];
		return $arrElem;
	}	










	//Entidad Items:
	public function Items_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$items = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		if (isset($params['ID_Categorias'])) $args->ID_Categorias = $params['ID_Categorias'];
		$items->ExecSproc('Items_View', $args, true);
		if ($items->results)
		{
			foreach($items->results as $itemsResult)
			{
				$arrElem = $this->Items_Map($itemsResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Items.';
		return $retObj;
	}


	public function Items_Map($itemsResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $itemsResult['ID'];
		$arrElem->ID_Restaurant = $itemsResult['ID_Restaurant'];
		$arrElem->ID_Categorias = $itemsResult['ID_Categorias'];		
		$arrElem->Nombre = $itemsResult['Nombre'];
		$arrElem->NombreEN = $itemsResult['NombreEN'];
		$arrElem->Precio = floor($itemsResult['Precio']);
		$arrElem->Descripcion = $itemsResult['Descripcion'];
		$arrElem->DescripcionEN = $itemsResult['DescripcionEN'];
		$arrElem->Img1 = $itemsResult['Img1'];
		$arrElem->Img2 = $itemsResult['Img2'];
		$arrElem->Img3 = $itemsResult['Img3'];
		$arrElem->Img4 = $itemsResult['Img4'];
		$arrElem->Vid1 = $itemsResult['Vid1'];
		$arrElem->Vid2 = $itemsResult['Vid2'];
		return $arrElem;
	}
	











	public function ItemOptions_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$items = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		if (isset($params['ID_Item'])) $args->ID_Item = $params['ID_Item'];
		$items->ExecSproc('ItemOptions_View', $args, true);
		if ($items->results)
		{
			foreach($items->results as $itemsResult)
			{
				$arrElem = $this->ItemOptions_Map($itemsResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing ItemOptions.';
		return $retObj;
	}


	public function ItemOptions_Map($itemsResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $itemsResult['ID'];
		$arrElem->ID_Item = $itemsResult['ID_Item'];
		$arrElem->ID_Restaurant = $itemsResult['ID_Restaurant'];
		$arrElem->Nombre = $itemsResult['Nombre'];
		$arrElem->PrecioExtra = $itemsResult['PrecioExtra'];
		return $arrElem;
	}



	




















	public function Client_Login($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		
		//Verify required parameters:
		$requiredParameters = Array("Email", "Hashpass");
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
		
		$results = new StdClass();
		
		$client = new DB();
		$args = new StdClass();
		if (isset($params['Email'])) $args->Email = $params['Email'];
		if (isset($params['Hashpass'])) $args->Hashpass = $params['Hashpass'];		
		$client->ExecSproc('Client_Login', $args, true);
		if ($client->results)
		{
			foreach ($client->results as $clientResult)
			{
				if ($clientResult['ErrorCode'])
				{
					$retObj = new StdClass();
					$retObj->retCode = 200;
					$retObj->result = "Error.";
					$retObj->message = 'Error.';
					return $retObj;
				}
				else
				{
					//TODO: poner en la Session
					$_SESSION['me'] = $clientResult;
					$results = $clientResult;
				}
			}
		}

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->result = "OK";
		$retObj->results = $results;
		$retObj->message = 'OK. Login OK.';
		return $retObj;
	}
	
	
	public function Client_Register($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		
		$results = new StdClass();
		
		//Verify required parameters:
		$requiredParameters = Array("Email", "Hashpass");
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
		
		$client = new DB();
		$args = new StdClass();
		if (isset($params['Email'])) $args->Email = $params['Email'];
		if (isset($params['Hashpass'])) $args->Hashpass = $params['Hashpass'];		
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];		
		$client->ExecSproc('Client_Register', $args, true);
		if ($client->results)
		{
			foreach ($client->results as $clientResult)
			{
				if ($clientResult['ErrorCode'])
				{
					$retObj = new StdClass();
					$retObj->retCode = 200;
					$retObj->result = "Error.";
					$retObj->message = 'Error.';
					return $retObj;
				}
				else
				{
					//TODO: poner en la Session
					$_SESSION['me'] = $clientResult;
					$results = $clientResult;
				}
			}
		}

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->result = "OK";
		$retObj->results = $results;
		$retObj->message = 'OK. Register OK.';
		return $retObj;
	}


	public function Client_LoginWithFacebook($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		
		$results = new StdClass();
		
		//Verify required parameters:
		$requiredParameters = Array("Email", "Hashpass");
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
		
		$client = new DB();
		$args = new StdClass();
		if (isset($params['FBID'])) $args->FBID = $params['FBID'];
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];		
		if (isset($params['FirstName'])) $args->FirstName = $params['FirstName'];		
		if (isset($params['LastName'])) $args->LastName = $params['LastName'];		
		$client->ExecSproc('Client_LoginWithFacebook', $args, true);
		if ($client->results)
		{
			foreach ($client->results as $clientResult)
			{
				if ($clientResult['ErrorCode'])
				{
					$retObj = new StdClass();
					$retObj->retCode = 200;
					$retObj->result = "Error.";
					$retObj->message = 'Error.';
					return $retObj;
				}
				else
				{
					//TODO: poner en la Session
					$_SESSION['me'] = $clientResult;
					$results = $clientResult;
				}
			}
		}

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->result = "OK";
		$retObj->results = $results;
		$retObj->message = 'OK. Facebook Login OK.';
		return $retObj;
	}








	public function Client_GetFromSession($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		
		//var_dump($_SESSION['me']);
		if (!$_SESSION['me'])
		{
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->result = "Error.";
			$retObj->message = 'Error. Not logged in.';
			return $retObj;
		}
		else
		{
			$sess = $_SESSION['me'];
			$sess['Hashpass'] = '';
			$_SESSION['me'] = $sess;
			
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->result = $_SESSION['me'];
			$retObj->message = 'OK. Returning user object.';
			return $retObj;
			
		}
	}
	
	public function Session_Vardump($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();

		var_dump($_SESSION);
	}


	public function Session_Nullify($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		
		$_SESSION['me'] = null;
		var_dump($_SESSION);
	}
	





	//Entidad Pedido:
	public function Pedido_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$pedido = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		if (isset($params['ID_Client'])) $args->ID_Client = $params['ID_Client'];
		$pedido->ExecSproc('Pedido_View', $args, true);
		if ($pedido->results)
		{
			foreach($pedido->results as $pedidoResult)
			{
				$arrElem = $this->Pedido_Map($pedidoResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Pedidos.';
		return $retObj;
	}


	public function Pedido_Add($params)
	{
		//var_dump($_REQUEST);
		//return;
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		
		//var_dump($_SESSION);
		
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}


		if ($params['ID_PedidoAccion'])
		{
			$retArr = Array();
			$pedido = new DB();
			$args = new StdClass();
			if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
			if (isset($params['ID_Client'])) $args->ID_Client = $params["ID_Client"];
			if (isset($params['ID_Table'])) $args->ID_Table = $params['ID_Table'];
			if (isset($params['ID_PedidoAccion'])) $args->ID_PedidoAccion = $params['ID_PedidoAccion'];
			$pedido->ExecSproc('Pedido_Add', $args, true);
			
			return;
		}






		//agregamos un Nuevo Pedido:
		$retArr = Array();
		$pedido = new DB();
		$args = new StdClass();
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		if (isset($params['ID_Client'])) $args->ID_Client = $params["ID_Client"];
		if (isset($params['ID_Table'])) $args->ID_Table = $params['ID_Table'];
		$args->ID_PedidoAccion = '1';
		$pedido->ExecSproc('Pedido_Add', $args, true);
		if ($pedido->results)
		{
			foreach($pedido->results as $pedidoResult)
			{
				$arrElem = $this->Pedido_Map($pedidoResult);
				$ID_Pedido = $pedidoResult["ID"];
				//var_dump($pedidoResult);
				
				foreach ($_REQUEST['items'] as $item)
				{
					//var_dump($item);
					$itemxPedido = new DB();
					$args2 = new StdClass();
					$args2->ID_Pedido = $ID_Pedido;
					$args2->ID_Item = $item['ID'];
					$args2->ID_Restaurant = $params["ID_Restaurant"];
					$args2->ID_Client = $params["ID_Client"];
					$args2->Comments = $item['aclaraciones'];
					$args2->Compartir = $item['compartir'];
					if ($args2->Compartir=='false' || !$args2->Compartir)
					{
						$args2->Compartir=0;
					}
					else
					{
						$args2->Compartir=1;
					}
					$args2->Cantidad = $item['cantidad'];
					$itemxPedido->ExecSproc('ItemxPedido_Add', $args2, true);
					
				}
				
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Adding Pedido.';
		return $retObj;
	}

	public function Pedido_Map($pedidoResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $pedidoResult['ID'];
		$arrElem->ID_Restaurant = $pedidoResult['ID_Restaurant'];
		$arrElem->ID_Client = $pedidoResult['ID_Client'];
		$arrElem->ID_Status = $pedidoResult['ID_Status'];
		$arrElem->ID_Table = $pedidoResult['ID_Table'];
		$arrElem->DateCreation = $pedidoResult['DateCreation'];
		return $arrElem;
	}




	public function ItemxPedido_Add($params)
	{
		//Verify required parameters:
		$requiredParameters = Array();
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$itemxPedido = new DB();
		$args = new StdClass();
		if (isset($params['ID_Restaurant'])) $args->ID_Restaurant = $params['ID_Restaurant'];
		if (isset($params['ID_Client'])) $args->ID_Client = $params['ID_Client'];
		if (isset($params['ID_Pedido'])) $args->ID_Pedido = $params['ID_Pedido'];
		$itemxPedido->ExecSproc('ItemxPedido_Add', $args, true);
		if ($itemxPedido->results)
		{
			foreach($itemxPedido->results as $itemxPedidoResult)
			{
				$arrElem = $this->ItemxPedido_Map($itemxPedidoResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Adding ItemxPedido.';
		return $retObj;
	}

	public function ItemxPedido_Map($itemxPedidoResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $itemxPedidoResult['ID'];
		$arrElem->ID_Pedido = $itemxPedidoResult['ID_Pedido'];
		$arrElem->ID_Restaurant = $itemxPedidoResult['ID_Restaurant'];
		$arrElem->ID_Client = $itemxPedidoResult['ID_Client'];
		$arrElem->Comments = $itemxPedidoResult['Comments'];
		$arrElem->DateCreation = $itemxPedidoResult['DateCreation'];
		return $arrElem;
	}














	//Entidad App:


	public function App_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('ID');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		$retArr = Array();
		$app = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$app->ExecSproc('App_View', $args, true);
		if ($app->results)
		{
			foreach($app->results as $appResult)
			{
				$arrElem = $this->App_Map($appResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Apps.';
		return $retObj;
	}

	public function App_Map($appResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $appResult['App_ID'];
		$arrElem->Name = $appResult['App_Name'];
		$arrElem->Address = $appResult['App_Address'];
		$arrElem->Lat = $appResult['App_Lat'];
		$arrElem->Lon = $appResult['App_Lon'];
		$arrElem->AppFullName = $appResult['App_AppFullName'];
		$arrElem->AppFullNameOwner = $appResult['App_AppFullNameOwner'];
		$arrElem->AppIconURI = $appResult['App_AppIconURI'];
		$arrElem->AppCSSURI = $appResult['App_AppCSSURI'];
		$arrElem->AppHTMLURI = $appResult['App_AppHTMLURI'];
		$arrElem->AppJSURI = $appResult['App_AppJSURI'];
		return $arrElem;
	}


	//Entidad Categories:
	public function Categories_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
		if (!$me)
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: invalid AUToken.';
			return $retObj;
		}

		$retArr = Array();
		$category = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$args->ID_App = $me->ID_App;
		$category->ExecSproc('Categories_View', $args, true);
		if ($category->results)
		{
			foreach($category->results as $categoryResult)
			{
				$arrElem = $this->Categories_Map($categoryResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Categories.';
		return $retObj;
	}

	public function Categories_Map($categoriesResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $categoriesResult['Categories_ID'];
		$arrElem->ID_App = $categoriesResult['Categories_IDApp'];
		$arrElem->ID_CategoryParent = $categoriesResult['Categories_IDCategoryParent'];
		$arrElem->Name = $categoriesResult['Categories_Name'];
		$arrElem->ImageURI = $categoriesResult['Categories_ImageURI'];
		return $arrElem;
	}

	public function Categories_Add($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AOToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AOToken']))
		{
			$me = $this->App_GetAppFromAOToken($params['AOToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AOToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$categories = new DB();
		$args = new StdClass();
		$args->ID_App = $me->ID_App;
		if (isset($params['ID_CategoryParent'])) $args->ID_CategoryParent = $params['ID_CategoryParent'];
		if (isset($params['Name'])) $args->Name = $params['Name'];
		$categories->ExecSproc('Categories_Add', $args, true);
		if ($categories->results)
		{
			foreach($categories->results as $categoriesResult)
			{
				$arrElem = $this->Categories_Map($categoriesResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Adding Category.';
		return $retObj;		
	}


	//Entidad Products:
	public function Products_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AUToken']))
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$products = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$args->ID_App = $me->ID_App;
		if (isset($params['IsOffer'])) $args->IsOffer = $params['IsOffer'];
		if (isset($params['ID_Category'])) $args->ID_Category = $params['ID_Category'];
		$products->ExecSproc('Products_View', $args, true);
		if ($products->results)
		{
			foreach($products->results as $productResult)
			{
				$arrElem = $this->Products_Map($productResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Products.';
		return $retObj;
	}

	public function Products_Map($productsResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $productsResult['Products_ID'];
		$arrElem->ID_Category1 = $productsResult['Products_IDCategory1'];
		$arrElem->ID_Category2 = $productsResult['Products_IDCategory2'];
		$arrElem->ID_Category3 = $productsResult['Products_IDCategory3'];
		$arrElem->ID_App = $productsResult['Products_IDApp'];
		$arrElem->Name = $productsResult['Products_Name'];
		$arrElem->Image1URI = $productsResult['Products_Image1URI'];
		$arrElem->Image2URI = $productsResult['Products_Image2URI'];
		$arrElem->Image3URI = $productsResult['Products_Image3URI'];
		$arrElem->Image4URI = $productsResult['Products_Image4URI'];
		$arrElem->Description = $productsResult['Products_Description'];
		$arrElem->FinalPrice = floor( $productsResult['Products_FinalPrice']);
		$arrElem->IsOffer = $productsResult['Products_IsOffer'];
		return $arrElem;
	}

	public function Products_Add($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AOToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AOToken']))
		{
			$me = $this->App_GetAppFromAOToken($params['AOToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AOToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$products = new DB();
		$args = new StdClass();
		$args->ID_App = $me->ID_App;
		if (isset($params['ID_Category1'])) $args->ID_Category1 = $params['ID_Category1'];
		if (isset($params['ID_Category2'])) $args->ID_Category2 = $params['ID_Category2'];
		if (isset($params['ID_Category3'])) $args->ID_Category3 = $params['ID_Category3'];
		if (isset($params['Name'])) $args->Name = $params['Name'];
		if (isset($params['Image1URI'])) $args->Image1URI = $params['Image1URI'];
		if (isset($params['Image2URI'])) $args->Image2URI = $params['Image2URI'];
		if (isset($params['Image3URI'])) $args->Image3URI = $params['Image3URI'];
		if (isset($params['Image4URI'])) $args->Image4URI = $params['Image4URI'];
		if (isset($params['Description'])) $args->Description = $params['Description'];
		if (isset($params['Cost'])) $args->Cost = $params['Cost'];
		if (isset($params['Price'])) $args->Price = $params['Price'];
		if (isset($params['Multiplier1'])) $args->Multiplier1 = $params['Multiplier1'];
		if (isset($params['Multiplier2'])) $args->Multiplier2 = $params['Multiplier2'];
		if (isset($params['Multiplier3'])) $args->Multiplier3 = $params['Multiplier3'];
		$products->ExecSproc('Products_Add', $args, true);
		if ($products->results)
		{
			foreach($products->results as $productResult)
			{
				$arrElem = $this->Products_Map($productResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Products.';
		return $retObj;
	}

	public function Products_Edit($params)
	{
		//Verify required parameters:
			$requiredParameters = Array('AOToken', 'ID');
			$r = $this->VerifyRequiredParameters($requiredParameters, $params);
			if ($r->result=='Error')
			{
				return $r;
			}
		
			if (isset($params['AOToken']))
			{
				$me = $this->App_GetAppFromAOToken($params['AOToken']);
				if (!$me)
				{
					$retObj = new stdClass();
					$retObj->response = 'Error';
					$retObj->retCode = 400;
					$retObj->message = 'Error: invalid AOToken.';
					return $retObj;
				}
			}
	
			$retArr = Array();
			$products = new DB();
			$args = new StdClass();
			$args->ID_App = $me->ID_App;
			$args->ID = $params['ID'];
			if (isset($params['ID_Category1'])) $args->ID_Category1 = $params['ID_Category1'];
			if (isset($params['ID_Category2'])) $args->ID_Category2 = $params['ID_Category2'];
			if (isset($params['ID_Category3'])) $args->ID_Category3 = $params['ID_Category3'];
			if (isset($params['Name'])) $args->Name = $params['Name'];
			if (isset($params['Image1URI'])) $args->Image1URI = $params['Image1URI'];
			if (isset($params['Image2URI'])) $args->Image2URI = $params['Image2URI'];
			if (isset($params['Image3URI'])) $args->Image3URI = $params['Image3URI'];
			if (isset($params['Image4URI'])) $args->Image4URI = $params['Image4URI'];
			if (isset($params['Description'])) $args->Description = $params['Description'];
			if (isset($params['Cost'])) $args->Cost = $params['Cost'];
			if (isset($params['Price'])) $args->Price = $params['Price'];
			if (isset($params['Multiplier1'])) $args->Multiplier1 = $params['Multiplier1'];
			if (isset($params['Multiplier2'])) $args->Multiplier2 = $params['Multiplier2'];
			if (isset($params['Multiplier3'])) $args->Multiplier3 = $params['Multiplier3'];
			$products->ExecSproc('Products_Add', $args, true);
			if ($products->results)
			{
				foreach($products->results as $productResult)
				{
					$arrElem = $this->Products_Map($productResult);
					array_push($retArr, $arrElem);
				}
			}
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->results = $retArr;
			$retObj->message = 'OK. Adding Products.';
			return $retObj;
	}

	public function Products_Del($params)
	{
		//Verify required parameters:
			$requiredParameters = Array('AOToken', 'ID');
			$r = $this->VerifyRequiredParameters($requiredParameters, $params);
			if ($r->result=='Error')
			{
				return $r;
			}
		
			if (isset($params['AOToken']))
			{
				$me = $this->App_GetAppFromAOToken($params['AOToken']);
				if (!$me)
				{
					$retObj = new stdClass();
					$retObj->response = 'Error';
					$retObj->retCode = 400;
					$retObj->message = 'Error: invalid AOToken.';
					return $retObj;
				}
			}
	
			$retArr = Array();
			$products = new DB();
			$args = new StdClass();
			$args->ID_App = $me->ID_App;
			$args->ID = $params['ID'];
			$products->ExecSproc('Products_Del', $args, true);
			if ($products->results)
			{
				foreach($products->results as $productResult)
				{
					$arrElem = $this->Products_Map($productResult);
					array_push($retArr, $arrElem);
				}
			}
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->results = $retArr;
			$retObj->message = 'OK. Product Deleted.';
			return $retObj;
	}

	public function Products_Mark($params)
	{
		//Verify required parameters:
			$requiredParameters = Array('AOToken', 'ID');
			$r = $this->VerifyRequiredParameters($requiredParameters, $params);
			if ($r->result=='Error')
			{
				return $r;
			}
		
			if (isset($params['AOToken']))
			{
				$me = $this->App_GetAppFromAOToken($params['AOToken']);
				if (!$me)
				{
					$retObj = new stdClass();
					$retObj->response = 'Error';
					$retObj->retCode = 400;
					$retObj->message = 'Error: invalid AOToken.';
					return $retObj;
				}
			}
	
			$retArr = Array();
			$products = new DB();
			$args = new StdClass();
			$args->ID_App = $me->ID_App;
			$args->ID = $params['Col'];
			$args->ID = $params['Val'];
			$args->ID = $params['ID'];
			$products->ExecSproc('Products_Mark', $args, true);
			if ($products->results)
			{
				foreach($products->results as $productResult)
				{
					$arrElem = $this->Products_Map($productResult);
					array_push($retArr, $arrElem);
				}
			}
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->results = $retArr;
			$retObj->message = 'OK. Product Deleted.';
			return $retObj;
	}	









	//Entidad AppUser:		////////////////////////////////////////////////////////////
	public function AppUser_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AOToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AOToken']))		//AppOwnerToken
		{
			$me = $this->App_GetAppFromAOToken($params['AOToken']);		//AppOwnerToken
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AOToken.';
				return $retObj;
			}
		}
		$retArr = Array();
		$appUser = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$args->ID_App = $me->ID;
		$appUser->ExecSproc('AppUser_View', $args, true);
		if ($appUser->results)
		{
			foreach($appUser->results as $appUserResult)
			{
				$arrElem = $this->AppUser_Map($appUserResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing AppUsers.';
		return $retObj;
	}

	public function AppUser_Map($appUserResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $appUserResult['AppUser_ID'];
		$arrElem->ID_App = $appUserResult['AppUser_IDApp'];
		$arrElem->FirstName = $appUserResult['AppUser_FirstName'];
		$arrElem->LastName = $appUserResult['AppUser_LastName'];
		$arrElem->Email = $appUserResult['AppUser_Email'];
		$arrElem->Username = $appUserResult['AppUser_Username'];
		$arrElem->DateCreation = $appUserResult['AppUser_DateCreation'];
		$arrElem->Address = $appUserResult['AppUser_Address'];
		$arrElem->Lat = $appUserResult['AppUser_Lat'];
		$arrElem->Lon = $appUserResult['AppUser_Lon'];
		$arrElem->PhotoURI = $appUserResult['AppUser_PhotoURI'];
		$arrElem->AppUserToken = $appUserResult['AppUser_AppUserToken'];

		$arrElem->App = new StdClass();
		$arrElem->App->ID = $appUserResult['App_ID'];
		$arrElem->App->Name = $appUserResult['App_Name'];
		return $arrElem;
	}

	public function AppUser_Login($params)
	{

	}

	public function AppUser_Register($params)
	{

	}

	public function AppUser_Mark($params)
	{

	}




	//Entidad Address:
	public function Address_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AUToken']))
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$address = new DB();
		$args = new StdClass();
		if (isset($params['ID'])) $args->ID = $params['ID'];
		$args->ID_AppUser = $me->ID_AppUser;
		$args->ID_App = $me->ID_App;
		$address->ExecSproc('Address_View', $args, true);
		if ($address->results)
		{
			foreach($address->results as $addressResult)
			{
				$arrElem = $this->Address_Map($addressResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Addresses.';
		return $retObj;
	}

	public function Address_Map($addressResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $addressResult['Address_ID'];
		$arrElem->ID_App = $addressResult['Address_IDApp'];
		$arrElem->ID_AppUser = $addressResult['Address_IDAppUser'];
		$arrElem->DatetimeCreation = $addressResult['Address_DatetimeCreation'];
		$arrElem->Address = $addressResult['Address_Address'];
		$arrElem->Lat = $addressResult['Address_Lat'];
		$arrElem->Lon = $addressResult['Address_Lon'];
		$arrElem->Floor = $addressResult['Address_Floor'];
		$arrElem->Apt = $addressResult['Address_Apt'];
		$arrElem->UF = $addressResult['Address_UF'];
		$arrElem->FormattedAddress = $addressResult['Address_FormattedAddress'];
		return $arrElem;
	}

	public function Address_Add($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken', 'Address', 'FormattedAddress', 'Lat', 'Lon');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AUToken']))
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}
	
		$retArr = Array();
		$products = new DB();
		$args = new StdClass();
		$args->ID_App = $me->ID_App;
		$args->ID_AppUser = $me->ID_AppUser;
		if (isset($params['Address'])) $args->Address = $params['Address'];
		if (isset($params['Lat'])) $args->Lat = $params['Lat'];
		if (isset($params['Lon'])) $args->Lon = $params['Lon'];

		$products->ExecSproc('Products_Add', $args, true);
		if ($products->results)
		{
			foreach($products->results as $productResult)
			{
				$arrElem = $this->Products_Map($productResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Products.';
		return $retObj;
	}

	public function Address_Del($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken', 'Address', 'FormattedAddress', 'Lat', 'Lon');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}
	
		if (isset($params['AUToken']))
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}
	
		$retArr = Array();
		$products = new DB();
		$args = new StdClass();
		$args->ID_App = $me->ID_App;
		$args->ID = $params['ID'];
		$products->ExecSproc('Products_Del', $args, true);
		if ($products->results)
		{
			foreach($products->results as $productResult)
			{
				$arrElem = $this->Products_Map($productResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Product Deleted.';
		return $retObj;
	}







	//Entidad ChatRoom:
	public function ChatRoom_View($params)
	{
		//esta funcion la llaman tanto el AppUser como la App:
		if (!isset($params['AOToken']) && !isset($params['AUToken']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: AOToken is required or AUToken is required.';
			return $retObj;
		}

		if (isset($params['AOToken']) && isset($params['AUToken']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: Only one of this is required: AOToken, AUToken.';
			return $retObj;
		}

		if (isset($params['AOToken']))		//AppOwnerToken
		{
			$me = $this->App_GetAppFromAOToken($params['AOToken']);		//AppOwnerToken
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AOToken.';
				return $retObj;
			}
		}

		if (isset($params['AUToken']))		//AppOwnerToken
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);		//AppUser Token
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$chatRoom = new DB();
		$args = new StdClass();
		if (isset($params['AOToken'])) $args->ID_App = $me->ID_App;
		if (isset($params['ID_AppUser'])) $args->ID_AppUser = $params['ID_AppUser'];
		if (isset($params['AUToken'])) $args->ID_App = $me->ID_App;
		if (isset($params['AUToken'])) $args->ID_AppUser = $me->ID;
		$chatRoom->ExecSproc('ChatRoom_View', $args, true);
		if ($chatRoom->results)
		{
			foreach($chatRoom->results as $chatRoomResult)
			{
				$arrElem = $this->ChatRoom_Map($chatRoomResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing ChatRooms.';
		return $retObj;
	}

	public function ChatRoom_Map($chatRoomResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $chatRoomResult['ChatRoom_ID'];
		$arrElem->ID_AppUser = $chatRoomResult['ChatRoom_IDAppUser'];
		$arrElem->ID_App = $chatRoomResult['ChatRoom_IDApp'];
		$arrElem->ColorTags = $chatRoomResult['ChatRoom_ColorTags'];
		$arrElem->UnreadMessagesByClient = $chatRoomResult['ChatRoom_UnreadMessagesByClient'];
		$arrElem->UnreadMessagesByApp = $chatRoomResult['ChatRoom_UnreadMessagesByApp'];
		$arrElem->DatetimeLastEnteredByShop = $chatRoomResult['ChatRoom_DatetimeLastEnteredByShop'];
		$arrElem->DatetimeLastEnteredByAppUser = $chatRoomResult['AppUser_DatetimeLastEnteredByUser'];
		$arrElem->AppUser = new StdClass();
		$arrElem->AppUser->ID = $chatRoomResult['AppUser_ID'];
		$arrElem->AppUser->FirstName = $chatRoomResult['AppUser_FirstName'];
		$arrElem->AppUser->LastName = $chatRoomResult['AppUser_LastName'];
		$arrElem->AppUser->Username = $chatRoomResult['AppUser_Username'];
		$arrElem->AppUser->Phone = $chatRoomResult['AppUser_Phone'];
		$arrElem->App = new StdClass();
		$arrElem->App->ID = $appUserResult['App_ID'];
		$arrElem->App->Name = $appUserResult['App_Name'];
		return $arrElem;
	}



	//Entidad Chat:
	public function Chat_View($params)
	{
		//esta funcion la llaman tanto el AppUser como la App:
		if (!isset($params['AOToken']) && !isset($params['AUToken']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: AOToken is required or AUToken is required.';
			return $retObj;
		}

		if (isset($params['AOToken']) && isset($params['AUToken']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: Only one of this is required: AOToken, AUToken.';
			return $retObj;
		}

		if (isset($params['AOToken']))		//AppOwnerToken
		{
			$me = $this->App_GetAppFromAOToken($params['AOToken']);		//AppOwnerToken
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AOToken.';
				return $retObj;
			}
		}

		if (isset($params['AUToken']))		//AppOwnerToken
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);		//AppUser Token
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$chat = new DB();
		$args = new StdClass();
		if (isset($params['AOToken'])) $args->ID_App = $me->ID_App;
		if (isset($params['ID_ChatRoom'])) $args->ID_ChatRoom = $params['ID_ChatRoom'];
		if (isset($params['AUToken'])) $args->ID_App = $me->ID_App;
		if (isset($params['AUToken'])) $args->ID_AppUser = $me->ID;
		$chat->ExecSproc('Chat_View', $args, true);
		if ($chat->results)
		{
			foreach($chat->results as $chatResult)
			{
				$arrElem = $this->Chat_Map($chatResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Chats.';
		return $retObj;
	}

	public function Chat_Map($chatRoomResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $chat['Chat_ID'];
		$arrElem->ID_ChatRoom = $chatRoomResult['Chat_IDChatRoom'];
		$arrElem->DateCreation = $chatRoomResult['Chat_DateCreation'];
		$arrElem->Chat = $chatRoomResult['Chat_Chat'];
		$arrElem->AssetURI = $chatRoomResult['Chat_AssetURI'];
		$arrElem->FromUsername = $chatRoomResult['Chat_FromUsername'];
		$arrElem->ChatRoom = $chatRoomResult['ChatRoom_DatetimeLastEnteredByShop'];
		$arrElem->DatetimeLastEnteredByAppUser = $chatRoomResult['AppUser_DatetimeLastEnteredByUser'];
		return $arrElem;
	}

	public function Chat_Add($params)
	{
		//esta funcion la llaman tanto el AppUser como la App:
		if (!isset($params['AOToken']) && !isset($params['AUToken']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: AOToken is required or AUToken is required.';
			return $retObj;
		}

		if (isset($params['AOToken']) && isset($params['AUToken']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: Only one of this is required: AOToken, AUToken.';
			return $retObj;
		}

		if (isset($params['AOToken']))		//AppOwnerToken
		{
			$me = $this->App_GetAppFromAOToken($params['AOToken']);		//AppOwnerToken
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AOToken.';
				return $retObj;
			}
		}

		if (isset($params['AUToken']))		//AppOwnerToken
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);		//AppUser Token
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$chat = new DB();
		$args = new StdClass();
		if (isset($params['AOToken'])) $args->ID_App = $me->ID_App;
		if (isset($params['ID_ChatRoom'])) $args->ID_ChatRoom = $params['ID_ChatRoom'];
		if (isset($params['AUToken'])) $args->ID_App = $me->ID_App;
		if (isset($params['AUToken'])) $args->ID_AppUser = $me->ID;
		$chat->ExecSproc('Chat_View', $args, true);
		if ($chat->results)
		{
			foreach($chat->results as $chatResult)
			{
				$arrElem = $this->Chat_Map($chatResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Chats.';
		return $retObj;
	}


	//Entidad RecentSearch:
	public function RecentSearch_View($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		//Verify AUToken: (from AUToken we get AppUser and App)
		if (isset($params['AUToken']))
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$recentSearch = new DB();
		$args = new StdClass();
		$args->ID_AppUser = $me->ID;
		$recentSearch->ExecSproc('RecentSearch_View', $args, true);
		if ($recentSearch->results)
		{
			foreach($recentSearch->results as $recentSearchResult)
			{
				$arrElem = $this->RecentSearch_Map($recentSearchResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing RecentSearch.';
		return $retObj;
	}

	public function RecentSearch_Add($params)
	{
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->result=='Error')
		{
			return $r;
		}

		//Verify AUToken: (from AUToken we get AppUser and App)
		if (isset($params['AUToken']))
		{
			$me = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
			if (!$me)
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: invalid AUToken.';
				return $retObj;
			}
		}

		$retArr = Array();
		$recentSearch = new DB();
		$args = new StdClass();
		$args->ID_AppUser = $me->ID;
		$args->ID_App = $me->ID_App;
		$args->Search = $params['Search'];
		$recentSearch->ExecSproc('RecentSearch_Add', $args, true);
		if ($recentSearch->results)
		{
			foreach($recentSearch->results as $recentSearchResult)
			{
				$arrElem = $this->RecentSearch_Map($recentSearchResult);
				array_push($retArr, $arrElem);
			}
		}
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing RecentSearch.';
		return $retObj;
	}

	public function RecentSearch_Map($recentSearchResult)
	{
		$arrElem = new StdClass();
		$arrElem->ID = $recentSearchResult['RecentSearch_ID'];
		$arrElem->ID_App = $recentSearchResult['RecentSearch_IDApp'];
		$arrElem->Search = $recentSearchResult['RecentSearch_Search'];
		return $arrElem;
	}




	//global functions:
	public function Svc_AppUser_GetFromAUToken($params)
	{
		//a partir del AUToken obtiene el usuario.
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->response=='Error')
		{
			return $r;
		}
	
		$retArr = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);

		if ($retArr)
		{
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->results = $retArr;
			$retObj->message = 'OK. Listing AppUsers.';
			return $retObj;
		}
		else
		{
			$retObj = new StdClass();
			$retObj->retCode = 400;
			$retObj->results = $retArr;
			$retObj->message = 'Error. No AppUser found.';
			return $retObj;
		}
		
	}

	public function AppUser_GetAppUserFromAUToken($AUToken)
	{
		$appUser = new DB();
		$args = new StdClass();
		$args->AUToken = $AUToken;
		$appUser->ExecSproc('AppUser_View', $args, true);
		if ($appUser->results)
		{
			foreach($appUser->results as $appUserResult)
			{
				$obj = new StdClass();
				$obj = $this->AppUser_Map($appUserResult, true);
				return $obj;
			}
		}
		else
		{
			return null;
		}
	}





	public function Svc_App_GetFromAOToken($params)
	{
		//a partir del AUToken obtiene el usuario.
		//Verify required parameters:
		$requiredParameters = Array('AUToken');
		$r = $this->VerifyRequiredParameters($requiredParameters, $params);
		if ($r->response=='Error')
		{
			return $r;
		}
	
		$retArr = $this->AppUser_GetAppUserFromAUToken($params['AUToken']);
		
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Listing Apps.';
		return $retObj;
	}

	public function App_GetAppFromAOToken($AOToken)
	{
		$app = new DB();
		$args = new StdClass();
		$args->AOToken = $AOToken;
		$app->ExecSproc('App_GetAppFromAOToken', $args, true);
		if ($app->results)
		{
			foreach($app->results as $appResult)
			{
				$obj = new StdClass();
				$obj = $this->App_Map($appResult, true);
				return $obj;
			}
		}
		else
		{
			return null;
		}
	}





	public function AppUser_GetAppUser($params)
	{
		
	}



	public function VerifyRequiredParameters($requiredParameters, $params)
	{
		//var_dump($requiredParameters);
		foreach($requiredParameters as $requiredParameter)
		{
			if (!isset($params[$requiredParameter]) || !$params[$requiredParameter])
			{
				$retObj = new stdClass();
				$retObj->response = 'Error';
				$retObj->retCode = 400;
				$retObj->message = 'Error: '. $requiredParameter .' is required.';
				return $retObj;
			}
		}
	}





	/* TAGGER */
	/* ******************************************************************************* */
	// https://api_shopsapps.gobozu.com/services/?service=Taggger_LoginWithML
	public function Tagger_LoginWithML($params)
	{
		$code = $params['code'];
		//var_dump($code);

		$uri = "https://api.mercadolibre.com/oauth/token?grant_type=authorization_code&client_id=" . $this->APPID . "&client_secret=". $this->CLIENT_SECRET ."&code=". $params['code'] ."&redirect_uri=" . $this->REDIRECT_URI;
		$verb = "POST";
		$args = Array();
		$headers = Array();
		$resp = CURL($uri, $verb, $args, $headers, false, false);
		$MLuser = json_decode($resp->Response);
		//var_dump($MLuser);
		/* tenemos ahora algo de la forma:

			{
				"access_token": "APP_USR-2537924627528950-051702-34a222ce85ae6f9d1d03ae95640eae5b-30341176",
				"token_type": "bearer",
				"expires_in": 21600,
				"scope": "offline_access read write",
				"user_id": 30341176,
				"refresh_token": "TG-5ec0a0215fa4380006e4e9ac-30341176"
			}
			
			https://api.mercadolibre.com/users/$USER_ID/items/search?access_token=$ACCESS_TOKEN&offset=50
			https://api.mercadolibre.com/users/30341176/items/search?access_token=APP_USR-2537924627528950-051702-34a222ce85ae6f9d1d03ae95640eae5b-30341176&offset=50

		*/

		//ejecuta MLUser_Upsert.
		$retArr = Array();
		$mluser = new DB();
		$args = new StdClass();
		$args->ID = $MLuser->user_id;
		$args->access_token = $MLUser->access_token;
		$args->refresh_access_token = $MLUser->refresh_token;
		$mluser->ExecSproc('MLUser_Upsert', $args, true);

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $mluser->results;
		$retObj->message = 'OK. Logged In Via ML.';
		return $retObj;
	}

	public function Tagger_RefreshMLToken($params)
	{
		//refresca el token del usuario $params['MLUserID']. Recordar que el token de ML expira cada 6hs aprox.
		//obtenemos de la DB el MLUser cuyo token queremos actualizar:
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $params['MLUserID'];
		$MLUser->ExecSproc('MLUser_View', $args, true);
		$MLUser = $MLUser->results[0];

		//hacemos el request a ML:
		$uri = "https://api.mercadolibre.com/oauth/token?grant_type=refresh_token&client_id=". $this->APPID ."&client_secret=". $this->CLIENTSECRET ."&refresh_token=" . $MLUser['refresh_access_token'];
		var_dump($uri);
		$verb = "POST";
		$args = Array();
		$headers = Array();
		$resp = CURL($uri, $verb, $args, $headers, false, false);
		var_dump($resp);
		$response = json_decode($resp->Response);

		//actualizamos la DB:
		$MLUser2 = new DB();
		$args = new StdClass();
		$args->ID = $response->user_id;
		$args->access_token = $response->access_token;
		$args->refresh_access_token = $response->refresh_token;
		$MLUser2->ExecSproc('MLUser_Upsert', $args, true);
	}

	public function Tagger_Items_ImportFromML($params)		//importa todos los items desde ML. Importa solo los MLIDs. Otro proceso llena los datos.
	{
		set_time_limit(10000);
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		$MLUser = $MLUser->results[0];
		//var_dump($MLUser);
		
		//obtengo los MLitems:
		$therearemore = true;
		$n=0;
		$arrItems = Array();
		while ($therearemore && $n<1000)
		{
			$uri = "https://api.mercadolibre.com/users/". $MLUser["ID"] ."/items/search?access_token=". $MLUser["access_token"] ."&offset=" . $n;
			//var_dump($uri);
			$verb = "GET";
			$args = Array();
			$headers = Array();
			$resp = CURL($uri, $verb, $args, $headers, false, false);
			$items = json_decode($resp->Response);
			//var_dump($items->results);
			$arrItems = array_merge($arrItems, $items->results);
			$n = $n + 50;
		}

		foreach ($arrItems as $item)
		{
			//var_dump($item);
			//damos el alta en la BD:
			$MLitem = new DB();
			$args = new StdClass();
			$args->ID = $item;
			$args->ID_MLUser = $MLUser["ID"];
			$MLitem->ExecSproc('MLitems_Upsert', $args, true);
		}

	}

	public function Tagger_Items_FillInFromML($params)
	{
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;

		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		$MLUser = $MLUser->results[0];
		//var_dump($MLUser);
		
		$MLitem = new DB();
		$args = new StdClass();
		$args->Dispatcher = "d1";
		$MLitem->ExecSproc('MLitems_Dispatch', $args, true);
		if ($MLitem->results)
		{
			foreach ($MLitem->results as $MLitemResult)
			{
				//var_dump($MLitemResult);
				//exit();
				//llamo a la API de ML pidiendo detalles de este MLitem.
				$uri = "https://api.mercadolibre.com/items?ids=". $MLitemResult['ID'] ."&access_token=" . $MLUser['access_token'];
				//var_dump($uri);
				$verb = "GET";
				$args = Array();
				$headers = Array();
				$resp = CURL($uri, $verb, $args, $headers, false, false);
				//var_dump($resp);
				$items = json_decode($resp->Response);
				$items = $items[0]->body;
				//var_dump($items);
				//exit();

				$sku = null;
				foreach ($items->attributes as $itemAttribute)
				{
					if ($itemAttribute->id=="SELLER_SKU")
					{
						var_dump($itemAttribute);
						//hallamos el SKU
						$sku = $itemAttribute->value_name;
						//var_dump($sku);
					}
				}


				//persisto en mi DB:
				$MLitem2 = new DB();
				$args = new StdClass();
				$args->ID = $MLitemResult['ID'];
				$args->ID_MLUser = $MLUser_ID;
				$args->Name = $items->title;
				$args->Img1 = $items->pictures[0]->url;
				$args->Img2 = $items->pictures[1]->url;
				$args->Img3 = $items->pictures[2]->url;
				if ($sku)
				{
					$args->SKU = $sku;
				}
				else
				{
					$args->SKU = $items->seller_custom_field;
				}
				$MLitem2->ExecSproc('MLitems_Upsert', $args, true);
			}
		}
	


	}


	public function Tagger_Order_ChangeStatus($params)
	{
		//cambia el estado de la orden, por ejemplo a Preparando.
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;

		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		$MLUser = $MLUser->results[0];

		//TODO.
	}

	public function Tagger_Orders_Get($params)
	{
		if (!$params['offset']) $params['offset']=0;

		//obtiene las orders de ML.
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;

		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		//var_dump($MLUser->results[0]);
		$MLUser = $MLUser->results[0];
		//var_dump($MLUser);
		
		//TODO: obtiene las ordenes de ML
		$uri = "https://api.mercadolibre.com/orders/search?access_token=". $MLUser['access_token'] ."&seller=" . $MLUser['ID'] . "&sort=date_desc&offset=" . $params['offset'];
		var_dump($uri);
		$verb = "GET";
		$args = Array();
		$headers = Array();
		$resp = CURL($uri, $verb, $args, $headers, false, false);
		//var_dump($resp);
		$orders = json_decode($resp->Response);
		if ($orders->message=="invalid_token")
		{
			//TODO: devolver codigo de error.
			return;
		}
		//var_dump($orders);

		//obtiene el array de MLIDs de cada uno de los items

		$orders = $orders->results;
		foreach($orders as $order)
		{
			foreach ($order->order_items as $k=>$order_item)
			{
				//var_dump($order_item->item);
				$sku = $order_item->item->seller_custom_field;
				if (!$sku)
				{
					$sku = $order_item->item->seller_sku;
					//var_dump("ATT!");
					//var_dump($order_item->item);
				}
				//var_dump($sku);
				//obtengo el MLItem a partir del SKU
				$MLItems = new DB();
				$args = new StdClass();
				$args->ID_MLUser = $MLUser_ID;
				$args->SKU = $sku;
				$MLItems->ExecSproc('MLitems_View', $args, true);
				$mlItems = $MLItems->results;
				$mlItems = $mlItems[0];
				$order->order_items[$k]->item->Img1 = $mlItems['Img1'];
				$order->order_items[$k]->item->Img2 = $mlItems['Img2'];
				$order->order_items[$k]->item->Img3 = $mlItems['Img3'];

				$order->order_items[$k]->item->SKU = $sku;
			}
		}
		//var_dump($orders);
		//obtiene para todos esos MLIDs las imagenes Image1 corresp.
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $orders;
		$retObj->message = 'OK. Listing Order Items.';
		return $retObj;


	}


	public function Tagger_Orders_Sync($params)
	{
		set_time_limit(1000);
		if (!$params['offset']) $params['offset']=0;

		//1. me traigo los ítems de ML
		//2. me traigo las orders de ML
		//3. persisto las orders y order_items en la DB
		//4. llamo al sproc de MLOrder_Clusterize

		//obtiene las orders de ML.
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		//var_dump($MLUser->results[0]);
		$MLUser = $MLUser->results[0];
		//var_dump($MLUser);
		
		//TODO: obtiene las ordenes de ML
		$uri = "https://api.mercadolibre.com/orders/search?access_token=". $MLUser['access_token'] ."&seller=" . $MLUser['ID'] . "&sort=date_desc&offset=" . $params['offset'] . '&tags=not_delivered,paid';
		$verb = "GET";
		$args = Array();
		$headers = Array();
		$resp = CURL($uri, $verb, $args, $headers, false, false);
		//var_dump($resp);
		$orders = json_decode($resp->Response);
		if ($orders->message=="invalid_token")
		{
			$retObj = new StdClass();
			$retObj->retCode = 400;
			$retObj->results = $orders;
			$retObj->message = 'Error. Invalid ML access token. MELI: invalid_token.';
			return $retObj;
		}
		//var_dump($orders);

		//obtiene el array de MLIDs de cada uno de los items

		$orders = $orders->results;
		foreach($orders as $order)
		{
			//persisto el MLBuyer en la DB: MLBuyer_Upsert:
			$MLBuyer = new DB();
			$args = new StdClass();
			$args->ID = $order->buyer->id;
			$args->Nickname = $order->buyer->nickname;
			$args->DocNumber = $order->buyer->billing_info->doc_number;
			$args->DocType = $order->buyer->billing_info->doc_type;
			$args->FirstName = $order->buyer->first_name;
			$args->LastName = $order->buyer->last_name;
			$args->Email = $order->buyer->email;
			$MLBuyer->ExecSproc('MLBuyer_Upsert', $args, true);



			//persisto la MLOrder en la DB:
			$MLOrder = new DB();
			$args = new StdClass();
			$args->ID = $order->id;
			$args->MLOrderID = $order->id;
			$args->ID_MLUser = $params['MLUserID'];
			$args->ID_MLBuyer = $order->buyer->id;
			$args->MLStatus = $order->status;
			if (isset($order->shipping) && isset($order->shipping->status)) $args->ML_SHIP_Status = $order->shipping->status;
			if (isset($order->payments) && isset($order->payments[0]))
			{
				$date = $order->payments[0]->date_approved;
				$date = str_replace("T", " ", $date);
				$date = str_replace("-04:00", "", $date);
				$date = str_replace("-03:00", "", $date);
				$date = str_replace("-05:00", "", $date);
				$date = str_replace("-02:00", "", $date);
				$args->ML_PMTS_DateCreated = $date;
			}
			if (isset($order->shipping)) $args->ML_SHIP_ID = $order->shipping->id;
			$MLOrder->ExecSproc('MLOrder_Upsert', $args, true);



			foreach ($order->order_items as $k=>$order_item)
			{
				//var_dump($order_item->item);
				$sku = $order_item->item->seller_custom_field;
				if (!$sku)
				{
					$sku = $order_item->item->seller_sku;
					//var_dump("ATT!");
					//var_dump($order_item->item);
				}


				//TODO: persisto el OrderItem en la DB.
				$OrderItem = new DB();
				$args = new StdClass();
				$args->ID_MLUser = $params['MLUserID'];
				$args->ID_Order = $order->id;
				$args->SKU = $sku;
				$args->Qty = $order_item->quantity;
				$OrderItem->ExecSproc('OrderItem_Upsert', $args, true);
				


				//var_dump($sku);
				//obtengo el MLItem a partir del SKU
				$MLItems = new DB();
				$args = new StdClass();
				$args->ID_MLUser = $MLUser_ID;
				$args->SKU = $sku;
				$MLItems->ExecSproc('MLitems_View', $args, true);
				$mlItems = $MLItems->results;
				$mlItems = $mlItems[0];
				$order->order_items[$k]->item->Img1 = $mlItems['Img1'];
				$order->order_items[$k]->item->Img2 = $mlItems['Img2'];
				$order->order_items[$k]->item->Img3 = $mlItems['Img3'];

				$order->order_items[$k]->item->SKU = $sku;
			}
		}
		//var_dump($orders);
		//obtiene para todos esos MLIDs las imagenes Image1 corresp.
		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $orders;
		$retObj->message = 'OK. Syncing Order Items.';
		return $retObj;


	}


	public function Tagger_Items_View($params)
	{
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		//var_dump($MLUser->results[0]);
		$MLUser = $MLUser->results[0];

		//var_dump($MLUser);

		$MLitems = new DB();
		$args = new StdClass();
		$args->ID_MLUser = $params['MLUserID'];
		$MLitems->ExecSproc('MLitems_View', $args, true);
		$retArr = Array();
		foreach($MLitems->results as $MLitemResult)
		{
			//var_dump($MLitemResult);
			$arrElem = new StdClass();
			$arrElem->SKU = $MLitemResult['SKU'];
			$arrElem->ImgSKU = $MLitemResult['ImgSKU'];
			//var_dump($arrElem);
			array_push($retArr, $arrElem);
		}

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Sending Array Items.';
		return $retObj;
	}

	public function Tagger_MLOrder_View($params)
	{
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		//var_dump($MLUser->results[0]);
		$MLUser = $MLUser->results[0];

		$MLOrder = new DB();
		$args = new StdClass();
		$args->ID_MLUser = $params['ID_MLUser'];
		$args->ID_SuperOrder = $params['ID_SuperOrder'];
		$MLOrder->ExecSproc('MLOrder_View', $args, true);
		$retArr = Array();
		foreach($MLOrder->results as $MLOrderResult)
		{
			//var_dump($MLitemResult);
			$arrElem = new StdClass();
			$arrElem->ID = $MLOrderResult['MLOrder_ID'];
			//var_dump($arrElem);
			array_push($retArr, $arrElem);
		}

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Sending MLOrder Items.';
		return $retObj;
	}


	public static function Tagger_uOrderCmp($a, $b)
	{
		if ( ((int) $a->Order->order_items[0]->item->SKU) == ((int) $b->Order->order_items[0]->item->SKU) ) return 0;
		return ( ((int) $a->Order->order_items[0]->item->SKU) < ((int) $b->Order->order_items[0]->item->SKU) ) ? -1 : 1;
	}

	public function Tagger_SuperOrder_Get($params)
	{
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		//var_dump($MLUser->results[0]);
		$MLUser = $MLUser->results[0];
		$ML_access_token = $MLUser->access_token;

		$MLOrder = new DB();
		$args = new StdClass();
		$args->ID_MLUser = $params['MLUserID'];
		$args->ID_SuperOrder = $params['ID_SuperOrder'];
		$MLOrder->ExecSproc('SuperOrder_Get', $args, true);
		$retArr = Array();
		foreach($MLOrder->results as $MLOrderResult)
		{
			//var_dump($MLitemResult);
			$arrElem = new StdClass();
			$arrElem->ID = $MLOrderResult['MLOrder_ID'];
			$arrElem->ML_SHIP_ID = $MLOrderResult['ML_SHIP_ID'];
			$arrElem->ID_SuperOrder = $MLOrderResult['ID_SuperOrder'];
			//var_dump($arrElem);

			//TODO: obtener Orders de ML.
			// https://api.mercadolibre.com/orders/$ORDER_ID/product?access_token=$ACCESS_TOKEN	
			$uri = "https://api.mercadolibre.com/orders/". $arrElem->ID ."/?access_token=". $MLUser['access_token'];
			//var_dump($uri);
			$verb = "GET";
			$args = Array();
			$headers = Array();
			$resp = CURL($uri, $verb, $args, $headers, false, false);
			//var_dump($resp);
			$order = json_decode($resp->Response);

			//hidratamos los $arrElem->Order->order_items con la data de cada item:
			foreach ($order->order_items as $k=>$order_item)
			{
				$sku = $order_item->item->seller_custom_field;
				if (!$sku)
				{
					$sku = $order_item->item->seller_sku;
					//var_dump("ATT!");
					//var_dump($order_item->item);
				}


				//TODO: persisto el OrderItem en la DB.
				$OrderItem = new DB();
				$args = new StdClass();
				$args->ID_MLUser = $params['MLUserID'];
				$args->ID_Order = $order->id;
				$args->SKU = $sku;
				$args->Qty = $order_item->quantity;
				$OrderItem->ExecSproc('OrderItem_Upsert', $args, true);
				


				//var_dump($sku);
				//obtengo el MLItem a partir del SKU
				$MLItems = new DB();
				$args = new StdClass();
				$args->ID_MLUser = $MLUser_ID;
				$args->SKU = $sku;
				$MLItems->ExecSproc('MLitems_View', $args, true);
				$mlItems = $MLItems->results;
				$mlItems = $mlItems[0];
				$order->order_items[$k]->item->Img1 = $mlItems['Img1'];
				$order->order_items[$k]->item->Img2 = $mlItems['Img2'];
				$order->order_items[$k]->item->Img3 = $mlItems['Img3'];

				$order->order_items[$k]->item->SKU = $sku;				
			}


			$arrElem->Order = $order;

			array_push($retArr, $arrElem);
		}

		//var_dump($retArr);
		//return;

		//var_dump((int) $retArr[0]->Order->order_items[0]->item->SKU);
		//var_dump((int) $retArr[1]->Order->order_items[0]->item->SKU);

		usort( $retArr, array("Services", "Tagger_uOrderCmp") );

		//var_dump($retArr[0]->Order->order_items[0]->item->SKU);
		//var_dump($retArr[1]->Order->order_items[0]->item->SKU);


		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Sending MLOrder Items.';
		return $retObj;
	}

	public function Tagger_SuperOrder_Take($params)
	{
		$MLUser_ID = $params['MLUserID'];		//a partir del MLUser_ID obtenemos el access_token. A partir del access_token obtenemos los MLitems.
		if (!$MLUser_ID) return;
		$retArr = Array();
		$MLUser = new DB();
		$args = new StdClass();
		$args->ID = $MLUser_ID;
		$MLUser->ExecSproc('MLUser_View', $args, true);
		//var_dump($MLUser->results[0]);
		$MLUser = $MLUser->results[0];

		$MLOrder = new DB();
		$args = new StdClass();
		$args->ID_MLUser = $params['MLUserID'];
		$args->ID_SuperOrder = $params['ID_SuperOrder'];
		$MLOrder->ExecSproc('SuperOrder_Take', $args, true);
		$retArr = Array();
		foreach($MLOrder->results as $MLOrderResult)
		{
			//var_dump($MLitemResult);
			$arrElem = new StdClass();
			$arrElem->ID = $MLOrderResult['MLOrder_ID'];
			$arrElem->ML_SHIP_ID = $MLOrderResult['ML_SHIP_ID'];
			$arrElem->ID_SuperOrder = $MLOrderResult['ID_SuperOrder'];

			//var_dump($arrElem);
			array_push($retArr, $arrElem);
		}

		//TODO: obtener Orders de ML.

		$retObj = new StdClass();
		$retObj->retCode = 200;
		$retObj->results = $retArr;
		$retObj->message = 'OK. Sending MLOrder Items.';
		return $retObj;
	}

	public function Tagger_TaggerAppUsers_GetFromSession($params)
	{
		session_set_cookie_params(0, '/', '.gobozu.com');
		session_start();
		//var_dump($_SESSION);
		if ( !isset($_SESSION['me']) )
		{
			$retObj = new stdClass();
			$retObj->response = 'Error';
			$retObj->retCode = 400;
			$retObj->message = 'Error: you are not logged in.';
			return $retObj;
		}
		else
		{
			$retArr = Array();
			
			$User_ID = $_SESSION['me']->ID;
			$user = new DB();
			$args = new StdClass();
			$args->ID = $User_ID;
			$user->ExecSproc('TaggerAppUser_View', $args, true);
			if ($user->results)
			{
				foreach($user->results as $userResult)
				{
					$arrElem = new StdClass();
					$arrElem->ID = $userResult['ID'];
					$arrElem->Username = $userResult['Username'];
					$arrElem->TAPP_Token = $userResult['TAPP_Token'];
					array_push($retArr, $arrElem);
				}
			}
			//$arrElem = $_SESSION['me'];
		
			$retObj = new StdClass();
			$retObj->retCode = 200;
			$retObj->results = $retArr;
			$retObj->message = 'OK. User logged in.';
			return $retObj;
		}

	}


	
}


