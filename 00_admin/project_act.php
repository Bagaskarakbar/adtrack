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
		unset($insertProject);
		$insertProject["jenis_project"] = $jenis_project;
		//$result=false;
		$result = insert_tabel("mt_jenis_project", $insertProject);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editProject);
		$editProject["jenis_project"] = $jenis_project;
		$result = update_tabel("mt_jenis_project", $editProject, "WHERE id_mt_jenis_project=$id_mt_jenis_project");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_jenis_project", "WHERE id_mt_jenis_project=$id_mt_jenis_project");
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