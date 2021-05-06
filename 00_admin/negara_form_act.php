<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($negara);
$negara["nama_negara"] = $nama_negara;
$negara["inisial_negara"] = $inisial_negara;

$bank["input_tgl"] = $date;


if($validasi=="1"){
	$result = insert_tabel("dc_negara", $negara);	
}else if($validasi=="2"){
	$result = update_tabel("dc_negara", $negara, "WHERE id_dc_negara=$id_dc_negara");	
}else{
	$result = delete_tabel("dc_negara", "WHERE id_dc_negara=$id_dc_negara");	
}
//die;

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
