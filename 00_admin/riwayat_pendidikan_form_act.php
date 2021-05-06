<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($pendidikan);
$pendidikan["nama_instansi_pendidikan"] = $instansi;
$pendidikan["kode_dokter"] = $kode;
$pendidikan["tahun_mulai"] = $tahun_masuk;
$pendidikan["tahun_lulus"] = $tahun_selesai;
$pendidikan["jurusan"] = $jurusan;
$pendidikan["gelar"] = $gelar;
$pendidikan["tgl_input"] = $date;


if($validasi=="1"){
	$result = insert_tabel("mt_pendidikan", $pendidikan);	
}else if($validasi=="2"){
	$result = update_tabel("mt_pendidikan", $pendidikan, "WHERE id_mt_pendidikan=$id_mt_pendidikan");	
}else{
	$result = delete_tabel("mt_pendidikan", "WHERE id_mt_pendidikan=$id_mt_pendidikan");	
}
//die;
$db->CommitTrans($result!== false);

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
