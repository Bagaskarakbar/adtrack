<?
	session_start();

	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.tidak_berulang");

	switch ($tipeCari) {
		case "submenu" :
			$sqlPlus = "AND nama_sub_menu LIKE'%$filter%'";
			break;
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

		SELECT		dc_sub_menu.*,dc_menu.nama_menu,dc_menu.no_urut AS no_urut_menu,dc_modul.nama_modul,dc_modul.id_dc_modul
		FROM		dc_sub_menu,dc_menu,dc_modul
		WHERE		dc_sub_menu.id_dc_menu=dc_menu.id_dc_menu and dc_menu.id_dc_modul=dc_modul.id_dc_modul $sqlPlus
		ORDER BY	dc_modul.nama_modul,dc_menu.no_urut,dc_sub_menu.no_urut 

	";
	
	$sql_count="select count(id_dc_sub_menu) as jum from ($sql) as a";
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

				$id_dc_sub_menu = $tampil["id_dc_sub_menu"];
				$id_dc_menu = $tampil["id_dc_menu"];
				$id_dc_modul = $tampil["id_dc_modul"];
				$nama_sub_menu = $tampil["nama_sub_menu"];
				$url_sub_menu = $tampil["url_sub_menu"];
				$keterangan = $tampil["keterangan"];
				$no_urut = $tampil["no_urut"];
				$input_id = $tampil["input_id"];
				$input_tgl = $tampil["input_tgl"];
				$nama_menu = $tampil["nama_menu"];
				$nama_modul = $tampil["nama_modul"];
				$no = $i.".";

				tidak_berulang("nama_modul,nama_menu");
				$DataList['no']=$no;
				$DataList['nama_modul']=$nama_modul;
				$DataList['nama_menu']=$nama_menu;
				$DataList['no_urut']="<input value='$no_urut' type='text' class='form-control' size='1' name='oid[]'><input type='hidden' name='id_submenus[]' value='$id_dc_sub_menu'>";
				$DataList['act_hapus']="<a class='hapus' href='#' title='Hapus Submenu $nama_sub_menu' onclick=FungsiHapus($id_dc_sub_menu)><i class='las la-trash-alt icon-lg text-danger '></i></a>";
				$DataList['act_edit']="<a href='#' title='Edit Submenu $nama_sub_menu' onclick=FungsiEdit($id_dc_sub_menu,$id_dc_modul)><i class='las la-edit icon-lg text-success '></i></a>";
				$DataList['nama_sub_menu']=$nama_sub_menu;
				$DataList['url_sub_menu']=$url_sub_menu;
				$data['items'][]=$DataList;
			}
			
			echo json_encode($data);
			
		?>