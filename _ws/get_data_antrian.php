<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);

$kode_dokter = $input['kode_dokter'];
$kode_bagian = $input['kode_bagian'];

$hari=$input['hari'];

$arr_hari[1]='senin';
$arr_hari[2]='selasa';
$arr_hari[3]='rabu';
$arr_hari[4]='kamis';
$arr_hari[5]='jumat';
$arr_hari[6]='sabtu';
$arr_hari[7]='minggu';

$hariNow=$arr_hari[$hari];

$sqlgetjadwal="SELECT jam_akhir, jam_mulai, waktu_periksa FROM mt_jadwal_dokter WHERE kode_dokter = $kode_dokter and kode_bagian = $kode_bagian and $hariNow = 1";

$rungetjadwal = $db->Execute($sqlgetjadwal);
while ($tempdatajadwal = $rungetjadwal->Fetchrow()) {
	$datajadwal['jam_akhir'] = $tempdatajadwal['jam_akhir'];
	$datajadwal['jam_mulai'] = $tempdatajadwal['jam_mulai'];
	$datajadwal['waktu_periksa'] = $tempdatajadwal['waktu_periksa'];
	$lamapraktek = strtotime($tempdatajadwal['jam_akhir'])-strtotime($tempdatajadwal['jam_mulai']);
	$indexjadwal = (($lamapraktek/60)/$tempdatajadwal['waktu_periksa']);
	$indexjadwal = round($indexjadwal);
	$datajadwal['index_jadwal'] = $indexjadwal;
}

if (empty($datajadwal)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$datajadwal['Response'] = 1;
	echo json_encode($datajadwal);
}
?>