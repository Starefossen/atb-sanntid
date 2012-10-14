<?php
header ("Content-Type: application/json; charset=utf-8");

$date 		= date('Ymd');
$dateAlt 	= date('Y-m-d');
$time 		= date('H:i');

$url 		= "http://st.atb.no/InfoTransit/innerStTp.aspx/";

$methods 	= array(
	"companies" => array("actual" => "getAziende", "fields" => array(), 
				"find" => array('"Aziende"', '"Nome"', '"TipoPerc"'), 
				"replace" => array('"companies"', '"name"', '"icon"')
	), "lines" => array("actual" => "getLinee", 
				"fields" => array(
					"company" 		=> array("actual" => "_idAzienda", "value" => "1"),
					"date" 			=> array("actual" => "_isoDate", "value" => $date),
					"time" 			=> array("actual" => "_fascia", "value" => $time),
					"perc" 			=> array("actual" => "_tipoPerc", "value" => "1,4,5"),
					"leftLon" 		=> array("actual" => "_tLeftLon", "value" => null),
					"leftLat" 		=> array("actual" => "_tLeftLat", "value" => null),
					"rightLon" 		=> array("actual" => "_bRightLon", "value" => null),
					"rightLat" 		=> array("actual" => "_bRightLat", "value" => null)
				), 
				"find" => array('"Linee"', '"cinLinea"', '"codAzLinea"', '"descrizione"', '"nCorse"', '"tipoPercorso"'),
				"replace" => array('"lines"', '"id"', '"number"', '"desc"', '"course"', '"path_type"')
	), "paths" => array("actual" => "getPercorsi", 
				"fields" => array(
					"company" 		=> array("actual" => "_idAzienda", "value" => "1"),
					"line" 			=> array("actual" => "_idLinea", "value" => "14"),
					"date" 			=> array("actual" => "_isoDate", "value" => $date),
					"time" 			=> array("actual" => "_fascia", "value" => $time),
					"perc" 			=> array("actual" => "_tipoPerc", "value" => "1,4,5"),
					"leftLon" 		=> array("actual" => "_tLeftLon", "value" => null),
					"leftLat" 		=> array("actual" => "_tLeftLat", "value" => null),
					"rightLon" 		=> array("actual" => "_bRightLon", "value" => null),
					"rightLat" 		=> array("actual" => "_bRightLat", "value" => null)
				), 
				"find" => array('"Percorsi"', '"cinPercorso"', '"codAzPercorso"', '"descrizione"', '"capOriDest"', '"nCorse"'),
				"replace" => array('"paths"', '"id"', '"code"', '"desc"', '"origin"', '"course"')
	), "pathsAlt" => array("actual" => "getPercorsiAlternativi", 
				"fields" => array(
					"company" 		=> array("actual" => "_idAzienda", "value" => "1"),
					"path" 			=> array("actual" => "_idPercorso", "value" => "185")
				), 
				"find" => array('"Percorsi"', '"cinPercorso"', '"idAz"', '"idLinea"'),
				"replace" => array('"paths"', '"id"', '"az_id"', '"line_id"')
	), "stops" => array("actual" => "getFermate", 
				"fields" => array(
					"company" 		=> array("actual" => "_idAzienda", "value" => "1"),
					"line" 			=> array("actual" => "_idLinea", "value" => "14"),
					"path" 			=> array("actual" => "_idPercorso", "value" => "185"),
					"leftLon" 		=> array("actual" => "_tLeftLon", "value" => null),
					"leftLat" 		=> array("actual" => "_tLeftLat", "value" => null),
					"rightLon" 		=> array("actual" => "_bRightLon", "value" => null),
					"rightLat" 		=> array("actual" => "_bRightLat", "value" => null)
				), 
				"find" => array('"features"', '"Name"', '"Description"', '"Id"'),
				"replace" => array('"stops"', '"name"', '"desc"', '"id"')
	), "schedule" => array("actual" => "getOrari", 
				"fields" => array(
					"company" 		=> array("actual" => "_idAzienda", "value" => "1"),
					"line" 			=> array("actual" => "_idLinea", "value" => "14"),
					"stop" 			=> array("actual" => "_idFermata", "value" => 100509),
					"date" 			=> array("actual" => "_isoDate", "value" => $dateAlt),
					"time" 			=> array("actual" => "_fascia", "value" => $time),
				), 
				"find" => array('"InfoNodo"', '"nome_Az"', '"codAzNodo"', '"nomeNodo"', '"descrNodo"', 
									'"orarioSched"', '"orario"', '"Orari"', '"codAzLinea"', 
									'"descrizioneLinea"', '"statoPrevisione"', '"capDest"'),
				"replace" => array('"stop"', '"company"', '"code"', '"name"', '"desc"', '"arrival"', 
									'"arrival_new"', '"arrivals"', '"number"', '"desc"', '"status"', 
									'"destination"')
	)
);

if (isset($_GET['method']) && array_key_exists($_GET['method'], $methods)) {
	$payload 	 = array();
	$method 	 = $methods[$_GET['method']];
	$url 		.= $method['actual'];
	if (count($method['fields']) > 0) {
		foreach($method['fields'] as $field => $prop) {
			$payload[$prop['actual']] = (isset($_GET[$field]) ? $_GET[$field] : $prop['value']);
		}
	}
	$find = array_merge(array('"{', '}"', '\\"'), $method['find']);
	$replace = array_merge(array('{', '}', '"'), $method['replace']);
	$payload = (count($payload) > 0 ? json_encode($payload) : "");
} else {
	die("Invalid method.");
}

//die($payload);

$headers = array(             
	"Content-type: application/json; charset=utf-8", 
	"Content-length: ".strlen($payload),
	"Referer: http://st.atb.no/InfoTransit/innerStTp.aspx"
); 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 40); 
curl_setopt($ch, CURLOPT_TIMEOUT,        40); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 

echo str_replace($find, $replace, curl_exec($ch));

curl_close($ch);
?>