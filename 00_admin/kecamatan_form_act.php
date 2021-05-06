<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
// GET KECAMATAN ////////////////////////////////////////////////////////
if ($id_dc_kota) {
	$sqlGetKec = "SELECT * from dc_kota where id_dc_kota=$id_dc_kota";

	$hasil =& $db->Execute($sqlGetKec);
	$id_dc_propinsi = $hasil->Fields('id_dc_propinsi');
	$id_dc_negara = $hasil->Fields('id_dc_negara');
}
// END ////////////////////////////////////////////////////////

$date=date("Y-m-d H:i:s");

unset($kecamatan);
$kecamatan["inisial_kecamatan"] = $inisial_kecamatan;
$kecamatan["nama_kecamatan"] = $nama_kecamatan;
$kecamatan["tgl_input"] = $date;

$kecamatan["id_dc_kota"] = $id_dc_kota;
$kecamatan["id_dc_propinsi"] = $id_dc_propinsi;
$kecamatan["id_dc_negara"] = $id_dc_negara;


switch ($validasi) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "1":

		$result = true;
		$db->BeginTrans();
		$result = insert_tabel("dc_kecamatan", $kecamatan);	
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "2":

		$result = true;
		$db->BeginTrans();
		$result = update_tabel("dc_kecamatan", $kecamatan, "WHERE id_dc_kecamatan=$id_dc_kecamatan");	
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "3":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dc_kecamatan", "WHERE id_dc_kecamatan=$id_dc_kecamatan");	
		$db->CommitTrans($result !== false);

		break;

	}
//die;

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
