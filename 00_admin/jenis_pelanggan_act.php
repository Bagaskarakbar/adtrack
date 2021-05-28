<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
//$db->debug=true;


switch ($act) {

	// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":

		$result = true;
		$db->BeginTrans();
		unset($insertPelanggan);
		$insertPelanggan["jenis_pelanggan"] = $jenis_pelanggan;
		//$result=false;
		$result = insert_tabel("mt_jenis_pelanggan", $insertPelanggan);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editPelanggan);
		$editPelanggan["jenis_pelanggan"] = $jenis_pelanggan;
		$result = update_tabel("mt_jenis_pelanggan", $editPelanggan, "WHERE id_mt_jenis_pelanggan=$id_mt_jenis_pelanggan");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_jenis_pelanggan", "WHERE id_mt_jenis_pelanggan=$id_mt_jenis_pelanggan");
		$db->CommitTrans($result !== false);

		break;

}
//die;
if($result){
	$data['code']='200';
}else{
	$data['code']='500';
}
echo json_encode($data);

?>