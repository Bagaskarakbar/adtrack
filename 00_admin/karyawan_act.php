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

		$foto_karyawan=$alamatimg.$nama_file_asli;
	}
//end foto handler
	$result = true;
	$db->BeginTrans();
	unset($insertNewKaryawan);
	$insertNewKaryawan["nama_pegawai"] = $nama_pegawai;
	$insertNewKaryawan["no_induk"] = $no_induk;
	
	if($jabatan=='50'){
		$kode_perawat 	= max_kode_text("mt_karyawan","kode_perawat");
		$insertNewKaryawan["kode_perawat"] = $kode_perawat;
	}
	
	$insertNewKaryawan["flag_tenaga_medis"] = $status;
	$insertNewKaryawan["kode_bagian"] = $kode_spesialisasi;
	$insertNewKaryawan["url_foto_karyawan"] = $foto_karyawan;
	$insertNewKaryawan["kode_jabatan"] = $jabatan;
	$insertNewKaryawan["id_dd_ptkp_pajak"] = $pajak;
		//$result=false;
	$result = insert_tabel("mt_karyawan", $insertNewKaryawan);
	$db->CommitTrans($result !== false);

	break;
	case "edit":
	if(isset($_POST["upload_foto_dokter"])){

		$ArrDat=explode(";",$_POST["upload_foto_dokter"]);
		$ArrDat1=explode("/",$ArrDat[0]);
		$typeFile=$ArrDat1[1];

		$rawData = $_POST['upload_foto_dokter'];
		list($type, $rawData) = explode(';', $rawData);
		list(, $rawData)      = explode(',', $rawData);
		$alamatimg="../_images/foto/foto_dokter/";
		$nama_file_asli="_FotoDokter".$nama_pegawai.date("YmdHis").	".".$typeFile;
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
		//$result=false;
	$result = update_tabel("mt_karyawan", $insertNewKaryawan,"WHERE no_induk = $no_induk");
	$db->CommitTrans($result !== false);
	break;
	case "delete":

	$result = true;
	$db->BeginTrans();
	$result = delete_tabel("mt_karyawan", "WHERE no_induk=$no_induk");
	$db->CommitTrans($result !== false);

	break;
}
if($result){
	$data['code']='200';
}else{
	$data['code']='500';
}
echo json_encode($data);

?>