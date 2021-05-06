<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($bank);
$bank["nama_bank_sink"] = $nama_bank_sink;
$bank["nama_bank"] = $nama_bank;
$bank["no_rekening"] = $no_rekening;
$bank["alamat"] = $alamat;
$bank["kota"] = $kota;
$bank["input_tgl"] = $date;


if($validasi=="1"){
	$result = insert_tabel("dd_bank", $bank);	
}else if($validasi=="2"){
	$result = update_tabel("dd_bank", $bank, "WHERE id_dd_bank=$id_dd_bank");	
}else{
	$result = delete_tabel("dd_bank", "WHERE id_dd_bank=$id_dd_bank");	
}
//die;

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
