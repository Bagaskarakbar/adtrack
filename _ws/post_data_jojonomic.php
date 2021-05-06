<?php
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);

$email = $input['email'];
$name = $input['name'];
$kode_dokter = $input['kode_dokter'];

$iat = strtotime("now");
$exp = strtotime("+1 day");

$header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
$array = array('email' => $email,'name' => $name,'kode_dokter' => $kode_dokter);
$payload = json_encode(['iss' => 'averin-jwt-auth','iat' => $iat,'exp' => $exp, 'user' => $array ,'lang'=>'en_US']);

$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, '4v3r1n', true);
$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

$arr['jwt'] = $jwt;
$arr['message'] = "successfully created a token";

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}?>