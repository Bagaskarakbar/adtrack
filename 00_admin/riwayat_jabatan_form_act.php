<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($jabatan);
$jabatan["instansi"] = $instansi;
$jabatan["kode_dokter"] = $kode;
$jabatan["tahun_jabatan"] = $tahun_jabatan;
$jabatan["kode_spesialisasi"] = $kode_spesialisasi;
$jabatan["tgl_input"] = $date;


if($validasi=="1"){
	$result = insert_tabel("mt_jabatan_dokter", $jabatan);	
}else if($validasi=="2"){
	$result = update_tabel("mt_jabatan_dokter", $jabatan, "WHERE id_mt_jabatan_dokter=$id_mt_jabatan_dokter");	
}else{
	$result = delete_tabel("mt_jabatan_dokter", "WHERE id_mt_jabatan_dokter=$id_mt_riwayat_dokter");	
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
