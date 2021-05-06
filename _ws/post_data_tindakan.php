<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);

// $db->debug=true;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// flag tipe
$typeTindakan = $input['typeTindakan'];

//data umum
$no_registrasi = $input['no_registrasi'];
$no_mr = $input['no_mr'];
$nama_pasien = $input['nama_pasien'];
$kode_kelompok = $input['kode_nasabah'];
$kode_dokter1 = $input['kode_dokter1'];
$id_dd_user = $input['id_dd_user'];
$kode_master_tarif = $input['kode_master_tarif'];
$kode_bagian = $input['kode_bagian'];

//select buat semua
$dbGetDetailTindakan = "SELECT
dbo.mt_master_tarif.jenis_tindakan,
dbo.mt_master_tarif_detail.kode_master_tarif_detail,
dbo.mt_master_tarif.total,
dbo.mt_master_tarif.bill_dr1,
dbo.mt_master_tarif.pendapatan_rs,
dbo.mt_master_tarif.nama_tarif
FROM
dbo.mt_master_tarif
INNER JOIN dbo.mt_master_tarif_detail ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif
where mt_master_tarif.kode_tarif = $kode_master_tarif";

$RunGetDetailTindakan = $db->Execute($dbGetDetailTindakan);
while ($tempDetailTindakan = $RunGetDetailTindakan->fetchrow()) {
	$jenis_tindakan = $tempDetailTindakan['jenis_tindakan'];
	$kode_master_tarif_detail = $tempDetailTindakan['kode_master_tarif_detail'];
	$total = $tempDetailTindakan['total'];
	$bill_dr1 = $tempDetailTindakan['bill_dr1'];
	$pendapatan_rs = $tempDetailTindakan['pendapatan_rs'];
	$nama_tindakan = $tempDetailTindakan['nama_tarif'];
}

if ($typeTindakan == 1) {
	$no_kunjungan = $input['no_kunjungan'];
} else if ($typeTindakan == 3 || $typeTindakan == 4 || $typeTindakan == 5) {
	$jenis_pembayaran = $input['jenis_pembayaran'];
	$status_cito = $input['status_cito'];
	$nama_dokter = $input['nama_dokter'];
	//$keterangan = $input['nama_tindakan'];
	$kode_dokter_lab = $input['kode_dokter_lab'];

	// $id_dd_dokter_lab = baca_tabel("dbo.mt_karyawan
	// 	INNER JOIN dbo.dd_user ON dbo.mt_karyawan.no_induk = dbo.dd_user.no_induk","dd_user.id_dd_user","WHERE
	// 	mt_karyawan.kode_dokter IS NOT NULL AND mt_karyawan.kode_dokter = $kode_dokter_lab");

	$tgl_lahir = baca_tabel("dbo.mt_master_pasien","tgl_lhr","where no_mr = $no_mr");
}

$date=date("Y-m-d h:i:s");

$kode_trans_pelayanan = baca_tabel("dbo.tc_trans_pelayanan","TOP 1 kode_trans_pelayanan","ORDER BY kode_trans_pelayanan DESC");

if ($typeTindakan == 1) {
	$bill_rs = $total;

	$dataTransaksi['kode_trans_pelayanan'] = $kode_trans_pelayanan + 1;
	$dataTransaksi['no_kunjungan'] = $no_kunjungan;
	$dataTransaksi['no_registrasi'] = $no_registrasi;
	$dataTransaksi['no_mr'] = $no_mr;
	$dataTransaksi['tgl_transaksi'] = $date;
	$dataTransaksi['nama_pasien_layan'] = $nama_pasien;
	$dataTransaksi['kode_kelompok'] = $kode_kelompok;
	if ($kode_kelompok == 2) {
		$kode_perusahaan = $input['kode_perusahaan'];
		$dataTransaksi['kode_perusahaan'] = $kode_perusahaan;
	}
	$dataTransaksi['jenis_tindakan'] = $jenis_tindakan;
	$dataTransaksi['nama_tindakan'] = $nama_tindakan;
	$dataTransaksi['bill_rs'] = $bill_rs;
	$dataTransaksi['bill_dr1'] = $bill_dr1;
	$dataTransaksi['jumlah'] = 1;
	$dataTransaksi['kode_dokter1'] = $kode_dokter1;
	$dataTransaksi['kode_master_tarif_detail'] = $kode_master_tarif_detail;
	$dataTransaksi['kode_tarif'] = $kode_master_tarif;
	$dataTransaksi['kode_bagian'] = $kode_bagian;
	$dataTransaksi['kode_bagian_asal'] = $kode_bagian;
	$dataTransaksi['kode_klas'] = 16;
	$dataTransaksi['pendapatan_rs'] = $pendapatan_rs;
	$dataTransaksi['tgl_input'] = $date;
	$dataTransaksi['id_dd_user'] = $id_dd_user;
	$dataTransaksi['status_selesai'] = 1;
	$dataTransaksi['flag_dokter'] = 1;

	$result = insert_tabel("tc_trans_pelayanan",$dataTransaksi);

	if ($result) {
		$data['Response']=1;
	} else {
		$data['Response']=0;
	}
} else if ($typeTindakan == 3) {
	//data perlu
	$datenow = date_create(date("Y-m-d H:i:s"));
	$tgl_lahir_create = date_create(date($tgl_lahir));
	$tgl_diff = date_diff($datenow,$tgl_lahir_create);
	$umur_tahun = $tgl_diff->format("%y");
	$umur_bulan = $tgl_diff->format("%m");
	$umur_hari = $tgl_diff->format("%d");
	$kode_bagian_tujuan = "050101";
	$no_antrian_lama = baca_tabel("dbo.pm_tc_penunjang","TOP 1 no_antrian","where tgl_daftar 
		BETWEEN '$date 00:00:00' AND '$date 23:59:59' 
		AND kode_bagian = $kode_bagian_tujuan ORDER BY no_antrian DESC");
	$no_kunjungan = baca_tabel("dbo.tc_kunjungan","TOP 1 no_kunjungan","ORDER BY no_kunjungan DESC");
	$dataKunjungan['no_kunjungan'] = $no_kunjungan+1;
	$dataKunjungan['no_registrasi'] =$no_registrasi;
	$dataKunjungan['no_mr'] = $no_mr;
	$dataKunjungan['kode_dokter'] = $kode_dokter1;
	$dataKunjungan['kode_bagian_tujuan'] = $kode_bagian_tujuan;
	$dataKunjungan['kode_bagian_asal'] = $kode_bagian;
	$dataKunjungan['tgl_masuk'] = $date;
	$dataKunjungan['status_masuk'] = '1';
	$dataKunjungan['status_cito'] = $status_cito;
	$dataKunjungan['umur_tahun'] = $umur_tahun;
	$dataKunjungan['umur_bulan'] = $umur_bulan;
	$dataKunjungan['umur_hari'] = $umur_hari;

	$result = insert_tabel("tc_kunjungan",$dataKunjungan);
	if ($result) {
		$data['Response']=1;
	} else {
		$data['Response']=0;
	}
	//masukin data transaksi
	//-> $result
	//if $result masukin data penunjang
	//if $result -> load data tindakan
	//if $result -> return response + data tindakan
}

echo json_encode($data);
?>