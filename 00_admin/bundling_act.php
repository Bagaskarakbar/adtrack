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
		unset($insertBundling);
		$insertBundling["nama_bundling"] = $nama_bundling;
		//$result=false;
		$result = insert_tabel("mt_bundling", $insertBundling);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editBundling);
		$editBundling["nama_bundling"] = $nama_bundling;
		$result = update_tabel("mt_bundling", $editBundling, "WHERE id_mt_bundling=$id_mt_bundling");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_bundling", "WHERE id_mt_bundling=$id_mt_bundling");
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