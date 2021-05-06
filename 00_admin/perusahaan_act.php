<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.form_wilayah");
loadlib("function","function.max_kode_number");
loadlib("function","function.mandatory");
loadlib("function","function.olah_tabel");
// $db->debug=true;
switch ($act) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":
	$kode_id_terakhir = max_kode_number("mt_perusahaan","id_perusahaan");
	$kode_perusahaan_terakhir = max_kode_number("mt_perusahaan","kode_perusahaan");
	$result = true;
	$db->BeginTrans();
	unset($insertDdPerusahaan);
	$insertDdPerusahaan["id_perusahaan"] = $kode_id_terakhir;
	$insertDdPerusahaan["kode_perusahaan"] = $kode_perusahaan_terakhir;
	$insertDdPerusahaan["nama_perusahaan"] = $nama_perusahaan;
	$insertDdPerusahaan["alamat"] = $alamat;
	$insertDdPerusahaan["telpon1"] = $telepon1;
	$insertDdPerusahaan["telpon2"] = $telepon2;
	$insertDdPerusahaan["fax"] = $faksimili;
	$insertDdPerusahaan["kontakperson"] = $contact_person1;
	$insertDdPerusahaan["kontakperson2"] = $contact_person2;
	$insertDdPerusahaan["flag_mitra"] = '2';
	$insertDdPerusahaan["no_perjanjian"] = $no_perjanjian;
	$insertDdPerusahaan["nama_perjanjian"] = $nama_perjanjian;
	$insertDdPerusahaan["id_dc_propinsi"] = $id_dc_propinsi;
	$insertDdPerusahaan["id_dc_kota"] = $kota;
	$insertDdPerusahaan["id_dc_kecamatan"] = $kecamatan;
	$insertDdPerusahaan["id_dc_kelurahan"] = $kelurahan;

		//$result=false;
	$result = insert_tabel("mt_perusahaan", $insertDdPerusahaan);
	$db->CommitTrans($result !== false);

	break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

	$result = true;
	$db->BeginTrans();
	unset($insertDdPerusahaan);
	$insertDdPerusahaan["nama_perusahaan"] = $nama_perusahaan;
	$insertDdPerusahaan["alamat"] = $alamat;
	$insertDdPerusahaan["telpon1"] = $telepon1;
	$insertDdPerusahaan["telpon2"] = $telepon2;
	$insertDdPerusahaan["fax"] = $faksimili;
	$insertDdPerusahaan["kontakperson"] = $contact_person1;
	$insertDdPerusahaan["kontakperson2"] = $contact_person2;
	$insertDdPerusahaan["no_perjanjian"] = $no_perjanjian;
	$insertDdPerusahaan["nama_perjanjian"] = $nama_perjanjian;
	$insertDdPerusahaan["id_dc_propinsi"] = $id_dc_propinsi;
	$insertDdPerusahaan["id_dc_kota"] = $kota;
	$insertDdPerusahaan["id_dc_kecamatan"] = $kecamatan;
	$insertDdPerusahaan["id_dc_kelurahan"] = $kelurahan;
	$result = update_tabel("mt_perusahaan", $insertDdPerusahaan, "WHERE id_perusahaan=$id_perusahaan");
	$db->CommitTrans($result !== false);

	break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

	$result = true;
	$db->BeginTrans();
	$result = delete_tabel("mt_perusahaan", "WHERE id_perusahaan=$id_perusahaan");
	$db->CommitTrans($result !== false);

	break;

}

if($result){
	$data['code']=200;
	echo json_encode($data);
}else{
	$data['code']=500;
	echo json_encode($data);
}
die();
?>


