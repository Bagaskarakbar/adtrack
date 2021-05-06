<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.tidak_berulang");

	switch ($tipeCari) {
		case "menu" :
			$sqlPlus = "AND nama_menu LIKE'%$filter%'";
			break;
		case "modul" :
			$sqlPlus = "AND nama_modul LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	}

	$sql = "
			SELECT m.*,d.nama_modul
			FROM dc_menu m,dc_modul d
			WHERE m.id_dc_modul=d.id_dc_modul $sqlPlus
			ORDER BY d.nama_modul,m.no_urut
			";


	$sql_count="select count(id_dc_menu) as jum from ($sql) as a";
	$run_count=$db->Execute($sql_count);
	while($tpl_count=$run_count->fetchRow()){
		$data['count']=$tpl_count['jum'];
	}
	$recperpage = $limit;
	$hal=($offset/$limit)+1;

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;

?>
<?
			$i = $pagenya->pagingVars["firstno"];
		
			while ($tampil=$rsPaging->FetchRow()) {
				$i++;

				$id_dc_menu = $tampil["id_dc_menu"];
				$id_dc_modul = $tampil["id_dc_modul"];
				$nama_menu = $tampil["nama_menu"];
				$url = $tampil["url"];
				$no_urut = $tampil["no_urut"];
				$input_id = $tampil["input_id"];
				$input_tgl = $tampil["input_tgl"];
				$nama_modul = $tampil["nama_modul"];
				$no = $i.".";

				tidak_berulang("nama_modul");
				$DataList['no']=$no;
				$DataList['nama_modul']=$nama_modul;
				$DataList['no_urut']="<input value='$no_urut' type='text' class='form-control' size='1' name='oid[]'><input type='hidden' name='id_menus[]' value='$id_dc_menu'>";
				$DataList['act_hapus']="<a class='hapus' href='#' title='Hapus Menu $nama_menu ' onclick=HapusMenu($id_dc_menu)><i class='las la-trash-alt icon-lg text-danger '></i></a>";
				$DataList['act_edit']="<a href='#' title='Edit Menu $nama_menu' onclick=EditMenu('/00_admin/menu_addedit.php?id_dc_menu=$id_dc_menu')><i class='las la-edit icon-lg text-success '></i></a>";
				$DataList['nama_menu']=$nama_menu;
				$data['items'][]=$DataList;
			}
echo json_encode($data);
		?>