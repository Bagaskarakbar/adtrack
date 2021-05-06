<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$objektif = $input['objektif'];
$subjektif = $input['subjektif'];
$terapi = $input['terapi'];
$no_kunjungan = $input['no_kunjungan'];
$no_regist = $input['no_regist'];
$no_mr = $input['no_mr'];
$kode_dr = $input['kode_dokter'];
$flagKosong = $input['flagKosong'];
$date=date("Y-m-d h:i:s");

if ($flagKosong == 0) {
	$dataObj['keterangan'] = $objektif;
	$dataObj['tgl_input'] = $date;
	$result = update_tabel("tc_soap",$dataObj,"WHERE no_kunjungan = $no_kunjungan");
	if ($result) {
		$dataSubTer['status_pasien'] = $subjektif;
		$dataSubTer['terapi'] = $terapi;
		$dataSubTer['tgl_input'] = $date;
		$result = update_tabel("tc_status_pasien",$dataSubTer,"WHERE no_kunjungan = $no_kunjungan");

		if ($result) {
			$data['Response']="1";
		} else {
			$data['Response']="0";	
		}
	}
} else if ($flagKosong == 1) {
	$dataObj['keterangan'] = $objektif;
	$dataObj['tgl_input'] = $date;
	$dataObj['no_kunjungan'] = $no_kunjungan;
	$dataObj['no_registrasi'] = $no_regist;
	$dataObj['no_mr'] = $no_mr;
	$dataObj['kode_dokter'] = $kode_dokter;
	$result = insert_tabel("tc_soap",$dataObj);
	if ($result) {
		$dataSubTer['status_pasien'] = $subjektif;
		$dataSubTer['terapi'] = $terapi;
		$dataSubTer['tgl_input'] = $date;
		$dataSubTer['no_kunjungan'] = $no_kunjungan;
		$dataSubTer['no_registrasi'] = $no_regist;
		$dataSubTer['no_mr'] = $no_mr;
		$result = insert_tabel("tc_status_pasien",$dataSubTer);

		if ($result) {
			$data['Response']="1";
		} else {
			$data['Response']="0";	
		}
	}
}

echo json_encode($data);
?>