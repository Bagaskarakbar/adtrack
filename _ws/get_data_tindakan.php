<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$kode_bagian = $input['kode_bagian'];
$kode_klas = $input['kode_klas'];
$tingkatan = $input['tingkatan'];

$sqlGetTindakan = "SELECT
dbo.mt_master_tarif.kode_tarif,
dbo.mt_master_tarif_detail.kode_master_tarif_detail,
dbo.mt_master_tarif.kode_tindakan,
dbo.mt_master_tarif_detail.total,
dbo.mt_master_tarif.nama_tarif,
dbo.mt_master_tarif.jenis_tindakan,
dbo.mt_master_tarif.bill_dr1,
dbo.mt_master_tarif.pendapatan_rs
FROM
dbo.mt_master_tarif
INNER JOIN dbo.mt_master_tarif_detail ON dbo.mt_master_tarif_detail.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE
dbo.mt_master_tarif.kode_bagian = $kode_bagian AND
dbo.mt_master_tarif_detail.kode_klas = $kode_klas AND 
dbo.mt_master_tarif.tingkatan = $tingkatan AND
dbo.mt_master_tarif.jenis_tindakan = 3
";

$RunGetTindakan = $db->Execute($sqlGetTindakan);
while ($tempDataTindakan = $RunGetTindakan->fetchrow()){
	$dataTindakan['kode_tarif']=$tempDataTindakan['kode_tarif'];
	$dataTindakan['kode_tindakan']=$tempDataTindakan['kode_tindakan'];
	$dataTindakan['nama_tarif']=$tempDataTindakan['nama_tarif'];
	$dataTindakan['total']=$tempDataTindakan['total'];
	$dataTindakan['kode_master_tarif_detail']=$tempDataTindakan['kode_master_tarif_detail'];
	$dataTindakan['jenis_tindakan']=$tempDataTindakan['jenis_tindakan'];
	$dataTindakan['bill_dr1']=$tempDataTindakan['bill_dr1'];
	$dataTindakan['pendapatan_rs']=$tempDataTindakan['pendapatan_rs'];
	$arr['dataTindakan'][] = $dataTindakan;
}


if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>