<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$offset_number = $input['offset_number'];
$parameter_search = $input['parameter_search'];
$total_page = 0;

//$db->debug=true;

if(!is_null($parameter_search)){
	// $params[] = $parameter_search;
	$params = explode(' ',$parameter_search);
	// if (is_array($explode)) {
	// 	foreach ($explode as $words) {
	// 		array_push($params, $words);
	// 	}
	// }
	// $finalparams = "";
	foreach($params as $explodedparams){
		$sqlTotal=read_tabel("dbo.mt_master_pasien","*","WHERE dbo.mt_master_pasien.nama_pasien LIKE '%$explodedparams%'");
		$pasien=$sqlTotal->RecordCount();
		$total_pasien+=$pasien;
		$sql_query = "
		SELECT dbo.mt_master_pasien.no_mr,
		dbo.mt_master_pasien.nama_pasien,
		dbo.mt_master_pasien.url_foto,
		dbo.mt_master_pasien.id_mt_master_pasien
		FROM dbo.mt_master_pasien
		WHERE dbo.mt_master_pasien.nama_pasien LIKE '%$explodedparams%'
		ORDER BY dbo.mt_master_pasien.nama_pasien 
		OFFSET $offset_number ROWS
		FETCH NEXT 10 ROWS ONLY";

		$runGetMedicalRecord = $db->Execute($sql_query);
		while($tempDataMedicalRecord = $runGetMedicalRecord->fetchrow()){
			$dataPasien['no_mr'] = $tempDataMedicalRecord['no_mr'];
			$dataPasien['nama_pasien'] = $tempDataMedicalRecord['nama_pasien'];
			$dataPasien['url_foto'] = str_replace("../","",$tempDataMedicalRecord['url_foto']);
			$dataPasien['id_mt_master_pasien'] = $tempDataMedicalRecord['id_mt_master_pasien'];
			$arr['dataPasien'][] = $dataPasien;
		}
	}
}else{
	$sql_where = "";
	$sqlTotal=read_tabel("dbo.mt_master_pasien","*");
	$total_pasien=$sqlTotal->RecordCount();
	$sql_query = "
	SELECT dbo.mt_master_pasien.no_mr,
	dbo.mt_master_pasien.nama_pasien,
	dbo.mt_master_pasien.url_foto,
	dbo.mt_master_pasien.id_mt_master_pasien
	FROM dbo.mt_master_pasien
	$sql_where
	ORDER BY dbo.mt_master_pasien.nama_pasien 
	OFFSET $offset_number ROWS
	FETCH NEXT 10 ROWS ONLY";

	$runGetMedicalRecord = $db->Execute($sql_query);
	while($tempDataMedicalRecord = $runGetMedicalRecord->fetchrow()){
		$dataPasien['no_mr'] = $tempDataMedicalRecord['no_mr'];
		$dataPasien['nama_pasien'] = $tempDataMedicalRecord['nama_pasien'];
		$dataPasien['url_foto'] = str_replace("../","",$tempDataMedicalRecord['url_foto']);
		$dataPasien['id_mt_master_pasien'] = $tempDataMedicalRecord['id_mt_master_pasien'];
		$arr['dataPasien'][] = $dataPasien;
	}
}

$total_page = ceil($total_pasien/10);

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['total_page'] = $total_page;
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>