<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
	// ==================== GET MR,REGIS, ===================//

	// $db->debug=true;
$input = json_decode(file_get_contents('php://input'),true);
if($input['act']==1){
	
	$H_dokter=read_tabel("mt_dokter_v","*","WHERE kd_bagian=".$input['kode_bagian']);
	$Count_dok=$H_dokter->_numOfRows;
	
	$arr['jml_dokter']=$Count_dok;
	
	while($T_dokter=$H_dokter->Fetchrow()){
		$arr['dokter'][]=$T_dokter;
	}
}else if($input['act']==2){
	
	$H_dokter=read_tabel("mt_karyawan AS a INNER JOIN mt_jadwal_dokter as b ON a.kode_dokter=b.kode_dokter","a.kode_dokter,b.kode_bagian, range_hari, jam_mulai, jam_akhir","WHERE b.kode_bagian=".$input['kode_bagian']." and b.kode_dokter=".$input['kode_dokter']);
	$Count_dok=$H_dokter->_numOfRows;
	
	$arr['jml_dokter']=$Count_dok;
	
	while($T_dokter=$H_dokter->Fetchrow()){
		$arr['jadwal_dokter'][]=$T_dokter;
	}
	
} else if($input['act']==3){

	$hari=$input['hari'];
	$role_dokter = $input['role_dokter'];
	
	$arr_hari[1]='senin';
	$arr_hari[2]='selasa';
	$arr_hari[3]='rabu';
	$arr_hari[4]='kamis';
	$arr_hari[5]='jumat';
	$arr_hari[6]='sabtu';
	$arr_hari[7]='minggu';
	
	$hariNow=$arr_hari[$hari];

	$H_dokter=read_tabel("mt_karyawan AS a INNER JOIN mt_jadwal_dokter as b ON a.kode_dokter=b.kode_dokter INNER JOIN mt_dokter_bagian as c ON a.kode_dokter=c.kode_dokter","a.kode_dokter,a.nama_pegawai,a.url_foto_karyawan,b.kode_bagian, range_hari, jam_mulai, jam_akhir","WHERE b.kode_bagian=".$input['kode_bagian']." and " .$hariNow. "='1'");
	$Count_dok=$H_dokter->_numOfRows;

	$arr['jml_dokter']=$Count_dok;
	
	while($T_dokter=$H_dokter->Fetchrow()){
		$arr['jadwal_dokter'][]=$T_dokter;
	}

}else{
	
	$hari=$input['hari'];
	
	$arr_hari[1]='senin';
	$arr_hari[2]='selasa';
	$arr_hari[3]='rabu';
	$arr_hari[4]='kamis';
	$arr_hari[5]='jumat';
	$arr_hari[6]='sabtu';
	$arr_hari[7]='minggu';
	
	$hariNow=$arr_hari[$hari];
	
	$H_dokter=read_tabel("mt_jadwal_dokter","jam_mulai,jam_akhir,waktu_periksa","WHERE kode_dokter=".$input['kode_dokter']." and ".$hariNow."='1'");
	$Count_dok=$H_dokter->_numOfRows;
	
	$arr['jml_jadwal']=$Count_dok;
	
	while($T_dokter=$H_dokter->Fetchrow()){
		$arr['wp_dokter'][]=$T_dokter;
	}
	
}


if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>