<?
	session_start();
	require_once("../_lib/function/db.php");
	
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.tidak_berulang");
	loadlib("class","Paging");

	switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "WHERE nama_pegawai LIKE'%$filter%'";
			break;
		case "id" :
			$sqlPlus = "WHERE username LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	}
	 if(!empty($search)){
	 $sqlAddSem=" where nama_tarif like '%$search%' or nama_bagian like '%$search'";
	 }
	 else{
	 	$sqlAddSem="";
	 }
	$sql = "select  a.*,b.nama_bagian from mt_master_tarif as a join mt_bagian as b on a.kode_bagian=b.kode_bagian $sqlAddSem ORDER BY kode_bagian";
	$sql_count="select count(kode_tarif) as jum from ($sql) as a";
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
				$tampil["no"]			= $i;
				$kode_tarif 			= $tampil["kode_tarif"];
				$nama_tarif 			= $tampil["nama_tarif"];
				$total 					= $tampil["total"];
				$bill_dr1 				= $tampil["bill_dr1"];
				$pendapatan_rs 			= $tampil["pendapatan_rs"];
				$nama_bagian 			= $tampil["nama_bagian"];
				tidak_berulang("nama_bagian");
				
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_tarif($kode_tarif)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='edit_tarif($kode_tarif)'>
							<i class='las la-edit icon-lg text-success '></i>";
				$tampil["nama_bagian"]=$nama_bagian;	
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>