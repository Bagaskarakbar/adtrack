<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($agama);
$agama["agama"] = $nama_agama;
$agama["input_tgl"] = $date;


if($validasi=="1"){
	$result = insert_tabel("dc_agama", $agama);	
}else if($validasi=="2"){
	$result = update_tabel("dc_agama", $agama, "WHERE id_dc_agama=$id_dc_agama");	
}else{
	$result = delete_tabel("dc_agama", "WHERE id_dc_agama=$id_dc_agama");	
}
//die;

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
