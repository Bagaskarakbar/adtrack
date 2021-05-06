<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	if(!empty($search)){
		$sqlAddSem=" and (kode_perusahaan like '%$search%' or nama_pbf like '%$search%')";
	}
	$sql = "SELECT kode_perusahaan,id_tc_po,nama_pbf from tc_po_v where flag_konfirmasi='3' or flag_konfirmasi='99' $sqlAddSem GROUP BY kode_perusahaan" ;
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
					$nama_perusahaan				=$tampil["nama_pbf"];
					$id_tc_po						=$tampil["id_tc_po"];
					
					$tampil["nama_perusahaan"] = "<a href='#' title='Detail PO' onclick=DetSOBatal('$kode_perusahaan')>$nama_perusahaan</a>";
					
					$JmlPO = baca_tabel("tc_po_v", "COUNT(id_tc_po)", "where flag_konfirmasi='3' or flag_konfirmasi='99' and kode_perusahaan='" . $kode_perusahaan . "'");
					
					$tampil["nama"]=$nama_perusahaan;
					$tampil["JmlPO"]=$JmlPO;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>