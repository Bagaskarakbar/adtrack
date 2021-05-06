<?php
include 'akses_jojo.php';
$curl = curl_init();

$jam_awal=strtotime('2020-07-08 15:30:00')*1000;
$jam_akhir=strtotime('2020-07-08 16:00:00')*1000;

$jsonnya=array(
		'room_name' =>'Quality Check Room',
		'room_id' =>60,
        'schedule' => array(
						array('id'=>151,
						'patient_email'=>"apey@jojonomic.com",
						'start_time'=>$jam_awal,
						'end_time'=>$jam_akhir,
						'doctor_id'=>91909,
						'is_delete'=>false)
			
		)
    );
$e_jes=json_encode($jsonnya);
print_r($e_jes);
//die;
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://apiv2.jojonomic.com/jojomeet-cloud-meeting-service/room/schedule/add-or-modify",
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