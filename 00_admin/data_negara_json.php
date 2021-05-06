<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");

	/* switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "WHERE nama_pegawai LIKE'%$filter%'";
			break;
		case "id" :
			$sqlPlus = "WHERE username LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	} */

	if(!empty($search)){
		$sqlAddSem=" where (nama_negara like '%$search%')";
	}
	
	$sql = "select id_dc_negara,nama_negara from dc_negara $sqlAddSem order by nama_negara";
	$sql_count="select count(id_dc_negara) as jum from ($sql) as a";
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
				$tampil["no"]		= $i;
				$id_dc_negara 		= $tampil["id_dc_negara"];
				$nama_negara 		= $tampil["nama_negara"];
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapusNegara($id_dc_negara)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='addNegara($id_dc_negara)'>
							<i class='las la-edit icon-lg text-success '></i>";
							
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>