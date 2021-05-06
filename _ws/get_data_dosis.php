<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$inputInfo=file_get_contents('php://input');
$input=json_decode($inputInfo,true);
$id_dc_kesediaan = $input['id_kesediaan'];


$dbGetDosis = "SELECT
id_dd_dosis, nama_dosis 
FROM [dbo].[dd_dosis] 
where id_dc_kesediaan_obat = $id_dc_kesediaan";

$RunGetDosis = $db->Execute($dbGetDosis);

while ($tempDataKesediaan = $RunGetDosis->fetchrow()) {
	$dataDosis['id_dd_dosis'] = $tempDataKesediaan['id_dd_dosis'];
	$dataDosis['nama_dosis'] = $tempDataKesediaan['nama_dosis'];
	$arr['dataDosis'][] = $dataDosis;
}


if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>