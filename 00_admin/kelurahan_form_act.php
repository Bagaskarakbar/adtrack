<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
// GET KECAMATAN ////////////////////////////////////////////////////////
if ($id_dc_kecamatan) {
	$sqlGetKec = "SELECT * from dc_kecamatan where id_dc_kecamatan=$id_dc_kecamatan";

	$hasil =& $db->Execute($sqlGetKec);
	$id_dc_kota = $hasil->Fields('id_dc_kota');
	$id_dc_propinsi = $hasil->Fields('id_dc_propinsi');
	$id_dc_negara = $hasil->Fields('id_dc_negara');
}
// END ////////////////////////////////////////////////////////

$date=date("Y-m-d H:i:s");

unset($kelurahan);
$kelurahan["id_dc_kecamatan"] = $id_dc_kecamatan;
$kelurahan["inisial_kelurahan"] = $inisial_kelurahan;
$kelurahan["nama_kelurahan"] = $nama_kelurahan;
$kelurahan["kode_pos"] = $kode_pos;
$kelurahan["tgl_input"] = $date;
$kelurahan["id_dc_kota"] = $id_dc_kota;
$kelurahan["id_dc_propinsi"] = $id_dc_propinsi;
$kelurahan["id_dc_negara"] = $id_dc_negara;

/* if($validasi=="1"){
	$result = insert_tabel("dc_kelurahan", $kelurahan);	
}else if($validasi=="2"){
	$result = update_tabel("dc_kelurahan", $kelurahan, "WHERE id_dc_kelurahan=$id_dc_kelurahan");	
}else{
	$result = delete_tabel("dc_kelurahan", "WHERE id_dc_kelurahan=$id_dc_kelurahan");	
} */

switch ($validasi) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "1":

		$result = true;
		$db->BeginTrans();
		$result = insert_tabel("dc_kelurahan", $kelurahan);	
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "2":

		$result = true;
		$db->BeginTrans();
		$result = update_tabel("dc_kelurahan", $kelurahan, "WHERE id_dc_kelurahan=$id_dc_kelurahan");	
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "3":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dc_kelurahan", "WHERE id_dc_kelurahan=$id_dc_kelurahan");	
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
