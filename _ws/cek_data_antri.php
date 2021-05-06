<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);

$kode_dokter = $input['kode_dokter'];
$kode_bagian = $input['kode_bagian'];
$no_antrian = $input['no_antrian'];

$date=date("Y-m-d");

$SqlCekAntrian="SELECT kode_poli from pl_tc_poli where kode_dokter='$kode_dokter' AND kode_bagian='$kode_bagian' and no_antrian = '$no_antrian' and tgl_jam_poli BETWEEN '$date 00:00:00' AND '$date 23:59:00'";

$RunCekAntrian = $db->Execute($SqlCekAntrian);
while ($tempCekAntrian = $RunCekAntrian->Fetchrow()) {
	$kode_poli = $tempCekAntrian['kode_poli'];
	if (!is_null($kode_poli)) {
		$datajadwal['antrian_exist'] = "true";
	} else {
		$datajadwal['antrian_exist'] = "false";
	}
};


if (empty($datajadwal)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$datajadwal['Response'] = 1;
	echo json_encode($datajadwal);
}
?>