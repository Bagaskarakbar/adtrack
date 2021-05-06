<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
		loadlib("function","function.tidak_berulang");

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
	
	if($search!=""){
		$sqlPlus=" and (nama_pemeriksaan like'%$search%')";
	}

	$sql = "select  * from pm_standar_hasil_v WHERE kode_bagian='050101' $sqlPlus ORDER BY kode_tarif,urutan";
	$sql_count="select count(kode_mt_hasilpm) as jum from ($sql) as a";
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
				$kode_mt_hasilpm 		= $tampil["kode_mt_hasilpm"];
				$nama_pemeriksaan 		= $tampil["nama_pemeriksaan"];
				$nama_tarif 			= $tampil["nama_tarif"];
				$detail_item1 			= $tampil["detail_item1"];
				$standar_hasil_wanita 	= $tampil["standar_hasil_wanita"];
				$standar_hasil_pria 	= $tampil["standar_hasil_pria"];
				$satuan 				= $tampil["satuan"];
				tidak_berulang("nama_tarif");
				
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='HapusLab($kode_mt_hasilpm)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='LabEdit($kode_mt_hasilpm)'>
							<i class='las la-edit icon-lg text-success '></i>";
					$tampil["nama_tarif"]=$nama_tarif;			
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>