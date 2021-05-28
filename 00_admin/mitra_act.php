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
		unset($insertMitra);
		$insertMitra["no_pelanggan"] = $no_pelanggan;
		$insertMitra["nama_pelanggan"] = $nama_pelanggan;
		$insertMitra["id_mt_jenis_pelanggan"] = $id_mt_jenis_pelanggan;
		//$result=false;
		$result = insert_tabel("mt_mitra", $insertMitra);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editMitra);
		$editMitra["no_pelanggan"] = $no_pelanggan;
		$editMitra["nama_pelanggan"] = $nama_pelanggan;
		$editMitra["id_mt_jenis_pelanggan"] = $id_mt_jenis_pelanggan;
		$result = update_tabel("mt_mitra", $editMitra, "WHERE id_mt_mitra=$id_mt_mitra");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_mitra", "WHERE id_mt_mitra=$id_mt_mitra");
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