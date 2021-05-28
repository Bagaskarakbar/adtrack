<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.tidak_berulang");

	switch ($tipeCari) {
		case "kelompok" :
			$sqlPlus = "AND nama_modular LIKE'%$filter%'";
			break;
		case "modul" :
			$sqlPlus = "AND nama_modul LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	}

	$sql = "
			SELECT m.*,d.nama_modular,d.no_urut_modular
			FROM dc_modul m,dc_modular d
			WHERE m.id_dc_modular=d.id_dc_modular $sqlPlus
			ORDER BY d.no_urut_modular,m.no_urut
			";
	$sql_count="select count(id_dc_modul) as jum from ($sql) as a";
	$run_count=$db->Execute($sql_count);
	while($tpl_count=$run_count->fetchRow()){
		$data['count']=$tpl_count['jum'];
	}
	$recperpage = $limit;
	$hal=($offset/$limit)+1;	

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;


		$i = $pagenya->pagingVars["firstno"];
	
		while ($tampil=$rsPaging->FetchRow()) {
			$i++;
			$id_modul=$tampil["id_dc_modul"];
			$nama_modular=$tampil["nama_modular"];
			$nama_modul=$tampil["nama_modul"];
			$no_urut=$tampil["no_urut"];
			$logo=$tampil["logo"];
			$folder=$tampil["folder"];
			$kode_bagian=$tampil["kode_bagian"];
			$no = $i.".";
			tidak_berulang("nama_modular");
			
			$DataList['no']=$no;
			$DataList['nama_modular']=$nama_modular;
			$DataList['no_urut']="<input value='$no_urut' type='text' size='1' name='oid[]'><input type='hidden' name='id_moduls[]' value='$id_modul'>";
			$DataList['act_hapus']="<a class='hapus' href='#' title='Hapus Modul $nama_modul' onclick=HapusModul($id_modul)><i class='pe-7s-trash text-danger '></i></a>";
			$DataList['act_edit']="<a href='#' title='Edit Modul $nama_modul' onclick=EditModul($id_modul)><i class='pe-7s-edit text-success '></i></a>";
			$DataList['nama_modul']=$nama_modul;
			$DataList['kode_bagian']=$kode_bagian;
			$DataList['folder']=$folder;
			$DataList['logo']="<img src='$logo' width='20px;'>";
			$data['items'][]=$DataList;
		}
		
		echo json_encode($data);
?>