<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$dbGetKesediaan = "SELECT * FROM dbo.dc_kesediaan_obat";

$runGetKesediaan = $db->Execute($dbGetKesediaan);

while ($tempDataKesediaan = $runGetKesediaan->fetchrow()) {
	$DataKesediaan['idKesediaan'] = $tempDataKesediaan['id_dc_kesediaan_obat'];
	$DataKesediaan['nama_kesediaan'] = $tempDataKesediaan['nama_kesediaan'];
	$DataKesediaan['satuan'] = $tempDataKesediaan['satuan'];
	$arr['DataKesediaan'][] = $DataKesediaan;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>