<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");

$result = true;
$db->BeginTrans();

unset($insertDdUser);
$insertDdUser["nama_group"] = $nama_group;
$insertDdUser["keterangan"] = $keterangan;
$result = insert_tabel("dd_user_group", $insertDdUser);
$db->CommitTrans($result !== false);
	
if($result){
	$data['code']=1;
}else{
	$data['code']=0;
}
echo json_encode($data);
?>










