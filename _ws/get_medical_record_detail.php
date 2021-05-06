<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$no_mr = $input['no_mr'];
$sql_query = "
SELECT dbo.mt_master_pasien.no_mr,
dbo.mt_master_pasien.nama_pasien,
dbo.mt_master_pasien.alergi,
dbo.mt_master_pasien.jen_kelamin,
dbo.mt_master_pasien.gol_darah,
dbo.mt_master_pasien.almt_ttp_pasien,
dbo.mt_master_pasien.url_foto,
dbo.mt_master_pasien.tgl_lhr
FROM dbo.mt_master_pasien
WHERE dbo.mt_master_pasien.no_mr = '$no_mr'";


$date=date("Y-m-d H:i:s");
$datenow = date_create(date("Y-m-d H:i:s"));


$runGetMedicalRecord = $db->Execute($sql_query);
while($tempDataMedicalRecord = $runGetMedicalRecord->fetchrow()){
	$arr['no_mr'] = $tempDataMedicalRecord['no_mr'];
	$arr['nama_pasien'] = $tempDataMedicalRecord['nama_pasien'];
	$arr['alergi'] = $tempDataMedicalRecord['alergi'];
	$arr['jen_kelamin'] = $tempDataMedicalRecord['jen_kelamin'];
	$arr['gol_darah'] = $tempDataMedicalRecord['gol_darah'];
	$arr['almt_ttp_pasien'] = $tempDataMedicalRecord['almt_ttp_pasien'];
	$arr['url_foto'] = str_replace("../","",$tempDataMedicalRecord['url_foto']);

	$tgl_lahir = date_create($tempDataMedicalRecord['tgl_lhr']);
	$tgldiff=date_diff($datenow,$tgl_lahir);
	$umur=$tgldiff->format("%y");
	$umur_bulan=$tgldiff->format("%m");
	$umur_hari=$tgldiff->format("%d");
	$arr['umur_tahun'] = $umur;
	$arr['umur_bulan'] = $umur_bulan;
	$arr['umur_hari'] = $umur_hari;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
 ?>