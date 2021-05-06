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

unset($MtBagian);
$MtBagian["kode_bagian"] = $kode_bagian;
$MtBagian["nama_bagian"] = $nama_bagian;
$MtBagian["group_bag"] = $group_bag;
$MtBagian["validasi"] = $nama_validasi;
$MtBagian["status_aktif"] = $status_aktif;
$MtBagian["kode_rs"] = $kode_rs;
$MtBagian["pelayanan"] = $pelayanan;


switch ($validasi) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "1":

		$result = true;
		$db->BeginTrans();
		$result = insert_tabel("mt_bagian", $MtBagian);	
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "2":

		$result = true;
		$db->BeginTrans();
		$result = update_tabel("mt_bagian", $MtBagian, "WHERE id_mt_bagian=$id_mt_bagian");	
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "3":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("mt_bagian", "WHERE id_mt_bagian=$id_mt_bagian");	
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
