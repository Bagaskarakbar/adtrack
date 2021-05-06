<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);
$kode_dokter = $input['kode_dokter'];
$sql_query_sebaran_per_bulan ="
SELECT
Count(dbo.pl_tc_poli.id_pl_tc_poli) AS jumlah_pasien,
dbo.mt_master_pasien.jen_kelamin
FROM
dbo.pl_tc_poli
INNER JOIN dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
INNER JOIN dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
WHERE
dbo.pl_tc_poli.kode_dokter = $kode_dokter AND
dbo.pl_tc_poli.tgl_jam_poli BETWEEN '2018-05-01 00:00:00' AND '2018-05-31 23:59:59'
GROUP BY dbo.mt_master_pasien.jen_kelamin ";

$runSebaran_per_Bulan = $db->Execute($sql_query_sebaran_per_bulan);
while($data = $runSebaran_per_Bulan->fetchrow()){
	$sebaranPerBulan['jumlah_pasien'] = $data['jumlah_pasien'];
	$sebaranPerBulan['jen_kelamin'] = $data['jen_kelamin'];
	$arr['sebaranPerBulan'][] = $sebaranPerBulan;
}

//data pasien per hari

$sql_query_pasien_per_hari ="
SELECT
Count(dbo.pl_tc_poli.id_pl_tc_poli) AS jumlah_pasien
FROM
dbo.pl_tc_poli
INNER JOIN dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
INNER JOIN dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
WHERE
dbo.pl_tc_poli.kode_dokter = $kode_dokter AND
dbo.pl_tc_poli.tgl_jam_poli BETWEEN '2018-05-01 00:00:00' AND '2018-05-01 23:59:59'";

$runSebaran_per_Hari = $db->Execute($sql_query_pasien_per_hari);
while($dataPasienPerHari = $runSebaran_per_Hari->fetchrow()){
	$pasienPerHari['jumlah_pasien'] = $dataPasienPerHari['jumlah_pasien'];
	$arr['pasienPerHari'][] = $pasienPerHari;
}

//data pendapatan dokter
$sql_query_pendapatan_dokter = "
SELECT
Sum(dbo.tc_trans_pelayanan.bill_dr1) AS pendapatan_dokter
FROM
dbo.tc_trans_pelayanan
WHERE
dbo.tc_trans_pelayanan.kode_dokter1 = $kode_dokter AND
dbo.tc_trans_pelayanan.tgl_transaksi BETWEEN '2018-01-02 00:00:00' AND '2018-01-02 23:59:59'";

$pendapatanDokterHarian = $db->Execute($sql_query_pendapatan_dokter);
while($dataPendapatanDokter = $pendapatanDokterHarian->fetchrow()){
	$pendapatanDokter['pendapatan_dokter'] = $dataPendapatanDokter['pendapatan_dokter'];
	$arr['pendapatanDokter'][] = $pendapatanDokter;
}
$currentYear = date("Y");
//data pendapatan per bulan
$sql_query_pendapatan_per_bulan = "
SELECT
MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS Bulan,
YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS Tahun,
Sum(dbo.tc_trans_pelayanan.bill_dr1) AS pendapatan_dokter_per_bulan
FROM
dbo.tc_trans_pelayanan
INNER JOIN dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE
dbo.tc_trans_pelayanan.kode_dokter1 = $kode_dokter AND
YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = $currentYear
GROUP BY
MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), YEAR(dbo.tc_trans_pelayanan.tgl_transaksi)
ORDER BY
MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) ASC";

$pendapatan_per_bulan = $db->Execute($sql_query_pendapatan_per_bulan);
while($dataPendapatanPerBulan = $pendapatan_per_bulan->fetchrow()){
	$pendapatanPerBulan['Bulan'] = $dataPendapatanPerBulan['Bulan'];
	$pendapatanPerBulan['Tahun'] = $dataPendapatanPerBulan['Tahun'];
	$pendapatanPerBulan['pendapatan_dokter_per_bulan'] = $dataPendapatanPerBulan['pendapatan_dokter_per_bulan'];
	$arr['pendapatanPerBulan'][] = $pendapatanPerBulan;
}

//pendapatan per bagian
$currentMonth = date("m");
$monthMin = 0;
$monthMax = 0;
$condition ="";

if($currentMonth>=1 && $currentMonth<=3 ){
	$condition = "AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 1 AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) <= 3
	AND YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = $currentYear";
}
elseif($currentMonth>=4 && $currentMonth<=6){
	$condition = "AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 4 AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) <= 6
	AND YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = $currentYear";
}
elseif($currentMonth>=7 && $currentMonth<=9){
	$condition = "AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 7 AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) <= 9
	AND YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = $currentYear";
}
elseif($currentMonth>=10 && $currentMonth<=12){
	$condition = "AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 10 AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) <= 12
	AND YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = $currentYear";
}
$sql_query_pendapatan_per_bagian = "
SELECT
dbo.mt_bagian.validasi,
MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) as bulan,
YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) as tahun,
Sum(dbo.tc_trans_pelayanan.bill_dr1) AS jml_pendapatan
FROM
dbo.tc_trans_pelayanan
INNER JOIN dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE
dbo.tc_trans_pelayanan.kode_dokter1 = $kode_dokter AND dbo.tc_trans_pelayanan.bill_dr1 !< 1
$condition
GROUP BY
dbo.mt_bagian.validasi,
MONTH(dbo.tc_trans_pelayanan.tgl_transaksi),
YEAR(dbo.tc_trans_pelayanan.tgl_transaksi)
ORDER BY YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) DESC";

$pendapatan_per_bagian = $db->Execute($sql_query_pendapatan_per_bagian);
while($dataPendapatanPerBagian = $pendapatan_per_bagian->fetchrow()){
	$pendapatanPerBagian['validasi'] = $dataPendapatanPerBagian['validasi'];
	$pendapatanPerBagian['bulan'] = $dataPendapatanPerBagian['bulan'];
	$pendapatanPerBagian['jml_pendapatan'] = $dataPendapatanPerBagian['jml_pendapatan'];
	$arr['pendapatanPerBagian'][] = $pendapatanPerBagian;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
 ?>