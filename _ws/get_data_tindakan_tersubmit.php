<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$no_kunjungan = $input['no_kunjungan'];

$dbGetTindakan = "SELECT
dbo.tc_trans_pelayanan.kode_trans_pelayanan,
dbo.tc_trans_pelayanan.nama_tindakan,
dbo.tc_trans_pelayanan.bill_rs,
dbo.tc_trans_pelayanan.jumlah,
dbo.tc_trans_pelayanan.bill_dr1
FROM
dbo.tc_trans_pelayanan
WHERE
dbo.tc_trans_pelayanan.no_kunjungan = $no_kunjungan AND
(dbo.tc_trans_pelayanan.jenis_tindakan = 3 OR dbo.tc_trans_pelayanan.jenis_tindakan = 9)";

$runGetTindakan = $db->Execute($dbGetTindakan);

while ($tempTindakan = $runGetTindakan->fetchrow()) {
	$dataTindakan['kode_trans_pelayanan'] = $tempTindakan['kode_trans_pelayanan'];
	$dataTindakan['nama_tindakan'] = $tempTindakan['nama_tindakan'];
	$total = $tempTindakan['bill_rs'];
	if ($total == 0) {
		$dataTindakan['total'] = $tempTindakan['bill_dr1'];
	} else{
		$dataTindakan['total'] = $total;
	}
	$dataTindakan['jumlah'] = $tempTindakan['jumlah'];
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