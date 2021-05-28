<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");

	
	
	if(!empty($search)){
		$sqlPlus=" where (nama_channel like '%$search%')";
	}

	$sql = "SELECT * from mt_channel $sqlPlus";
	$sql_count="select count(id_mt_channel) as jum from ($sql) as a";
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
				$tampil["no"]=$i;
				$id_mt_channel = $tampil["id_mt_channel"];
				$nama_channel = $tampil["nama_channel"];
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapusChanel($id_mt_channel)'>
							<i class='pe-7s-trash text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Hapus Data' onclick='ubahChanel($id_mt_channel)'>
							<i class='pe-7s-edit text-success '></i>
							</a>";
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>