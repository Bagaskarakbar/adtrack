<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.max_kode_number");

// $db->debug=true;

$db->BeginTrans();

$date=date("Y-m-d H:i:s");
$id_tc_pengajuan=max_kode_number("tc_pengajuan","id_tc_pengajuan");

// if($_POST["q4"]["npwp"]!=''){
// 	$ArrDat=explode(";",$_POST["q4"]["npwp"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST["q4"]["npwp"];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$dirFile="../assets/docs/npwp/";
// 	$nama_file_asli="npwp".date("YmdHis").".".$typeFile;
// 	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));
//
// 	$npwp=$dirFile.$nama_file_asli;
// }else{
// 	$npwp='';
// }
//
// if($_POST["q4"]["surat_ijin"]!=''){
// 	$ArrDat=explode(";",$_POST["q4"]["surat_ijin"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST["q4"]["surat_ijin"];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$dirFile="../assets/docs/surat_ijin/";
// 	$nama_file_asli="surat_ijin".date("YmdHis").".".$typeFile;
// 	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));
//
// 	$surat_ijin=$dirFile.$nama_file_asli;
// }else{
// 	$surat_ijin='';
// }
//
// if($_POST["q4"]["tdp"]!=''){
// 	$ArrDat=explode(";",$_POST["q4"]["tdp"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST["q4"]["tdp"];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$dirFile="../assets/docs/tdp/";
// 	$nama_file_asli="tdp".date("YmdHis").".".$typeFile;
// 	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));
//
// 	$tdp=$dirFile.$nama_file_asli;
// }else{
// 	$tdp='';
// }
//
// if($_POST["q4"]["sk_direktur"]!=''){
// 	$ArrDat=explode(";",$_POST["q4"]["sk_direktur"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST["q4"]["sk_direktur"];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$dirFile="../assets/docs/sk_direktur/";
// 	$nama_file_asli="sk_direktur".date("YmdHis").".".$typeFile;
// 	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));
//
// 	$sk_direktur=$dirFile.$nama_file_asli;
// }else{
// 	$sk_direktur='';
// }
//
// if($_POST["q4"]["spk_wo"]!=''){
// 	$ArrDat=explode(";",$_POST["q4"]["spk_wo"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST["q4"]["spk_wo"];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$dirFile="../assets/docs/spk_wo/";
// 	$nama_file_asli="spk_wo".date("YmdHis").".".$typeFile;
// 	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));
//
// 	$spk_wo=$dirFile.$nama_file_asli;
// }else{
// 	$spk_wo='';
// }
//
// if($_POST["q4"]["form_pengajuan"]!=''){
// 	$ArrDat=explode(";",$_POST["q4"]["form_pengajuan"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST["q4"]["form_pengajuan"];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$dirFile="../assets/docs/form_pengajuan/";
// 	$nama_file_asli="form_pengajuan".date("YmdHis").".".$typeFile;
// 	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));
//
// 	$form_pengajuan=$dirFile.$nama_file_asli;
// }else{
// 	$form_pengajuan='';
// }

//insert ke am
$insertAM["nama_pelanggan"]=$_POST["q1"]["nama_pelanggan"];
$insertAM["id_dd_user"]=$_POST["q1"]["id_dd_user"];
$insertAM["id_mt_unit"]=$_POST["q1"]["unit"];
$insertAM["perihal"]=$_POST["q1"]["keterangan"];
$insertAM["id_mt_jenis_pelanggan"]=$_POST["q1"]["jenis_pelanggan"];
$insertAM["id_mt_layanan"]=$_POST["q2"]["layanan"];
$insertAM["id_mt_bundling"]=$_POST["q2"]["bundling"];
$insertAM["id_mt_paket"]=$_POST["q2"]["paket_layanan"];
$insertAM["id_mt_jenis_project"]=$_POST["q2"]["jenis_projek"];
$insertAM["tgl_spk"]=$_POST["q2"]["tgl_spk"];
$insertAM["nomor"]=$_POST["q2"]["nomor"];
$insertAM["id_mt_channel"]=$_POST["q2"]["channel"];
$insertAM["lama_kontrak"]=$_POST["q3"]["lama_kontrak"];
$insertAM["otc"]=$_POST["q3"]["jumlah_dana"];
$insertAM["transaksional_ri"]=$_POST["q3"]["transaksional_ri"];
$insertAM["transaksional_rj"]=$_POST["q3"]["transaksional_rj"];
$insertAM["minimum_caps"]=$_POST["q3"]["min_caps"];
$insertAM["kso_flat"]=$_POST["q3"]["kso"];
$insertAM["tgl_input"]=$date;

$result = insert_tabel("tc_pengajuan", $insertAM);

