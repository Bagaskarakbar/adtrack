<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.max_kode_number");

// $db->debug=true;

// print_r($_POST["bin_npwp"]);

$db->BeginTrans();

$date=date("Y-m-d H:i:s");
$id_tc_pengajuan_npwp=$_POST["id_tc_pengajuan_npwp"];
$id_tc_pengajuan_si=$_POST["id_tc_pengajuan_si"];
$id_tc_pengajuan_tdp=$_POST["id_tc_pengajuan_tdp"];
$id_tc_pengajuan_sk_dir=$_POST["id_tc_pengajuan_sk_dir"];
$id_tc_pengajuan_spk_wo=$_POST["id_tc_pengajuan_spk_wo"];
$id_tc_pengajuan_form_pengajuan=$_POST["id_tc_pengajuan_form_pengajuan"];

if($_POST["bin_npwp"]!=''){
	$ArrDat=explode(";",$_POST["bin_npwp"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_npwp"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/npwp/";
	$nama_file_asli="npwp".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$npwp=$dirFile.$nama_file_asli;
}else{
	$npwp='';
}

if($_POST["bin_si"]!=''){
	$ArrDat=explode(";",$_POST["bin_si"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_si"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/surat_ijin/";
	$nama_file_asli="surat_ijin".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$surat_ijin=$dirFile.$nama_file_asli;
}else{
	$surat_ijin='';
}

if($_POST["bin_tdp"]!=''){
	$ArrDat=explode(";",$_POST["bin_tdp"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_tdp"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/tdp/";
	$nama_file_asli="tdp".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$tdp=$dirFile.$nama_file_asli;
}else{
	$tdp='';
}

if($_POST["bin_sk_dir"]!=''){
	$ArrDat=explode(";",$_POST["bin_sk_dir"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_sk_dir"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/sk_direktur/";
	$nama_file_asli="sk_direktur".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$sk_direktur=$dirFile.$nama_file_asli;
}else{
	$sk_direktur='';
}

if($_POST["bin_spk_wo"]!=''){
	$ArrDat=explode(";",$_POST["bin_spk_wo"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_spk_wo"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/spk_wo/";
	$nama_file_asli="spk_wo".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$spk_wo=$dirFile.$nama_file_asli;
}else{
	$spk_wo='';
}

if($_POST["bin_form_pengajuan"]!=''){
	$ArrDat=explode(";",$_POST["bin_form_pengajuan"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_form_pengajuan"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/form_pengajuan/";
	$nama_file_asli="form_pengajuan".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$form_pengajuan=$dirFile.$nama_file_asli;
}else{
	$form_pengajuan='';
}

if($npwp!=''){
	$insertNPWP["id_tc_pengajuan"]=$id_tc_pengajuan_npwp;
	$insertNPWP["id_mt_dokumen"]=1;
	$insertNPWP["url_dokumen"]=$npwp;
	$insertNPWP["tgl_input"]=$date;
	$result =insert_tabel("tc_pengajuan_dokumen", $insertNPWP);
}

if($surat_ijin!=''){
	$insertSI["id_tc_pengajuan"]=$id_tc_pengajuan_si;
	$insertSI["id_mt_dokumen"]=2;
	$insertSI["url_dokumen"]=$surat_ijin;
	$insertSI["tgl_input"]=$date;

	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSI);
}

if($tdp!=''){
	$insertTDP["id_tc_pengajuan"]=$id_tc_pengajuan_tdp;
	$insertTDP["id_mt_dokumen"]=3;
	$insertTDP["url_dokumen"]=$tdp;
	$insertTDP["tgl_input"]=$date;

	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertTDP);
}

if($sk_direktur!=''){
	$insertSK["id_tc_pengajuan"]=$id_tc_pengajuan_sk_dir;
	$insertSK["id_mt_dokumen"]=4;
	$insertSK["url_dokumen"]=$sk_direktur;
	$insertSK["tgl_input"]=$date;

	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSK);
}

if($spk_wo!=''){
	$insertSPKWO["id_tc_pengajuan"]=$id_tc_pengajuan_spk_wo;
	$insertSPKWO["id_mt_dokumen"]=5;
	$insertSPKWO["url_dokumen"]=$spk_wo;
	$insertSPKWO["tgl_input"]=$date;

	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSPKWO);
}

if($form_pengajuan!=''){
	$insertPengajuan["id_tc_pengajuan"]=$id_tc_pengajuan_form_pengajuan;
	$insertPengajuan["id_mt_dokumen"]=9;
	$insertPengajuan["url_dokumen"]=$form_pengajuan;
	$insertPengajuan["tgl_input"]=$date;

	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertPengajuan);
}

$db->CommitTrans($result!==false);

if($result){
  $data['code']=200;
}else{
  $data['code']=500;
}

echo json_encode($data);
?>
