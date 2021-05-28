<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");

	
	
	if(!empty($search)){
		$sqlPlus=" where (no_pelanggan like '%$search%' or jenis_pelanggan like '%$search%')";
	}

	$sql = "SELECT a.*,b.jenis_pelanggan from mt_mitra as a join mt_jenis_pelanggan as b on a.id_mt_jenis_pelanggan=b.id_mt_jenis_pelanggan $sqlPlus";
	$sql_count="select count(id_mt_mitra) as jum from ($sql) as a";
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
				$id_mt_mitra = $tampil["id_mt_mitra"];
				$no_pelanggan = $tampil["no_pelanggan"];
				$nama_pelanggan = $tampil["nama_pelanggan"];
				$jenis_pelanggan = $tampil["jenis_pelanggan"];
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapusMitra($id_mt_mitra)'>
							<i class='pe-7s-trash text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='ubahMitra($id_mt_mitra)'>
							<i class='pe-7s-edit text-success '></i>
							</a>";
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>