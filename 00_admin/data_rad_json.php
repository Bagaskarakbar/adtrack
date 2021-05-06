<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.tidak_berulang");

	switch ($tipeCari) {
		case "pemeriksaan" :
			$sqlPlus = "AND nama_tarif  LIKE'%$filter%'";
			break;
		case "pemeriksaan_detail" :
			$sqlPlus = "AND nama_pemeriksaan LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	}

	$sql = "select  * from pm_standar_hasil_v WHERE kode_bagian='050201' $sqlPlus ORDER BY kode_tarif,urutan";
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
				tidak_berulang("nama_tarif");
				
				$kesan=baca_tabel("pm_mt_standarhasil","kesan","WHERE kode_mt_hasilpm='".$kode_mt_hasilpm."'");
				$standar_rad=baca_tabel("pm_mt_standarhasil","standar_rad","WHERE kode_mt_hasilpm='".$kode_mt_hasilpm."'");
				
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='DelRad($kode_mt_hasilpm)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='EditRad($kode_mt_hasilpm)'>
							<i class='las la-edit icon-lg text-success '></i>";
				$tampil["kesan"]=$kesan;
				$tampil["standar_rad"]=$standar_rad;
				$tampil["nama_tarif"]=$nama_tarif;
				
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>