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

//inputs and load datas
$no_registrasi = $input['no_registrasi'];
$no_kunjungan = $input['no_kunjungan'];
$no_mr = $input['no_mr'];
$nama_pasien = $input['nama_pasien'];
$kode_kelompok = $input['kode_nasabah'];
$kode_dokter1 = $input['kode_dokter1'];
$id_dd_user = $input['id_dd_user'];
$kode_bagian = $input['kode_bagian'];
$kode_barang = $input['kode_barang'];
$jenis_tindakan = 9;
$nama_tindakan = $input['nama_tindakan'];
$kode_kategori = baca_tabel("dbo.mt_barang","kode_kategori","where mt_barang.kode_brg = '$kode_barang'");
$kode_profit = 2000;
if ($kode_kategori[0] == "D") {
	$profit_margin = baca_tabel("dbo.fr_mt_profit_margin","profit_obat","where fr_mt_profit_margin.kode_profit = '$kode_profit'");
} elseif ($kode_kategori[0] == "E") {
	$profit_margin = baca_tabel("dbo.fr_mt_profit_margin","profit_alkes","where fr_mt_profit_margin.kode_profit = '$kode_profit'");
}
$harga_brg = $input['harga_brg'];
$jumlah = $input['jumlah'];
$bill_rs = ($harga_brg + ($harga_brg * ($profit_margin / 100))) * $jumlah;
$kode_klas = 16;
$date=date("Y-m-d h:i:s");
$kode_trans_pelayanan = baca_tabel("dbo.tc_trans_pelayanan","TOP 1 kode_trans_pelayanan","ORDER BY kode_trans_pelayanan DESC");

//post transaction
$dataTransaksi['no_registrasi'] = $no_registrasi;
$dataTransaksi['no_kunjungan'] = $no_kunjungan;
$dataTransaksi['no_mr'] = $no_mr;
$dataTransaksi['kode_trans_pelayanan'] = $kode_trans_pelayanan+1;
$dataTransaksi['nama_pasien_layan'] = $nama_pasien;
$dataTransaksi['kode_kelompok'] = $kode_kelompok;
$dataTransaksi['tgl_transaksi'] = $date;
if ($kode_kelompok == 2) {
	$kode_perusahaan = $input['kode_perusahaan'];
	$dataTransaksi['kode_perusahaan'] = $kode_perusahaan;
}
$dataTransaksi['jenis_tindakan'] = $jenis_tindakan;
$dataTransaksi['nama_tindakan'] = $nama_tindakan;
$dataTransaksi['bill_rs'] = $bill_rs;
$dataTransaksi['pendapatan_rs'] = $bill_rs;
$dataTransaksi['kode_dokter1'] = $kode_dokter1;
$dataTransaksi['jumlah'] = $jumlah;
$dataTransaksi['kode_barang'] = $kode_barang;
$dataTransaksi['kode_bagian'] = $kode_bagian;
$dataTransaksi['kode_bagian_asal'] = $kode_bagian;
$dataTransaksi['kode_klas'] = 16;
$dataTransaksi['kode_profit'] = $kode_profit;
$dataTransaksi['flag_dokter'] = 1;
$dataTransaksi['id_dd_user'] = $id_dd_user;
$dataTransaksi['tgl_input'] = $date;
$result = insert_tabel("tc_trans_pelayanan",$dataTransaksi);

if ($result) {
	$currentstock = baca_tabel("dbo.mt_depo_stok","jml_sat_kcl","where mt_depo_stok.kode_brg = '$kode_barang' AND mt_depo_stok.kode_bagian = '$kode_bagian'");
	$updatedstock['jml_sat_kcl'] = $currentstock - $jumlah;
	$result = update_tabel("mt_depo_stok",$updatedstock,"where mt_depo_stok.kode_brg = '$kode_barang' AND mt_depo_stok.kode_bagian = '$kode_bagian'");
	if ($result) {
		$data['Response']=1;
	} else {
		$data['Response']=0;
	}
} else {
	$data['Response']=0;
}

echo json_encode($data);
?>