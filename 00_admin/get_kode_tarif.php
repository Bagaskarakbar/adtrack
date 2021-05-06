<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.uang");
include('../_lib/function/function.pilihan_list.php');
loadlib("function","function.max_kode_number");	
loadlib("function","function.max_kode_text");

//$db->debug=true;

$kode_referensi=baca_tabel('mt_master_tarif','max(urutan)',"where kode_bagian='$kode_bagian' and tingkatan=5");

//$kode_dokter 	= max_kode_number("mt_karyawan","kode_dokter");
//$kode_referensi 	= max_kode_number("mt_master_tarif","urutan","where tingkatan=5");
//$kode_referensi 	= max_kode_text("mt_master_tarif","urutan","where tingkatan=5");



if($kode_referensi==""){
	$kode_tarif="".$kode_bagian."001";
	$kode_tarif_plus=$kode_tarif;
	$urutan="001";
}else{
	$kode_tarif="".$kode_bagian."$kode_referensi";
	$kode_tarif_plus=$kode_tarif+1;
	$urutan=$kode_referensi+1;
}
//$kode_referensi1="".$kode_bagian."001";
?>
<input class="form-control" type="text" value="<?= $kode_tarif_plus ?>" name="kode_tarif" tabindex="2" required="required"/ readonly>
<input class="form-control" type="hidden" value="<?= $urutan ?>" name="urutan" tabindex="2" required="required" />