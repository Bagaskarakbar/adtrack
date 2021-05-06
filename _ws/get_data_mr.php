<?php

	set_time_limit(0);
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	// ==================== GET MR,REGIS, ===================//
	
	// $db->debug=true;
	$input = json_decode(file_get_contents('php://input'),true);
	
		
		$H_mr=read_tabel("mt_master_pasien","*","WHERE no_mr='".$input['no_mr']."'");
		$Count_mr=$H_mr->RecordCount();
		
		$arr['jml_mr']=$Count_mr;
		
		while($T_dokter=$H_mr->Fetchrow()){
			$arr['pasien'][]=$T_dokter;
		}
	
	
	echo json_encode($arr);
?>