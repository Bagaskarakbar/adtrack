<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
//$db->debug=true;
$result = true;
$db->BeginTrans();

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";


if (is_array ($hak_akses_menu)) {
	foreach ($hak_akses_menu as $key => $value) {
				
				$id_dd_user_group=$kelompok;
				
				
				$cek=baca_tabel("dd_user_group_detail","id_dc_sub_menu","where id_dc_sub_menu=$key and id_dd_user_group=$id_dd_user_group");
				
				
				if($value=="0"){
					
					$sqlnya="delete from dd_user_group_detail  where id_dc_sub_menu=$key and id_dd_user_group=$id_dd_user_group";
					if ($result !== false) $result=$db->Execute($sqlnya);
				
				}else if($cek == $key){
				
					$sqlnya="update dd_user_group_detail set hak_akses_menu=5 where id_dc_sub_menu=$key and id_dd_user_group=$id_dd_user_group";
					if ($result !== false) $result=$db->Execute($sqlnya);
					
				}else{
					
					$hak_akses_menu=5;
					$sqlnya="insert into dd_user_group_detail(id_dd_user_group,id_dc_sub_menu,hak_akses_menu) values($id_dd_user_group,$key,$hak_akses_menu)";
					if ($result !== false) $result= $db->Execute($sqlnya);
					
				}
				
	}
}


$db->CommitTrans($result !== false);

if($result){
	$data['code']=1;
}else{
	$data['code']=0;
}
echo json_encode($data);

?>










