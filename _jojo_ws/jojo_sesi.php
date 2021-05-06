<?
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'akses_jojo.php';
 $postdata = http_build_query(
    array(
        'pagination' => array(
			'limit'=>10,
			'page'=>1,
			'column'=>'id',
			'ascending'=>'false',
			'query'=>'',
			'query_type'=>'name'
		)
    )
); 
	//echo "Authorization: Bearer ".$token."\r\n";
     //die;
        
 $opts = array('http' =>
    array(
        'method'  => 'POST',
        'header' => array(
		"Connection: keep-alive",
		"Accept: application/json, text/plain, /",
		"Authorization: Bearer $token",
		"User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36",
		"Content-Type: application/json;charset=UTF-8",
		"Origin: https://corp2.jojonomic.com",
		"Sec-Fetch-Site: same-site",
		"Sec-Fetch-Mode: cors",
		"Sec-Fetch-Dest: empty",
		"Referer: https://corp2.jojonomic.com/pro/meet",
		"Accept-Language: en-US,en;q=0.9,af;q=0.8,id;q=0.7,ms;q=0.6"
	  ),
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents('https://apiv2.jojonomic.com/jojomeet-cloud-meeting-service/room/list', false, $context);
print_r($result); 
?>