//term1
if($_POST["q3"]["term1"]!=""){
  $insertTerm1["nominal_term"]=$_POST["q3"]["term1"];
  $insertTerm1["id_mt_term"]=1;
  $insertTerm1["tgl_input"]=$date;
  $insertTerm1["id_tc_pengajuan"]=$id_tc_pengajuan;

  if($result) $result =insert_tabel("tc_term", $insertTerm1);
}

//term2
if($_POST["q3"]["term2"]!=""){
  $insertTerm2["nominal_term"]=$_POST["q3"]["term2"];
  $insertTerm2["id_mt_term"]=2;
  $insertTerm2["tgl_input"]=$date;
  $insertTerm2["id_tc_pengajuan"]=$id_tc_pengajuan;

  if($result) $result =insert_tabel("tc_term", $insertTerm2);
}

//term3
if($_POST["q3"]["term3"]!=""){
  $insertTerm3["nominal_term"]=$_POST["q3"]["term3"];
  $insertTerm3["id_mt_term"]=3;
  $insertTerm3["tgl_input"]=$date;
  $insertTerm3["id_tc_pengajuan"]=$id_tc_pengajuan;

  if($result) $result =insert_tabel("tc_term", $insertTerm3);
}

//term4
if($_POST["q3"]["term4"]!=""){
  $insertTerm4["nominal_term"]=$_POST["q3"]["term4"];
  $insertTerm4["id_mt_term"]=4;
  $insertTerm4["tgl_input"]=$date;
  $insertTerm4["id_tc_pengajuan"]=$id_tc_pengajuan;

  if($result) $result =insert_tabel("tc_term", $insertTerm4);
}

//term5
if($_POST["q3"]["term5"]!=""){
  $insertTerm5["nominal_term"]=$_POST["q3"]["term5"];
  $insertTerm5["id_mt_term"]=5;
  $insertTerm5["tgl_input"]=$date;
  $insertTerm5["id_tc_pengajuan"]=$id_tc_pengajuan;

  if($result) $result =insert_tabel("tc_term", $insertTerm5);
}

//term6
if($_POST["q3"]["term6"]!=""){
  $insertTerm6["nominal_term"]=$_POST["q3"]["term6"];
  $insertTerm6["id_mt_term"]=6;
  $insertTerm6["tgl_input"]=$date;
  $insertTerm6["id_tc_pengajuan"]=$id_tc_pengajuan;

  if($result) $result =insert_tabel("tc_term", $insertTerm6);
}

// if($npwp!=''){
// 	$insertNPWP["id_tc_pengajuan"]=$id_tc_pengajuan;
// 	$insertNPWP["id_mt_dokumen"]=1;
// 	$insertNPWP["url_dokumen"]=$npwp;
// 	$insertNPWP["tgl_input"]=$date;
//
// 	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertNPWP);
// }
//
// if($surat_ijin!=''){
// 	$insertSI["id_tc_pengajuan"]=$id_tc_pengajuan;
// 	$insertSI["id_mt_dokumen"]=2;
// 	$insertSI["url_dokumen"]=$surat_ijin;
// 	$insertSI["tgl_input"]=$date;
//
// 	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSI);
// }
//
// if($tdp!=''){
// 	$insertTDP["id_tc_pengajuan"]=$id_tc_pengajuan;
// 	$insertTDP["id_mt_dokumen"]=3;
// 	$insertTDP["url_dokumen"]=$tdp;
// 	$insertTDP["tgl_input"]=$date;
//
// 	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertTDP);
// }
//
// if($sk_direktur!=''){
// 	$insertSK["id_tc_pengajuan"]=$id_tc_pengajuan;
// 	$insertSK["id_mt_dokumen"]=4;
// 	$insertSK["url_dokumen"]=$sk_direktur;
// 	$insertSK["tgl_input"]=$date;
//
// 	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSK);
// }
//
// if($spk_wo!=''){
// 	$insertSPKWO["id_tc_pengajuan"]=$id_tc_pengajuan;
// 	$insertSPKWO["id_mt_dokumen"]=5;
// 	$insertSPKWO["url_dokumen"]=$spk_wo;
// 	$insertSPKWO["tgl_input"]=$date;
//
// 	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertSPKWO);
// }
//
// if($form_pengajuan!=''){
// 	$insertPengajuan["id_tc_pengajuan"]=$id_tc_pengajuan;
// 	$insertPengajuan["id_mt_dokumen"]=9;
// 	$insertPengajuan["url_dokumen"]=$form_pengajuan;
// 	$insertPengajuan["tgl_input"]=$date;
//
// 	if($result) $result =insert_tabel("tc_pengajuan_dokumen", $insertPengajuan);
// }

$db->CommitTrans($result!==false);

if($result){
  $data['code']=200;
}else{
  $data['code']=500;
}

echo json_encode($data);
?>
