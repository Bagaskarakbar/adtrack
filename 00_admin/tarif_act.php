<?
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","uang");
loadlib("function","function.input_uang");
loadlib("function","function.submit_uang");


//$db->debug=true;
switch ($act) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":
		/*$nomor_terakhir_kode = read_tabel("mt_master_tarif","kode_tarif","WHERE kode_bagian = $kode_bagian ORDER BY kode_tarif DESC LIMIT 1");
		$kode_tarif_baru = $nomor_terakhir_kode;*/
		$result = true;
		$db->BeginTrans();
		unset($insertDdTarif);
		$insertDdTarif["kode_tarif"] = $kode_tarif;
		$insertDdTarif["kode_bagian"] = $kode_bagian;
		$insertDdTarif["nama_tarif"] = $nama_tarif;
		$insertDdTarif["total"] = submit_uang($bill_dr1)+submit_uang($pendapatan_rs);
		$insertDdTarif["pendapatan_rs"] = submit_uang($pendapatan_rs);
		$insertDdTarif["bill_dr1"] = submit_uang($bill_dr1);
		$insertDdTarif["jenis_tindakan	"] = $jenis_tindakan;
		$insertDdTarif["tingkatan"] = 5;
		$insertDdTarif["urutan"] = $urutan;
		//$result=false;
		$result = insert_tabel("mt_master_tarif", $insertDdTarif);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":
		$result = true;
		$db->BeginTrans();
		unset($editDdTrans);
		$editDdTrans["nama_tarif"] = $nama_tarif;
		$editDdTrans["pendapatan_rs"] = submit_uang($pendapatan_rs);
		$editDdTrans["bill_dr1"] = submit_uang($dokter);
		$editDdTrans["total"] = submit_uang($dokter)+submit_uang($pendapatan_rs);
		$result = update_tabel("mt_master_tarif", $editDdTrans, "WHERE kode_tarif=$kode_tarif");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_master_tarif", "WHERE kode_tarif=$kode_tarif");
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
die();
?>










