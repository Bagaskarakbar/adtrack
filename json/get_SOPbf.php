<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	if(!empty($search)){
		$sqlAddSem=" where (kode_perusahaan like '%$search%' or nama_perusahaan like '%$search%')";
	}
	$sql = "select kode_perusahaan,nama_perusahaan from so_konf_v $sqlAddSem" ;
	$sql_count="select count(kode_perusahaan) as jum from ($sql) as a";
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

					$kode_perusahaan				=$tampil["kode_perusahaan"];
					$nama_perusahaan				=$tampil["nama_perusahaan"];
					
					$tampil["nama_perusahaan"] = "<a href='#' title='Detail PO' onclick=DetSO('$kode_perusahaan')>$nama_perusahaan</a>";
					
					$JmlSO = baca_tabel("so_konf_detail_v as a join mt_peserta_v as b on a.kode_perusahaan_pemesan=b.kode_perusahaan", "COUNT(a.id_tc_po)", "where a.flag_konfirmasi in (1,2) and (a.tgl_konfirm_apotik is not null or a.konfirm_apotik = 1) and a.flag_pack is null and a.kode_perusahaan='" . $kode_perusahaan . "'");
					
					$tampil["JmlSO"]=$JmlSO;
					$tampil["nama"]=$nama_perusahaan;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>