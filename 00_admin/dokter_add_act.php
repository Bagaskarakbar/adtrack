<?
//SHOW PHP ERROR
session_start();
include "../_lib/function/db.php";
include "../_lib/function/function.olah_tabel.php";
loadlib("function","function.max_kode_number");	
loadlib("function","function.max_kode_text");
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

		//$kode_dokter 	= max_kode_number("mt_karyawan","kode_dokter");
		$kode_dokter 	= max_kode_text("mt_karyawan","kode_dokter");
		$no_induk 		= max_kode_text("mt_karyawan","no_induk","");
		
		unset($insertMtKaryawan);
		$insertMtKaryawan["no_induk"] 			= $no_induk;
		$insertMtKaryawan["kode_dokter"] 		= $kode_dokter;
		$insertMtKaryawan["nama_pegawai"]		= $nama_pegawai;
		$insertMtKaryawan["kode_spesialisasi"] 	= $kode_spesialisasi;
		$insertMtKaryawan["kode_perusahaan_yankes"] 	= $kode_perusahaan;
		$insertMtKaryawan["kode_bagian"] 		= $kode_bagian;
		$insertMtKaryawan["url_foto_karyawan"] 	= $file;
		$insertMtKaryawan["status_dr"] 			= $status_dr;
		$insertMtKaryawan["telp"] 				= $telp;
		$insertMtKaryawan["email"] 				= $email;
		$insertMtKaryawan["alamat"] 			= $alamat;
		$result = insert_tabel("mt_karyawan", $insertMtKaryawan);
	
	
	//***********************************************************************************//

	// $result=false;
	// die();
		
	// $db->CommitTrans($result !== false);
	//////////////////////////////////////////////////////////////////////
	if($result){
	$data['code']='200';
	}else{
		$data['code']='500';
	}
	echo json_encode($data);


?>