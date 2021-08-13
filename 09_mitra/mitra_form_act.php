<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.max_kode_number");

// $db->debug=true;

// print_r($_POST["bin_perintah_tagih"]);

$db->BeginTrans();

$date=date("Y-m-d H:i:s");
$id_tc_transaksi_perintah_tagih=$_POST["id_tc_transaksi_perintah_tagih"];
$id_tc_transaksi_kwitansi=$_POST["id_tc_transaksi_kwitansi"];
$id_tc_transaksi_faktur_pajak=$_POST["id_tc_transaksi_faktur_pajak"];

//prepare files
if($_POST["bin_perintah_tagih"]!=''){
	$ArrDat=explode(";",$_POST["bin_perintah_tagih"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_perintah_tagih"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/perintah_tagih/";
	$nama_file_asli="perintah_tagih".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$perintah_tagih=$dirFile.$nama_file_asli;
}else{
	$perintah_tagih='';
}

if($_POST["bin_kwitansi"]!=''){
	$ArrDat=explode(";",$_POST["bin_kwitansi"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_kwitansi"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/kwitansi/";
	$nama_file_asli="kwitansi".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$kwitansi=$dirFile.$nama_file_asli;
}else{
	$kwitansi='';
}

if($_POST["bin_faktur_pajak"]!=''){
	$ArrDat=explode(";",$_POST["bin_faktur_pajak"]);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $_POST["bin_faktur_pajak"];
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/faktur_pajak/";
	$nama_file_asli="faktur_pajak".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$faktur_pajak=$dirFile.$nama_file_asli;
}else{
	$faktur_pajak='';
}

//upload to db
if($perintah_tagih!=''){
	$insertPerintahTagih["id_tc_transaksi"]=$id_tc_transaksi_perintah_tagih;
	$insertPerintahTagih["id_mt_dokumen"]=19;
	$insertPerintahTagih["url_dokumen"]=$perintah_tagih;
	$insertPerintahTagih["tg_input"]=$date;
	$result =insert_tabel("tc_transaksi_dokumen", $insertPerintahTagih);
}

if($kwitansi!=''){
	$insertKwitansi["id_tc_transaksi"]=$id_tc_transaksi_kwitansi;
	$insertKwitansi["id_mt_dokumen"]=25;
	$insertKwitansi["url_dokumen"]=$kwitansi;
	$insertKwitansi["tg_input"]=$date;

	if($result) $result =insert_tabel("tc_transaksi_dokumen", $insertKwitansi);
}

if($faktur_pajak!=''){
	$insertFakturPajak["id_tc_transaksi"]=$id_tc_transaksi_faktur_pajak;
	$insertFakturPajak["id_mt_dokumen"]=26;
	$insertFakturPajak["url_dokumen"]=$faktur_pajak;
	$insertFakturPajak["tg_input"]=$date;

	if($result) $result =insert_tabel("tc_transaksi_dokumen", $insertFakturPajak);
}

$db->CommitTrans($result!==false);

if($result){
  $data['code']=200;
}else{
  $data['code']=500;
}

echo json_encode($data);
?>
