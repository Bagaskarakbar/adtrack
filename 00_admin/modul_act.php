<?
session_start();

require_once("../_lib/function/db.php");
//$db->debug=true;
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
switch ($act) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":

		$result = true;
		$db->BeginTrans();
		unset($insertDcModul);
		$insertDcModul["nama_modul"] = $nama_modul;
		$insertDcModul["id_dc_modular"] = $id_dc_modular;
		$insertDcModul["logo"] = $logo;
		$insertDcModul["no_urut"] = $no_urut; //nilai default no urut terbesar + 1
		$insertDcModul["input_id"] = $loginInfo["id_dd_user"];
		$insertDcModul["input_tgl"] = date("Y-m-d");
		$insertDcModul["kode_bagian"] = $kode_bagian; //nanti crosscek dg kode bagian yg udah ada
		$insertDcModul["folder"] = $folder;
		$result = insert_tabel("dc_modul", $insertDcModul);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$editDcModul["nama_modul"] = $nama_modul;
		$editDcModul["id_dc_modular"] = $id_dc_modular;
		$editDcModul["logo"] = $logo;
		$editDcModul["no_urut"] = $no_urut;
		$editDcModul["input_id"] = $loginInfo["id_dd_user"];
		$editDcModul["input_tgl"] = date("Y-m-d");
		$editDcModul["folder"] = $folder;
		$editDcModul["kode_bagian"] = $kode_bagian; //nanti crosscek dg kode bagian yg udah ada
		$result=update_tabel("dc_modul",$editDcModul,"Where id_dc_modul=$id_dc_modul");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dc_modul", "WHERE id_dc_modul=$id_dc_modul");
		$db->CommitTrans($result !== false);

		break;

	// SORT ///////////////////////////////////////////////////////////////////////////////////////
	case "sort":

		$i = 0;
		$result=true;
		foreach($oid as $omodul){
			$sortNoUrut["no_urut"] = $omodul;
			if($result) update_tabel("dc_modul",$sortNoUrut,"Where id_dc_modul=$id_moduls[$i]");
			$i++;
		}

		//show($_POST);

		break;
	}
	if($result){
		$data['code']=200;
	}else{
		$data['code']=500;
	}
	echo json_encode($data);
?>









