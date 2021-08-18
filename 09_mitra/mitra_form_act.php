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
// $db->debug=true;

$db->BeginTrans();

$date=date("Y-m-d H:i:s");
$id_mt_dokumen=$_POST["jenis_dokumen"];
$keterangan=$_POST["keterangan_dokumen"];

if($id_mt_dokumen==19){
	$id_tc_transaksi_perintah_tagih=$_POST["id_tc_transaksi"];
	$bin_perintah_tagih=$_POST["dokumen_mitra"];
}else if($id_mt_dokumen==25){
	$id_tc_transaksi_kwitansi=$_POST["id_tc_transaksi"];
	$bin_kwitansi=$_POST["dokumen_mitra"];
}else{
	$id_tc_transaksi_faktur_pajak=$_POST["id_tc_transaksi"];
	$bin_faktur_pajak=$_POST["dokumen_mitra"];
}

// $id_tc_transaksi_perintah_tagih=$_POST["id_tc_transaksi_perintah_tagih"];
// $id_tc_transaksi_kwitansi=$_POST["id_tc_transaksi_kwitansi"];
// $id_tc_transaksi_faktur_pajak=$_POST["id_tc_transaksi_faktur_pajak"];
// $bin_perintah_tagih=$_POST["bin_perintah_tagih"];
// $bin_kwitansi=$_POST["bin_kwitansi"];
// $bin_faktur_pajak=$_POST["bin_faktur_pajak"];

//prepare files
if(isset($bin_perintah_tagih)){
	$ArrDat=explode(";",$bin_perintah_tagih);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $bin_perintah_tagih;
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/perintah_tagih/";
	$nama_file_asli="perintah_tagih".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$perintah_tagih=$dirFile.$nama_file_asli;
	if($case==""){
		$case="perintah_tagih";
	}else{
		$case="update";
	}
	
}

if(isset($bin_kwitansi)){
	$ArrDat=explode(";",$bin_kwitansi);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $bin_kwitansi;
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/kwitansi/";
	$nama_file_asli="kwitansi".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$kwitansi=$dirFile.$nama_file_asli;
	if($case==""){
		$case="kwitansi";
	}else{
		$case="update";
	}
}

if(isset($bin_faktur_pajak)){
	$ArrDat=explode(";",$bin_faktur_pajak);
	$ArrDat1=explode("/",$ArrDat[0]);
	$typeFile=$ArrDat1[1];

	$rawData = $bin_faktur_pajak;
	list($type, $rawData) = explode(';', $rawData);
	list(, $rawData)      = explode(',', $rawData);
	$dirFile="../assets/docs/faktur_pajak/";
	$nama_file_asli="faktur_pajak".date("YmdHis").".".$typeFile;
	file_put_contents($dirFile.$nama_file_asli, base64_decode($rawData));

	$faktur_pajak=$dirFile.$nama_file_asli;
	if($case==""){
		$case="faktur_pajak";
	}else{
		$case="update";
	}
}

//upload to db
switch($case){
	case "perintah_tagih":
		$insertPerintahTagih["id_tc_transaksi"]=$id_tc_transaksi_perintah_tagih;
		$insertPerintahTagih["id_mt_dokumen"]=$id_mt_dokumen;
		$insertPerintahTagih["url_dokumen"]=$perintah_tagih;
		$insertPerintahTagih["keterangan"]=$keterangan;
		$insertPerintahTagih["tg_input"]=$date;
		$result = insert_tabel("tc_transaksi_dokumen", $insertPerintahTagih);

		$db->CommitTrans($result!==false);
	break;
	case "kwitansi":
		$insertKwitansi["id_tc_transaksi"]=$id_tc_transaksi_kwitansi;
		$insertKwitansi["id_mt_dokumen"]=$id_mt_dokumen;
		$insertKwitansi["url_dokumen"]=$kwitansi;
		$insertKwitansi["keterangan"]=$keterangan;
		$insertKwitansi["tg_input"]=$date;
		$result = insert_tabel("tc_transaksi_dokumen", $insertKwitansi);

		$db->CommitTrans($result!==false);
	break;
	case "faktur_pajak":
		$insertFakturPajak["id_tc_transaksi"]=$id_tc_transaksi_faktur_pajak;
		$insertFakturPajak["id_mt_dokumen"]=$id_mt_dokumen;
		$insertFakturPajak["url_dokumen"]=$faktur_pajak;
		$insertFakturPajak["keterangan"]=$keterangan;
		$insertFakturPajak["tg_input"]=$date;
		$result = insert_tabel("tc_transaksi_dokumen", $insertFakturPajak);

		$db->CommitTrans($result!==false);
	break;
	case "update":
		unset($updateDokumen);

		$updateDokumen["id_mt_dokumen"]=$id_mt_dokumen;
		$updateDokumen["tg_input"]=$date;
		$updateDokumen["keterangan"]=$keterangan;

		if(isset($perintah_tagih)){
			$updateDokumen["url_dokumen"]=$perintah_tagih;
		}else if(isset($kwitansi)){
			$updateDokumen["url_dokumen"]=$kwitansi;
		}else if(isset($faktur_pajak)){
			$updateDokumen["url_dokumen"]=$faktur_pajak;
		}

		$result = update_tabel("tc_transaksi_dokumen", $updateDokumen,"WHERE id_tc_transaksi_dokumen=$id_dokumen");
		$db->CommitTrans($result !== false);
	break;
	case "delete":
		$result = delete_tabel("tc_transaksi_dokumen", "WHERE id_tc_transaksi_dokumen=$id_dokumen");
		$db->CommitTrans($result !== false);
	break;
}

// if($perintah_tagih!=false){
// 	$insertPerintahTagih["id_tc_transaksi"]=$id_tc_transaksi_perintah_tagih;
// 	$insertPerintahTagih["id_mt_dokumen"]=19;
// 	$insertPerintahTagih["url_dokumen"]=$perintah_tagih;
// 	$insertPerintahTagih["tg_input"]=$date;
// 	$result = insert_tabel("tc_transaksi_dokumen", $insertPerintahTagih);
// }

// if($kwitansi!=false){
// 	$insertKwitansi["id_tc_transaksi"]=$id_tc_transaksi_kwitansi;
// 	$insertKwitansi["id_mt_dokumen"]=25;
// 	$insertKwitansi["url_dokumen"]=$kwitansi;
// 	$insertKwitansi["tg_input"]=$date;
// 	$result = insert_tabel("tc_transaksi_dokumen", $insertKwitansi);
// 	if($result) $result =insert_tabel("tc_transaksi_dokumen", $insertKwitansi);
// }

// if($faktur_pajak!=false){
// 	$insertFakturPajak["id_tc_transaksi"]=$id_tc_transaksi_faktur_pajak;
// 	$insertFakturPajak["id_mt_dokumen"]=26;
// 	$insertFakturPajak["url_dokumen"]=$faktur_pajak;
// 	$insertFakturPajak["tg_input"]=$date;
// 	$result = insert_tabel("tc_transaksi_dokumen", $insertFakturPajak);
// 	if($result) $result =insert_tabel("tc_transaksi_dokumen", $insertFakturPajak);
// }

// $db->CommitTrans($result!==false);

if($result){
  $data['code']=200;
}else{
  $data['code']=500;
}

echo json_encode($data);
?>
