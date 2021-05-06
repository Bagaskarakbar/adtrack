<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);
$no_hp = $input['no_hp'];
$pin = $input['pin'];

$sqlCekPasien ="SELECT no_mr, nama_pasien, tgl_lhr FROM mt_master_pasien where no_hp = '$no_hp' and pin =". $pin;

$runCekPasien = $db->Execute($sqlCekPasien);
while ($tempDataPasien = $runCekPasien->fetchrow()) {
	$dataPasien['no_mr'] = $tempDataPasien['no_mr'];
	$dataPasien['tgl_lhr'] = $tempDataPasien['tgl_lhr'];
	$dataPasien['nama_pasien'] = $tempDataPasien['nama_pasien'];
}


if (empty($dataPasien)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$dataPasien['Response'] = 1;
	echo json_encode($dataPasien);
}
