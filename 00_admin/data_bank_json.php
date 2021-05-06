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
		$sqlAddSem=" where (nama_bank like '%$search%' or no_rekening like '%$search%')";
	}
	
	$sql = "select id_dd_bank,nama_bank,no_rekening from dd_bank $sqlAddSem order by nama_bank";
	$sql_count="select count(id_dd_bank) as jum from ($sql) as a";
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
				$id_dd_bank 		= $tampil["id_dd_bank"];
				$nama_bank 			= $tampil["nama_bank"];
				$no_rekening 		= $tampil["no_rekening"];
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapusBank($id_dd_bank)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='addBank($id_dd_bank)'>
							<i class='las la-edit icon-lg text-success '></i>";
							
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>