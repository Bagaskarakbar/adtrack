<?php

	set_time_limit(0);
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	// ==================== GET MR,REGIS, ===================//
	
	// $db->debug=true;
	$input = json_decode(file_get_contents('php://input'),true);
	foreach($input as $key => $val){
		$$key=$val;
	}
	
	$cek_pasien=baca_tabel("mt_calon_pasien","no_hp","WHERE no_hp='$no_hp'");
	
	
	$insertMtMasterPasien["nama_pasien"] = strtoupper($nama_pasien);
	$insertMtMasterPasien["nama_keluarga"] = strtoupper($nama_keluarga);
	$insertMtMasterPasien["jen_kelamin"] = $jen_kelamin;
	$insertMtMasterPasien["nik"] = $nik;
	$insertMtMasterPasien["tempat_lahir"] = $tempat_lahir; 
	$insertMtMasterPasien["tgl_lhr"] = $tgl_lhr; 
	$insertMtMasterPasien["almt_ttp_pasien"] = $almt_ttp_pasien; 
	$insertMtMasterPasien["status_perkaw"] = $status_perkaw; 
	$insertMtMasterPasien["gol_dar"] = $gol_dar; 
	$insertMtMasterPasien["alergi"] = $alergi; 
	$insertMtMasterPasien["agama"] = $agama; 
	
	$insertMtMasterPasien["email"] = $email;
	$insertMtMasterPasien["kode_dokter"] = $kode_dokter;
	$insertMtMasterPasien["kode_bagian"] = $kode_bagian;
	
	$insertMtMasterPasien["no_antrian"] = $no_antrian;
	$insertMtMasterPasien["tgl_jam_masuk"] = $jam_antrian;
	$insertMtMasterPasien["tgl_input"] = date("Y-m-d H:i:s");
	
	if($cek_pasien==""){
		$insertMtMasterPasien["no_hp"] = $no_hp;
		$result=insert_tabel("mt_calon_pasien",$insertMtMasterPasien);	
	}else{
		$result=update_tabel("mt_calon_pasien",$insertMtMasterPasien,"WHERE no_hp='$no_hp'");	
	}
	
	
	if($result){
		$arr['status']=1;
	}else{
		$arr['status']=0;
	}
		echo json_encode($arr);
	
?>