<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");

$db->debug=true;

$db->BeginTrans();

// print_r($_POST);

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

$insertAM["nama_pelanggan"]=$_POST["q1"]["nama_pelanggan"];
// $insertAM[""]=$_POST["nama_am"];
// $insertAM[""]=$_POST["unit"];
// $insertAM[""]=$_POST["jenis_pelanggan"];
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
