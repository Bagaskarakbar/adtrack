<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);

$dbGetBPAKO = "SELECT
dbo.mt_depo_stok.kode_brg,
dbo.mt_barang.nama_brg,
dbo.mt_depo_stok.jml_sat_kcl,
dbo.mt_rekap_stok.harga_beli
FROM
dbo.mt_depo_stok
INNER JOIN dbo.mt_barang ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
INNER JOIN dbo.mt_rekap_stok ON dbo.mt_barang.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE
dbo.mt_depo_stok.kode_bagian = '060201' AND
dbo.mt_depo_stok.jml_sat_kcl > dbo.mt_depo_stok.stok_minimum AND
(dbo.mt_barang.kode_kategori = 'D' OR dbo.mt_barang.kode_kategori = 'D1' OR dbo.mt_barang.kode_kategori = 'D2')
ORDER BY dbo.mt_barang.nama_brg ASC
";

$RunGetBPAKO = $db->Execute($dbGetBPAKO);
while ($tempDataBPAKO = $RunGetBPAKO->fetchrow()) {
	$dataBarang['kode_brg'] = $tempDataBPAKO['kode_brg'];
	$dataBarang['nama_brg'] = $tempDataBPAKO['nama_brg'];
	$dataBarang['stok'] = $tempDataBPAKO['jml_sat_kcl'];
	$dataBarang['harga_brg'] = $tempDataBPAKO['harga_beli'];
	$arr['dataBarang'][] = $dataBarang;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>