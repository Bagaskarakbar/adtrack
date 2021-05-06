<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$module = $input['module'];
$typelab = $input['typelab'];
$kode_tarif = $input['kode_tarif'];
if($module == 1){
	if($typelab == 1){
		$sql_query = "
		SELECT * from mt_master_tarif
		where kode_bagian='050101' 
		and tingkatan=3";
	}
	elseif($typelab == 2){
		$sql_query = "
		SELECT * from mt_master_tarif
		where kode_bagian='050201' 
		and tingkatan=3";
	}
	elseif($typelab ==3){
		$sql_query = "
		SELECT * from mt_master_tarif
		where kode_bagian='050301' 
		and tingkatan=3";
	}	

	$runGetDataForRujukanLab = $db->Execute($sql_query);
	while($tempDataLab=$runGetDataForRujukanLab->fetchrow()){
		$dataRujukanLab['kode_tarif'] = $tempDataLab['kode_tarif'];
		$dataRujukanLab['kategori'] = $tempDataLab['nama_tarif'];
		$arr['dataRujukanLabKategori'][] = $dataRujukanLab;
	}
}
elseif($module == 2){
	$sql_query = "
	SELECT * from mt_master_tarif where referensi='$kode_tarif'
	";

	$runGetDataForSubKategoriLab = $db->Execute($sql_query);
	while($tempDataSubKategori = $runGetDataForSubKategoriLab->fetchrow()){
		$dataRujukanLabSubKategori['kode_tarif'] = $tempDataSubKategori['kode_tarif'];
		$dataRujukanLabSubKategori['kategori'] = $tempDataSubKategori['nama_tarif'];
		$arr['dataRujukanLabSubKategori'][] = $dataRujukanLabSubKategori;
	}
}
elseif($module == 3){
	if($typelab ==1){
		$sql_query = "
		SELECT a.*,b.nama_pegawai from mt_dokter_bagian a
		join mt_karyawan b on a.kode_dokter=b.kode_dokter
		where a.kode_bagian ='050101'
		";
	}
	elseif($typelab ==2){
		$sql_query = "
		SELECT a.*,b.nama_pegawai from mt_dokter_bagian a
		join mt_karyawan b on a.kode_dokter=b.kode_dokter
		where a.kode_bagian ='050201'
		";
	}
	elseif($typelab ==3){
		$sql_query = "
		SELECT a.*,b.nama_pegawai from mt_dokter_bagian a
		join mt_karyawan b on a.kode_dokter=b.kode_dokter
		where a.kode_bagian ='050301'
		";
	}

	$runGetDataForDokterLab = $db->Execute($sql_query);
	while($tempDataDokterLab = $runGetDataForDokterLab->fetchrow()){
		$dataRujukanDokterLab['kode_dokter'] = $tempDataDokterLab['kode_dokter'];
		$dataRujukanDokterLab['nama_dokter'] = $tempDataDokterLab['nama_pegawai'];
		$dataRujukanDokterLab['kode_bagian'] = $tempDataDokterLab['kode_bagian'];
		$arr['dataRujukanDokterLab'][] = $dataRujukanDokterLab;
	}
}
elseif($module ==4){
	$sql_query = "
	SELECT * from mt_master_tarif
	where kode_bagian='050301' 
	and tingkatan=5";

	$runGetDataForRujukanLab = $db->Execute($sql_query);
	while($tempDataLab=$runGetDataForRujukanLab->fetchrow()){
		$dataRujukanLab['kode_tarif'] = $tempDataLab['kode_tarif'];
		$dataRujukanLab['kategori'] = $tempDataLab['nama_tarif'];
		$arr['dataRujukanFis'][] = $dataRujukanLab;
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