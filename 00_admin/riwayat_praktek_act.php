<?
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");


//$db->debug=true;

unset($AddEditDokDet);
$AddEditDokDet["no_izin_praktek"] = $no_izin_praktek;
$AddEditDokDet["id_dc_propinsi"] = $id_dc_propinsi;
$AddEditDokDet["id_dc_kota"] = $kota;
$AddEditDokDet["status_dokter"] = $status_dr;
$AddEditDokDet["kode_bagian"] = $kode_bagian;
$AddEditDokDet["kode_dokter"] = $kode_dokter;

switch ($act) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":
		$result = true;
		$db->BeginTrans();
		//$result=false;
		$result = insert_tabel("mt_dokter_detail", $AddEditDokDet);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		$result = update_tabel("mt_dokter_detail", $AddEditDokDet, "WHERE id_mt_dokter_detail=$id_mt_dokter_detail");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_dokter_detail", "WHERE id_mt_dokter_detail=$id_mt_dokter_detail");
		$db->CommitTrans($result !== false);

		break;

	}
	
	if($result){
		$data['code']=200;
		echo json_encode($data);
	}else{
		$data['code']=500;
		echo json_encode($data);
	}
//die();
?>










