<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
//$db->debug=true;
switch ($act) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":

		$result = true;
		$db->BeginTrans();
		unset($insertDcMenu);
		$insertDcMenu["id_dc_modul"] = $id_dc_modul;
		$insertDcMenu["nama_menu"] = $nama_menu;
		$insertDcMenu["no_urut"] = $no_urut;
		$insertDcMenu["input_id"] = $loginInfo["id_dd_user"];
		$insertDcMenu["input_tgl"] = date("Y-m-d");
		$result = insert_tabel("dc_menu", $insertDcMenu);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editDcMenu);
		$editDcMenu["id_dc_modul"] = $id_dc_modul;
		$editDcMenu["nama_menu"] = $nama_menu;
		$editDcMenu["no_urut"] = $no_urut;
		$result = update_tabel("dc_menu", $editDcMenu, "WHERE id_dc_menu=$id_dc_menu");
		$db->CommitTrans($result !== false);
		
		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dc_menu", "WHERE id_dc_menu=$id_dc_menu");
		$db->CommitTrans($result !== false);

		break;

	// SORT ///////////////////////////////////////////////////////////////////////////////////////
	case "sort":
		$result = true;
		$i = 0;
		foreach($oid as $omenu){
			$sortNoUrut["no_urut"] = $omenu;
			$result = update_tabel("dc_menu",$sortNoUrut,"Where id_dc_menu=$id_menus[$i]");
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
//die;
?>









