<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
//$db->debug=true;
switch ($act) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "add":
		if ($kode_dokter!=""){
			$id_dd_jenis_user = 2;
		} else {
			$id_dd_jenis_user = 3;
			
		}
		$no_id_jenis = $no_induk;

		$result = true;
		$db->BeginTrans();
		unset($insertDdUser);
		$insertDdUser["username"] = $username;
		$insertDdUser["password"] = md5($password);
		$insertDdUser["no_induk"] = $no_induk;
		$insertDdUser["id_dd_user_group"] = $id_dd_user_group;
		$insertDdUser["status"] = $status;
		$insertDdUser["ko_wil"] = 101;
		$insertDdUser["input_id"] = $loginInfo["id_dd_user"];
		$insertDdUser["input_tgl"] = date("Y-m-d");
		$insertDdUser["id_dd_jenis_user"] = $id_dd_jenis_user;
		$insertDdUser["no_id_jenis"] = $no_id_jenis;
		$insertDdUser["id_mt_karyawan"] = $id_mt_karyawan;
		//$result=false;
		$result = insert_tabel("dd_user", $insertDdUser);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "edit":

		$result = true;
		$db->BeginTrans();
		unset($editDdUser);
		$editDdUser["username"] = $username;
		if((strlen($password)>0) or ($password!="")){
		$editDdUser["password"] = md5($password);
		}
		$editDdUser["id_dd_user_group"] = $id_dd_user_group;
		$editDdUser["status"] = $status;
		$result = update_tabel("dd_user", $editDdUser, "WHERE id_dd_user=$id_dd_user");
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "delete":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("dd_user", "WHERE id_dd_user=$id_dd_user");
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










