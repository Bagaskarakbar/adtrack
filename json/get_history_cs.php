<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	if(!empty($search)){
		$sqlAddSem=" where (keterangan like '%$search%')";
	}
	$sql = "select id_tc_cs,keterangan,tgl_input from tc_cs where id_tc_po = ".$id." $sqlAddSem" ;
	$sql_count="select count(id_tc_cs) as jum from ($sql) as a";
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

					$keterangan				=$tampil["keterangan"];
					$tgl_input				=$tampil["tgl_input"];
					
					$tampil["keterangan"]=$keterangan;
					$tampil["tgl"]=$tgl_input;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>