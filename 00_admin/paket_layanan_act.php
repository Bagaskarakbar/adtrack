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
		unset($insertPaketLayanan);
		$insertPaketLayanan["nama_paket"] = $nama_paket;
		$insertPaketLayanan["id_mt_layanan"] = $id_mt_layanan;
		//$result=false;
		$result = insert_tabel("mt_paket", $insertPaketLayanan);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editPaketLayanan);
		$editPaketLayanan["nama_paket"] = $nama_paket;
		$editPaketLayanan["id_mt_layanan"] = $id_mt_layanan;
		$result = update_tabel("mt_paket", $editPaketLayanan, "WHERE id_mt_paket=$id_mt_paket");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_paket", "WHERE id_mt_paket=$id_mt_paket");
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