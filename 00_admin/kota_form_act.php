<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
// GET KECAMATAN ////////////////////////////////////////////////////////
if ($id_dc_propinsi) {
	$sqlGetKec = "SELECT * from dc_propinsi where id_dc_propinsi=$id_dc_propinsi";

	$hasil =& $db->Execute($sqlGetKec);
	$id_dc_negara = $hasil->Fields('id_dc_negara');
}
// END ////////////////////////////////////////////////////////

$date=date("Y-m-d H:i:s");

unset($kota);
$kota["inisial_kota"] = $inisial_kota;
$kota["nama_kota"] = $nama_kota;
$kota["tgl_input"] = $date;

$kota["id_dc_propinsi"] = $id_dc_propinsi;
$kota["id_dc_negara"] = $id_dc_negara;


switch ($validasi) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "1":

		$result = true;
		$db->BeginTrans();
		$result = insert_tabel("dc_kota", $kota);	
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "2":

		$result = true;
		$db->BeginTrans();
		$result = update_tabel("dc_kota", $kota, "WHERE id_dc_kota=$id_dc_kota");	
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "3":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dc_kota", "WHERE id_dc_kota=$id_dc_kota");	
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
