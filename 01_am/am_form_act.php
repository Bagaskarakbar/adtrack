<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.max_kode_number");

$db->debug=true;

$db->BeginTrans();

// print_r($_POST);

$date=date("Y-m-d H:i:s");
$id_tc_pengajuan=max_kode_number("tc_pengajuan","id_tc_pengajuan");

if(isset($_POST["q4"]["npwp"])){
	$ArrDat=explode(";",$_POST["q4"]["npwp"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["q4"]["npwp"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/npwp/";
	$nama_file_asli="npwp".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$npwp=$dirFile.$nama_file_asli;
}

if(isset($_POST["q4"]["surat_ijin"])){
	$ArrDat=explode(";",$_POST["q4"]["surat_ijin"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["q4"]["surat_ijin"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/surat_ijin/";
	$nama_file_asli="surat_ijin".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$surat_ijin=$dirFile.$nama_file_asli;
}

if(isset($_POST["q4"]["tdp"])){
	$ArrDat=explode(";",$_POST["q4"]["tdp"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["q4"]["tdp"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/tdp/";
	$nama_file_asli="tdp".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$tdp=$dirFile.$nama_file_asli;
}

if(isset($_POST["q4"]["sk_direktur"])){
	$ArrDat=explode(";",$_POST["q4"]["sk_direktur"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["q4"]["sk_direktur"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/sk_direktur/";
	$nama_file_asli="sk_direktur".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$sk_direktur=$dirFile.$nama_file_asli;
}

if(isset($_POST["q4"]["spk_wo"])){
	$ArrDat=explode(";",$_POST["q4"]["spk_wo"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["q4"]["spk_wo"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/spk_wo/";
	$nama_file_asli="spk_wo".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$spk_wo=$dirFile.$nama_file_asli;
}

if(isset($_POST["q4"]["form_pengajuan"])){
	$ArrDat=explode(";",$_POST["q4"]["form_pengajuan"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["q4"]["form_pengajuan"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/form_pengajuan/";
	$nama_file_asli="form_pengajuan".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$form_pengajuan=$dirFile.$nama_file_asli;
}

$insertAM["nama_pelanggan"]=$_POST["q1"]["nama_pelanggan"];
$insertAM["id_dd_user"]=$_POST["q1"]["id_dd_user"];
$insertAM["id_mt_unit"]=$_POST["q1"]["unit"];
$insertAM["id_mt_jenis_pelanggan"]=$_POST["q1"]["jenis_pelanggan"];
$insertAM["id_mt_layanan"]=$_POST["q2"]["layanan"];
$insertAM["id_mt_bundling"]=$_POST["q2"]["bundling"];
$insertAM["id_mt_paket"]=$_POST["q2"]["paket_layanan"];
$insertAM["id_mt_jenis_project"]=$_POST["q2"]["jenis_projek"];
$insertAM["tgl_spk"]=$_POST["q2"]["tgl_spk"];
$insertAM["nomor"]=$_POST["q2"]["nomor"];
$insertAM["perihal"]=$_POST["q2"]["perihal"];
$insertAM["lama_kontrak"]=$_POST["q3"]["lama_kontrak"];
$insertAM["otc"]=$_POST["q3"]["jumlah_dana"];
$insertAM["term1"]=$_POST["q3"]["term1"];
$insertAM["term2"]=$_POST["q3"]["term2"];
$insertAM["term3"]=$_POST["q3"]["term3"];
$insertAM["term4"]=$_POST["q3"]["term4"];
$insertAM["term5"]=$_POST["q3"]["term5"];
$insertAM["term6"]=$_POST["q3"]["term6"];
$insertAM["tgl_input"]=$date;

$result = insert_tabel("tc_pengajuan", $insertAM);

$insertNPWP["id_tc_pengajuan"]=$id_tc_pengajuan;
$insertNPWP["url_dokumen"]=$npwp;
$insertNPWP["tg_input"]=$date;

if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertNPWP);

$insertSI["id_tc_pengajuan"]=$id_tc_pengajuan;
$insertSI["url_dokumen"]=$surat_ijin;
$insertSI["tg_input"]=$date;

if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSI);

$insertTDP["id_tc_pengajuan"]=$id_tc_pengajuan;
$insertTDP["url_dokumen"]=$tdp;
$insertTDP["tg_input"]=$date;

if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertTDP);

$insertSK["id_tc_pengajuan"]=$id_tc_pengajuan;
$insertSK["url_dokumen"]=$sk_direktur;
$insertSK["tg_input"]=$date;

if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSK);

$insertSPKWO["id_tc_pengajuan"]=$id_tc_pengajuan;
$insertSPKWO["url_dokumen"]=$spk_wo;
$insertSPKWO["tg_input"]=$date;

if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSPKWO);


$insertPengajuan["id_tc_pengajuan"]=$id_tc_pengajuan;
$insertPengajuan["url_dokumen"]=$form_pengajuan;
$insertPengajuan["tg_input"]=$date;

if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertPengajuan);

$db->CommitTrans($result!== false);

if($result){
  $data['code']=200;
}else{
  $data['code']=500;
}

echo json_encode($data);
?>
