<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);

$id_pl_tc_poli = $input['id_pl_tc'];
$date=date("Y-m-d");

$hari=$input['hari'];

$arr_hari[1]='senin';
$arr_hari[2]='selasa';
$arr_hari[3]='rabu';
$arr_hari[4]='kamis';
$arr_hari[5]='jumat';
$arr_hari[6]='sabtu';
$arr_hari[7]='minggu';

$hariNow=$arr_hari[$hari];

$sqlDataAntri = "SELECT
mt_bagian.nama_bagian,
mt_karyawan.nama_pegawai,
pl_tc_poli.no_antrian,
mt_master_pasien.nama_pasien,
mt_master_pasien.no_mr,
mt_master_pasien.almt_ttp_pasien,
mt_master_pasien.jen_kelamin,
mt_jadwal_dokter.jam_mulai,
mt_jadwal_dokter.waktu_periksa,
tc_kunjungan.umur_tahun,
tc_kunjungan.umur_bulan,
tc_kunjungan.umur_hari
FROM
pl_tc_poli
INNER JOIN mt_bagian ON pl_tc_poli.kode_bagian = mt_bagian.kode_bagian
INNER JOIN mt_karyawan ON pl_tc_poli.kode_dokter = mt_karyawan.kode_dokter
INNER JOIN tc_kunjungan ON pl_tc_poli.no_kunjungan = tc_kunjungan.no_kunjungan
INNER JOIN mt_master_pasien ON tc_kunjungan.no_mr = mt_master_pasien.no_mr
INNER JOIN mt_jadwal_dokter ON pl_tc_poli.kode_dokter = mt_jadwal_dokter.kode_dokter
WHERE
pl_tc_poli.id_pl_tc_poli = $id_pl_tc_poli AND $hariNow = 1 and pl_tc_poli.tgl_jam_poli BETWEEN '$date 00:00:00' AND '$date 23:59:00'";

$RunDataAntri = $db->Execute($sqlDataAntri);
while ($tempDataAntri = $RunDataAntri->Fetchrow()) {
	$arrData['nama_bagian'] = $tempDataAntri['nama_bagian'];
	$arrData['nama_pegawai'] = $tempDataAntri['nama_pegawai'];
	$arrData['no_antrian'] = $tempDataAntri['no_antrian'];
	$arrData['nama_pasien'] = $tempDataAntri['nama_pasien'];
	$arrData['no_mr'] = $tempDataAntri['no_mr'];
	$arrData['almt_ttp_pasien'] = $tempDataAntri['almt_ttp_pasien'];
	$arrData['jen_kelamin'] = $tempDataAntri['jen_kelamin'];
	$arrData['jam_mulai'] = $tempDataAntri['jam_mulai'];
	$arrData['waktu_periksa'] = $tempDataAntri['waktu_periksa'];
	$arrData['umur_tahun'] = $tempDataAntri['umur_tahun'];
	$arrData['umur_bulan'] = $tempDataAntri['umur_bulan'];
	$arrData['umur_hari'] = $tempDataAntri['umur_hari'];
}

if (empty($arrData)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arrData['Response'] = 1;
	echo json_encode($arrData);
}
?>