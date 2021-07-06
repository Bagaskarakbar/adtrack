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

switch($act){
	case "tambah":
	
	$result = true;
	$db->BeginTrans();
	unset($insertMonitoring);
	$insertMonitoringDetail["keterangan"] 			= $keterangan;
	$insertMonitoringDetail["tgl_mulai"] 			= $tgl_mulai;
	$insertMonitoringDetail["tgl_selesai"] 			= $tgl_selesai;
	$insertMonitoringDetail["progres"] 				= $progres;
	$insertMonitoringDetail["id_tc_monitoring"] 	= $id_tc_monitoring;
	
	$result = insert_tabel("tc_monitoring_detail", $insertMonitoringDetail);
	
	
	$TotProgres = baca_tabel("tc_monitoring_detail","sum(progres)","where id_tc_monitoring=$id_tc_monitoring");
	
	$updateMonitoring["tgl_mulai"] 			= $tgl_mulai;
	$updateMonitoring["tgl_selesai"] 		= $tgl_selesai;
	$updateMonitoring["progres"] 			= $TotProgres;
	if($result)$result = update_tabel("tc_monitoring", $updateMonitoring,"WHERE id_tc_monitoring = $id_tc_monitoring");
	
	$db->CommitTrans($result !== false);

	break;
	
	
	case "delete":

	$result = true;
	$db->BeginTrans();
	$result = delete_tabel("tc_monitoring_detail", "WHERE id_tc_monitoring_detail=$idd");
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