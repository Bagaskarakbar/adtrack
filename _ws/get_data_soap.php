<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$no_kunjungan = $input['no_kunjungan'];

//$db->debug=true;

$objektif = "";
$subjektif = "";
$terapi = "";
$flagKosong = 0;

$sqlVitalSign = "SELECT TOP 1
dbo.gd_th_rujuk_ri.keadaan_umum,
dbo.gd_th_rujuk_ri.tekanan_darah,
dbo.gd_th_rujuk_ri.suhu,
dbo.gd_th_rujuk_ri.tinggi_badan,
dbo.gd_th_rujuk_ri.kesadaran_pasien,
dbo.gd_th_rujuk_ri.nadi,
dbo.gd_th_rujuk_ri.pernafasan,
dbo.gd_th_rujuk_ri.berat_badan
FROM
dbo.gd_th_rujuk_ri
WHERE
dbo.gd_th_rujuk_ri.no_kunjungan = $no_kunjungan
ORDER BY tgl_input DESC";

$runGetVitalSign = $db->Execute($sqlVitalSign);
while ($tempDataVitalSign = $runGetVitalSign->fetchrow()) {
	$arr['keadaan_umum'] = $tempDataVitalSign['keadaan_umum'];
	$arr['tekanan_darah'] = $tempDataVitalSign['tekanan_darah'];
	$arr['suhu'] = $tempDataVitalSign['suhu'];
	$arr['tinggi_badan'] = $tempDataVitalSign['tinggi_badan'];
	$arr['kesadaran_pasien'] = $tempDataVitalSign['kesadaran_pasien'];
	$arr['nadi'] = $tempDataVitalSign['nadi'];
	$arr['pernafasan'] = $tempDataVitalSign['pernafasan'];
	$arr['berat_badan'] = $tempDataVitalSign['berat_badan'];
}

$sqlGetSoap = "SELECT
dbo.tc_soap.keterangan as objektif,
dbo.tc_status_pasien.status_pasien AS subjektif,
dbo.tc_status_pasien.terapi
FROM
dbo.tc_kunjungan
INNER JOIN dbo.tc_soap ON dbo.tc_soap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
INNER JOIN dbo.tc_status_pasien ON dbo.tc_status_pasien.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
WHERE dbo.tc_kunjungan.no_kunjungan = $no_kunjungan";

$runGetSoap = $db->Execute($sqlGetSoap);
while ($tempDataSoap = $runGetSoap->fetchrow()) {
	$objektif = $tempDataSoap['objektif'];
	$subjektif = $tempDataSoap['subjektif'];
	$terapi = $tempDataSoap['terapi'];
}

if ($objektif == "" && $subjektif == "" && $terapi == "") {
	$flagKosong = 1;
} else {
	$arr['objektif'] = $objektif;
	$arr['subjektif'] = $subjektif;
	$arr['terapi'] = $terapi;
	$arr['flagKosong'] = $flagKosong;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>