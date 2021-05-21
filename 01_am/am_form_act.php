<?
session_start();
require_once("../../../_lib/function/db.php");
loadlib("function","function.olah_tabel");

$db->debug=true;

$db->BeginTrans();

$date=date("Y-m-d H:i:s");
// $judul=$_POST["judulBerita"];
// $berita=$_POST["isiBerita"];

// if(isset($_POST["foto"])){
// 	$ArrDat=explode(";",$_POST["foto"]);
// 	$ArrDat1=explode("/",$ArrDat[0]);
// 	$typeFile=$ArrDat1[1];
//
// 	$rawData = $_POST['foto'];
// 	list($type, $rawData) = explode(';', $rawData);
// 	list(, $rawData)      = explode(',', $rawData);
// 	$alamatimg="../assets/img/banner_berita/";
// 	$nama_file_asli=date("YmdHis").".".$typeFile;
// 	file_put_contents($alamatimg.$nama_file_asli, base64_decode($rawData));
//
// 	$file=$alamatimg.$nama_file_asli;
// }

$insertAM["nama_pelanggan"]=$_POST["nama_pelanggan"];
// $insertAM[""]=$_POST["nama_am"];
// $insertAM[""]=$_POST["unit"];
// $insertAM[""]=$_POST["jenis_pelanggan"];
$insertAM["id_mt_layanan"]=$_POST["layanan"];
$insertAM["id_mt_bundling"]=$_POST["bundling"];
$insertAM["id_mt_paket"]=$_POST["paket_layanan"];
$insertAM["id_mt_jenis_project"]=$_POST["jenis_projek"];
$insertAM["tgl_spk"]=$_POST["tgl_spk"];
$insertAM["nomor"]=$_POST["nomor"];
$insertAM["perihal"]=$_POST["perihal"];
$insertAM["lama_kontrak"]=$_POST["lama_kontrak"];
$insertAM["tgl_input"]=$date;
// $insertAM["foto_berita"]=$file;
$result = insert_tabel("tc_pengajuan", $insertAM);

$db->CommitTrans($result!== false);

if($result){
  $data['code']=200;
}else{
  $data['code']=500;
}

echo json_encode($data);
?>
