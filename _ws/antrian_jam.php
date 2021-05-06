<?php
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
// $db->debug=true;
$data=file_get_contents("php://input");
$arr=json_decode($data,TRUE);

$Q_cek="SELECT COUNT(no_antrian) as jml FROM pl_tc_poli WHERE tgl_jam_poli BETWEEN '".$arr['tgl']." 00:00:00' AND '".$arr['tgl']." 23:59:59' AND kode_bagian='".$arr['kode_bagian']."' AND kode_dokter='".$arr['kode_dokter']."'";
$hsl_cek =& $db->Execute($Q_cek);
$jml = $hsl_cek->Fields('jml');

if($jml>0){
	
	$Q_antrian="SELECT no_antrian FROM pl_tc_poli WHERE tgl_jam_poli BETWEEN '".$arr['tgl']." 00:00:00' AND '".$arr['tgl']."  23:59:59' AND kode_bagian='".$arr['kode_bagian']."' AND kode_dokter='".$arr['kode_dokter']."' ORDER BY no_antrian ASC";
	$hsl_antrian =& $db->Execute($Q_antrian);
	while ($tmpl_antrian=$hsl_antrian->FetchRow()) {
		$respon['no_antrian']=$tmpl_antrian["no_antrian"];
		$respon[].=$tmpl_antrian["no_antrian"];
	}
	
}else{
	$respon['no_antrian']=0;
}

echo json_encode($respon);
?>