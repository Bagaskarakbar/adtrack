<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");

$result = true;
$db->BeginTrans();

$result = delete_tabel("dd_user_group"," where id_dd_user_group=$id_dd_user_group");
$db->CommitTrans($result !== false);
	
if($result){
	$data['code']=1;
}else{
	$data['code']=0;
}
echo json_encode($data);
?>










