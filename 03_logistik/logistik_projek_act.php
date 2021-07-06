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
	
	if(isset($_POST["dokumen"])){

		$ArrDat=explode(";",$_POST["dokumen"]);
		$ArrDat1=explode("/",$ArrDat[0]);
		$typeFile=$ArrDat1[1];

		$rawData = $_POST['dokumen'];
		list($type, $rawData) = explode(';', $rawData);
		list(, $rawData)      = explode(',', $rawData);
		$dirFile="../assets/docs/po_mitra/";
		$nama_file_asli="po_mitra".date("YmdHis").".".$typeFile;
		file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

		$dokumen=$dirFile.$nama_file_asli;
	}
	
	
//end foto handler
	$result = true;
	$db->BeginTrans();
	unset($insertLogistik);
	$insertLogistik["tgl_input"]			= $tgl_input;
	$insertLogistik["keterangan"] 			= $keterangan;
	$insertLogistik["keterangan_am_piss"] 	= $keterangan_am_piss;
	$insertLogistik["id_dd_user"] 			= $id_dd_user;
	$insertLogistik["id_tc_transaksi"] 		= $id_tc_transaksi;
	
		//$result=false;
	$result = insert_tabel("tc_logistik", $insertLogistik);
	
	unset($insertDok);
	$insertDok["tgl_input"]			= date("Y-m-d H:i:s");
	$insertDok["id_tc_pengajuan"]	= $id_tc_pengajuan;
	$insertDok["id_mt_dokumen"]		= 10;
	$insertDok["url_dokumen"]		= $dokumen;
	if($result)$result = insert_tabel("tc_pengajuan_dokumen", $insertDok);
	
	
	$db->CommitTrans($result !== false);

	break;
	/* case "edit":
	if(isset($_POST["foto_karyawan"])){

		$ArrDat=explode(";",$_POST["foto_karyawan"]);
		$ArrDat1=explode("/",$ArrDat[0]);
		$typeFile=$ArrDat1[1];

		$rawData = $_POST['foto_karyawan'];
		list($type, $rawData) = explode(';', $rawData);
		list(, $rawData)      = explode(',', $rawData);
		$alamatimg="../_images/foto/foto_dokter/";
		$nama_file_asli="_FotoKaryawan".$nama_pegawai.date("YmdHis").	".".$typeFile;
		file_put_contents($alamatimg.$nama_file_asli, base64_decode($rawData));

		$foto_karyawan=$alamatimg.$nama_file_asli;
	}
//end foto handler
	$result = true;
	$db->BeginTrans();
	unset($insertNewKaryawan);
	$insertNewKaryawan["nama_pegawai"] = $nama_pegawai;
	$insertNewKaryawan["no_induk"] = $no_induk;
	$insertNewKaryawan["flag_tenaga_medis"] = $status;
	$insertNewKaryawan["kode_bagian"] = $kode_spesialisasi;
	if(isset($foto_karyawan)){
		$insertNewKaryawan["url_foto_karyawan"] = $foto_karyawan;
	}
	$insertNewKaryawan["kode_jabatan"] = $jabatan;
	$insertNewKaryawan["id_dd_ptkp_pajak"] = $pajak;
	$result=true;
	$result = update_tabel("mt_karyawan", $insertNewKaryawan,"WHERE no_induk = $no_induk");
	$db->CommitTrans($result !== false);
	break;
	
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