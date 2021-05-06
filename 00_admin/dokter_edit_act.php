<?
//SHOW PHP ERROR
session_start();
include "../_lib/function/db.php";
include "../_lib/function/function.olah_tabel.php";
loadlib("function","function.max_kode_number");	
// $db->debug=true;
//Author : Apepullah


//$kode_bagian=baca_tabel("mt_spesialisasi_dokter","kode_bagian","WHERE kode_spesialisasi='".$kode_spesialisasi."'");

	
	// /***************************** UPLOAD FOTO*****************************************//
	if(isset($_POST["upload_foto_dokter"])){
		
		$ArrDat=explode(";",$_POST["upload_foto_dokter"]);
		$ArrDat1=explode("/",$ArrDat[0]);
		$typeFile=$ArrDat1[1];

		$rawData = $_POST['upload_foto_dokter'];
		list($type, $rawData) = explode(';', $rawData);
		list(, $rawData)      = explode(',', $rawData);
		$alamatimg="../_images/foto/foto_dokter/";
		$nama_file_asli="_FotoDokter".$nama_pegawai.date("YmdHis").".".$typeFile;
		file_put_contents($alamatimg.$nama_file_asli, base64_decode($rawData));

		$file=$alamatimg.$nama_file_asli;
	}
	
	//***********************************************************************************//

		
		unset($editMtKaryawan);
		$editMtKaryawan["nama_pegawai"]			= $nama_pegawai;
		/*$editMtKaryawan["kode_spesialisasi"] 	= $kode_spesialisasi;
		$editMtKaryawan["kode_bagian"] 			= $kode_bagian;
		$editMtKaryawan["kode_perusahaan_yankes"] 	= $kode_perusahaan;
		$editMtKaryawan["flag_tenaga_medis"] 	= $flag_tenaga_medis;
		$editMtKaryawan["status_dr"] 			= $status_dr;
		$editMtKaryawan["telp"] 				= $telp;
		$editMtKaryawan["email"] 				= $email;
		$editMtKaryawan["alamat"] 				= $alamat;*/
		if(isset($file)){
			$editMtKaryawan["url_foto_karyawan"] 	= $file;	
		}

		$result = update_tabel("mt_karyawan", $editMtKaryawan, "WHERE  id_mt_karyawan='$kode_dokter'");
	
	//***********************************************************************************//
	/*	unset($editDokterBagian);
		$editDokterBagian["kode_bagian"]		= $kode_bagian;
		$editDokterBagian["kd_bagian"]			= $kode_bagian;
		$editDokterBagian["fungsi_dokter"] 		= $jenis_dokter;
		
	if($result) $result = update_tabel("mt_dokter_bagian", $editDokterBagian, "WHERE  kode_dokter='$kode_dokter'");*/
	
	//	***********************************************************************************//
		/*unset($editDokterDetail);
		$editDokterDetail["no_izin_praktek"]	= $no_izin_praktek;
		$editDokterDetail["id_dc_propinsi"]		= $id_dc_propinsi;
		$editDokterDetail["id_dc_kota"]			= $kota;
		$editDokterDetail["status_dokter"] 		= $status_dr;
		$editDokterDetail["kode_bagian"] 		= $kode_bagian;
		
	if($result) $result = update_tabel("mt_dokter_detail", $editDokterDetail, "WHERE  kode_dokter='$kode_dokter'");*/
	
	// $result=false;
	// die();
	//***********************************************************************************//
	$db->CommitTrans($result !== false);
	
		
	//////////////////////////////////////////////////////////////////////
	if($result){
	$data['code']='200';
	}else{
		$data['code']='500';
	}
	echo json_encode($data);


?>