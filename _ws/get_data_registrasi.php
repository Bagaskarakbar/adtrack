<?
session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	// $db->debug=true;
	$data=file_get_contents("php://input");
	$arr=json_decode($data,TRUE);
	foreach($arr as $key => $val){
		$$key=$val;
	}
	
	//==============reservasi pasien baru==========================//
	$Q_reg_baru="SELECT * FROM mt_calon_pasien WHERE no_hp='$no_hp'";
	$H_reg_baru=$db->Execute($Q_reg_baru);
	$Count_baru=$H_reg_baru->RecordCount();
	
	if($Count_baru>0){
		
		while($T_reg_baru=$H_reg_baru->Fetchrow()){
		
			$T_reg_baru['nama_dokter']		= baca_tabel("mt_karyawan","nama_pegawai","WHERE kode_dokter='".$T_reg_baru['kode_dokter']."'");
			$T_reg_baru['nama_poli']			= baca_tabel("mt_bagian","nama_bagian","WHERE kode_bagian='".$T_reg_baru['kode_bagian']."'");
			$T_reg_baru['status_pasien']='BARU';
			
			$data_reg[]=$T_reg_baru;
		}
	}
	//==============reservasi pasien lama==========================//
	if($no_registrasi!=""){
		$sql_plus="AND tc_registrasi.no_registrasi='$no_registrasi'";
	}
	
	if($no_hp!="" && $no_mr!=""){
		$sql_nambah="WHERE (tc_registrasi.no_mr='$no_mr' OR mt_master_pasien.no_hp='$no_hp')";
	}else{
		if($no_hp!=""){
			$sql_plus_hp="WHERE mt_master_pasien.no_hp='$no_hp'";
		}
		if($no_mr!=""){
			$sql_plus_mr="WHERE tc_registrasi.no_mr='$no_mr'";
		}
	}
	
	
	
	$Q_reg="SELECT mt_master_pasien.nama_pasien, jen_kelamin, umur_pasien, almt_ttp_pasien, tc_registrasi.no_registrasi, tc_registrasi.no_mr, tc_registrasi.kode_dokter, tgl_jam_masuk, kode_bagian_masuk, stat_pasien, no_antrian FROM tc_registrasi INNER JOIN tc_kunjungan ON tc_kunjungan.no_registrasi=tc_registrasi.no_registrasi INNER JOIN pl_tc_poli ON pl_tc_poli.no_kunjungan=tc_kunjungan.no_kunjungan INNER JOIN mt_master_pasien ON mt_master_pasien.no_mr=tc_registrasi.no_mr $sql_nambah $sql_plus_mr $sql_plus_hp $sql_plus";
	
	$H_reg=$db->Execute($Q_reg);
	
	$Count_reg=$H_reg->RecordCount();
	
	// print_r($Count_reg);
	if($Count_reg>0){
		
		while($T_reg=$H_reg->Fetchrow()){
		
			$T_reg['nama_dokter']		= baca_tabel("mt_karyawan","nama_pegawai","WHERE kode_dokter='".$T_reg['kode_dokter']."'");
			$T_reg['nama_poli']			= baca_tabel("mt_bagian","nama_bagian","WHERE kode_bagian='".$T_reg['kode_bagian_masuk']."'");
			
			$data_reg[]=$T_reg;
		}
	}
	
	
	echo json_encode($data_reg);
?>