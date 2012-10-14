<?php
header ("Content-Type: text/json; charset=utf-8");

if (isset($_GET['stop']) && is_numeric($_GET['stop'])) {
	$method = "getUserRealTimeForecastEx";
	$stop = $_GET['stop'];
	$numb = (isset($_GET['numb']) && is_numeric($_GET['numb']) ? $_GET['numb'] : 10);
	$hour = (isset($_GET['hour']) && is_numeric($_GET['hour']) ? $_GET['hour'] : 1);
} else {
	$method = "GetBusStopsList";
}

// API: http://st.atb.no/InfoTransit/userservices.asmx
// Map: http://st.atb.no/InfoTransit/innerStTp.aspx

/*

<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope 
	xmlns:soap="http://www.w3.org/2003/05/soap-envelope" 
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
	xmlns:xsd="http://www.w3.org/2001/XMLSchema">
	<soap:Body>
		<getUserRealTimeForecastExResponse xmlns="http://miz.it/infotransit">
			<getUserRealTimeForecastExResult>RESULT</getUserRealTimeForecastExResult>
		</getUserRealTimeForecastExResponse>
	</soap:Body>
</soap:Envelope>
*/

/*
<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <GetBusStopsList xmlns="http://miz.it/infotransit">
      <auth>
        <user>string</user>
        <password>string</password>
      </auth>
    </GetBusStopsList>
  </soap12:Body>
</soap12:Envelope>
*/


// $user && $pass
require_once "config.php";
$url = "http://st.atb.no/InfoTransit/userservices.asmx";

$soap = '<?xml version="1.0" encoding="utf-8"?>';
$soap .= '<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
$soap .= 'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ';
$soap .= 'xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">';
$soap .= '<soap12:Body>';
$soap .= '<'.$method.' xmlns="http://miz.it/infotransit">';
// Auth
$soap .= '<auth>';
$soap .= '<user>'.$user.'</user>';
$soap .= '<password>'.$pass.'</password>';
$soap .= '</auth>';
if ($method == "getUserRealTimeForecastEx") {
	$soap .= '<busStopId>'.$stop.'</busStopId>';
	$soap .= '<nForecast>'.$numb.'</nForecast>';
	$soap .= '<nHours>'.$hour.'</nHours>';
}
$soap .= '</'.$method.'>';
$soap .= '</soap12:Body>';
$soap .= '</soap12:Envelope>';

$headers = array(             
	"Content-type: text/xml; charset=utf-8", 
	"Content-length: ".strlen($soap),
	"SOAPAction: \"http://miz.it/infotransit/".$method."\""
); 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soap);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($ch, CURLOPT_TIMEOUT,        10); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 

preg_match("/({.+})/u", (curl_exec($ch)), $res, PREG_OFFSET_CAPTURE);
echo $res[0][0];

curl_close($ch);
?>