<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);

$date=date("Y-m-d H:i:s");
$datenow = date_create(date("Y-m-d H:i:s"));
$tgllhr=date_create($input['tgl_lahir']);
$tgldiff=date_diff($datenow,$tgllhr);
$umur=$tgldiff->format("%y");
$umur_bulan=$tgldiff->format("%m");
$umur_hari=$tgldiff->format("%d");

$no_reg_sebelum = baca_tabel("tc_registrasi","TOP 1 no_registrasi","ORDER BY no_registrasi DESC");
$no_reg = $no_reg_sebelum + 1;
$data_registrasi['no_mr'] = $input['no_mr'];
$data_registrasi['kode_dokter'] = $input['kode_dokter'];
$data_registrasi['kode_bagian_masuk'] = $input['kode_bagian'];
$data_registrasi['no_registrasi'] = $no_reg;
$data_registrasi['tgl_jam_masuk'] = $date;
$data_registrasi['kode_kelompok'] = "1";
$data_registrasi['stat_pasien'] = "LAMA";
$data_registrasi['lama_baru'] = "1";
$data_registrasi['umur'] = $umur;
$data_registrasi['umur_bulan'] = $umur_bulan;
$data_registrasi['umur_hari'] = $umur_hari;
$data_registrasi['id_tc_registrasi_perusahaan'] = "0";
$result = insert_tabel("tc_registrasi",$data_registrasi);

if ($result) {
	$no_kunj_sebelum = baca_tabel("tc_kunjungan","TOP 1 no_kunjungan","ORDER BY no_kunjungan DESC");
	$no_kunjungan = $no_kunj_sebelum + 1;
	$data_kunjungan['no_kunjungan'] = $no_kunjungan;
	$data_kunjungan['no_registrasi'] = $no_reg;
	$data_kunjungan['no_mr'] = $input['no_mr'];
	$data_kunjungan['kode_dokter'] = $input['kode_dokter'];
	$data_kunjungan['kode_bagian_tujuan'] = $input['kode_bagian'];
	$data_kunjungan['kode_bagian_asal'] = $input['kode_bagian'];
	$data_kunjungan['tgl_masuk'] = $date;
	$data_kunjungan['umur_tahun'] = $umur;
	$data_kunjungan['umur_bulan'] = $umur_bulan;
	$data_kunjungan['umur_hari'] = $umur_hari;
	$result = insert_tabel("tc_kunjungan",$data_kunjungan);

	if ($result) {
		$kode_poli_sebelum = baca_tabel("pl_tc_poli","TOP 1 kode_poli","ORDER BY kode_poli DESC");
		$kode_poli = $kode_poli_sebelum + 1;
		$data_poli['kode_poli'] = $kode_poli;
		$data_poli['no_kunjungan'] = $no_kunjungan;
		$data_poli['kode_bagian'] = $input['kode_bagian'];
		$data_poli['no_antrian'] = $input['no_antrian'];
		$data_poli['tgl_jam_poli'] = $date;
		$data_poli['kode_dokter'] = $input['kode_dokter'];
		$data_poli['nama_pasien'] = $input['nama_pasien'];
		$data_poli['asal_pasien'] = "MOBILE";
		$result = insert_tabel("pl_tc_poli",$data_poli);

		if ($result) {
			$data['Response'] = 1;
			echo json_encode($data);
		} else {
			$data['Response'] = 0;
			echo json_encode($data);
		}
	}
}
?>