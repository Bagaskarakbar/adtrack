<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");

//$db->debug=true;

$result = true;
$db->BeginTrans();
$result = delete_tabel("pm_mt_standarhasil", "WHERE kode_mt_hasilpm='$kode_mt_hasilpm'");

	$db->CommitTrans($result !== false);
	//////////////////////////////////////////////////////////////////////
	if($result){
		$data['code']='200';
	}else{
		$data['code']='500';
	}
	echo json_encode($data);

?>
