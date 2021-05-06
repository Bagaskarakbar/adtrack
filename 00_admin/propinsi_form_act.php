<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($propinsi);
$propinsi["nama_propinsi"] = $nama_propinsi;
$propinsi["inisial_propinsi"] = $inisial_propinsi;
$propinsi["id_dc_negara"] = 1;
$propinsi["tgl_input"] = $date;


if($validasi=="1"){
	$result = insert_tabel("dc_propinsi", $propinsi);	
}else if($validasi=="2"){
	$result = update_tabel("dc_propinsi", $propinsi, "WHERE id_dc_propinsi=$id_dc_propinsi");	
}else{
	$result = delete_tabel("dc_propinsi", "WHERE id_dc_propinsi=$id_dc_propinsi");	
}
//die;

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
