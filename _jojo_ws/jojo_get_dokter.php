<?php
include 'akses_jojo.php';
$curl = curl_init();
$jsonnya=array(
        'pagination' => array(
			'limit'=>0,
			'page'=>1,
			'column'=>'',
			'ascending'=>true,
			'query'=>'Dokter'
		),
		'group_ids'=>array(),
		'employee_status'=>array(1),
		'roles'=>array(),
		'exclude_roles'=>array(
			'admin'=>'sysadmin'
		),
		'user_company_ids'=>array()
		
    );
$e_jes=json_encode($jsonnya);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://apiv2.jojonomic.com/user-service/employee/list/filter-status",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"$e_jes",
  CURLOPT_HTTPHEADER => array(
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
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>