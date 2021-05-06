<?
	session_start();
	require_once("../_lib/function/db.php");
	require_once("../_lib/function/function.olah_tabel.php");
	//$db->debug=true;
	$result = true;

	$db->BeginTrans();

	//////////////////////////////////////////////////////////////////////

	$result = delete_tabel("mt_karyawan","WHERE id_mt_karyawan=$kode_dokter ");

//***************************************************************************************************************8
// $result=false;
// die();

$db->CommitTrans($result !== false);
	if($result){
		$data['code']=200;
	}else{
		$data['code']=500;
	}
	echo json_encode($data);
	

?>			


