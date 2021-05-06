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
		unset($insertDcSubMenu);
		$insertDcSubMenu["id_dc_menu"] = $id_dc_menu;
		$insertDcSubMenu["nama_sub_menu"] = $nama_sub_menu;
		$insertDcSubMenu["url_sub_menu"] = $url_sub_menu;
		$insertDcSubMenu["no_urut"] = $no_urut;
		$insertDcSubMenu["input_id"] = $loginInfo["id_dd_user"];
		$insertDcSubMenu["input_tgl"] = date("Y-m-d");
		$result = insert_tabel("dc_sub_menu", $insertDcSubMenu);

		if($result!==false){

			$cariIdSubMenu= "SELECT max(id_dc_sub_menu) as kode FROM dc_sub_menu";
			$resCariIdSubMenu = &$db->Execute($cariIdSubMenu);
			$id_dc_sub_menu = $resCariIdSubMenu->fields["kode"];

			unset($insertDdUserGroupDetail);
			$insertDdUserGroupDetail["id_dc_sub_menu"] = $id_dc_sub_menu;
			$result = insert_tabel("dd_user_group_detail", $insertDdUserGroupDetail);
		}

		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editDcSubMenu);
		$editDcSubMenu["id_dc_menu"] = $id_dc_menu;
		$editDcSubMenu["nama_sub_menu"] = $nama_sub_menu;
		$editDcSubMenu["url_sub_menu"] = $url_sub_menu;
		$editDcSubMenu["no_urut"] = $no_urut;
		$result = update_tabel("dc_sub_menu", $editDcSubMenu, "WHERE id_dc_sub_menu=$id_dc_sub_menu");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dc_sub_menu", "WHERE id_dc_sub_menu=$id_dc_sub_menu");
		$db->CommitTrans($result !== false);

		break;

	// SORT ///////////////////////////////////////////////////////////////////////////////////////
	case "sort":

		$i = 0;
		foreach($oid as $osubmenu){
			$result = true;
			$sortNoUrut["no_urut"] = $osubmenu;
			$result=update_tabel("dc_sub_menu",$sortNoUrut,"Where id_dc_sub_menu=$id_submenus[$i]");
			$i++;
		}

		break;
	}
	if($result){
		$data['code']=200;
	}else{
		$data['code']=500;
	}
	echo json_encode($data);
?>








