<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.max_kode_number");	
loadlib("function","function.max_kode_text");
//$db->debug=true;
//Foto Handler
switch($act){
	case "tambah":
	
	$result = true;
	$db->BeginTrans();
	unset($insertDelivery);
	$insertDelivery["tgl_input"]			= $tgl_input;
	$insertDelivery["keterangan"] 			= $keterangan;
	$insertDelivery["nama_pm"] 				= $nama_pm;
	$insertDelivery["mitra_vendor"] 		= $mitra_vendor;
	$insertDelivery["link_domain"] 			= $link_domain;
	$insertDelivery["id_dd_user"] 			= $id_dd_user;
	$insertDelivery["id_tc_transaksi"] 		= $id_tc_transaksi;
	
		//$result=false;
	$result = insert_tabel("tc_delivery", $insertDelivery);
	$db->CommitTrans($result !== false);

	break;
	
	 case "edit":
	
	$editDelivery["tgl_input"]			= $tgl_input;
	$editDelivery["keterangan"] 		= $keterangan;
	$editDelivery["nama_pm"] 			= $nama_pm;
	$editDelivery["mitra_vendor"] 		= $mitra_vendor;
	$editDelivery["link_domain"] 		= $link_domain;
	$result=true;
	$result = update_tabel("tc_delivery", $editDelivery,"WHERE id_tc_delivery = $id_tc_delivery");
	$db->CommitTrans($result !== false);
	
	break;
	
	/*
	case "delete":

	$result = true;
	$db->BeginTrans();
	$result = delete_tabel("mt_karyawan", "WHERE no_induk=$no_induk");
	$db->CommitTrans($result !== false);

	break; */
}
//die;
if($result){
	$data['code']='200';
}else{
	$data['code']='500';
}
echo json_encode($data);

?>