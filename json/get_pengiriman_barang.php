<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.uang");
	loadlib("class","Paging");
	
	//$db->debug=true;
	
	if(!empty($search)){
		$sqlAddSem=" WHERE (keterangan like '%$search%')";
	}
	$sql = "SELECT * FROM tc_po_detail_v WHERE id_tc_po = ".$id." $sqlAddSem" ;
	$sql_count="SELECT count(id_tc_po_det) AS jum FROM ($sql) AS a";
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

					$id_tc_po				=$tampil["id_tc_po"];
					$nama_brg				=$tampil["nama_brg"];
					$satuan_besar		=$tampil["satuan_besar"];
					$jumlah_besar		=$tampil["jumlah_besar"];
					$harga_satuan 	=$tampil["harga_satuan"];
          $jumlah_harga 	=$tampil["jumlah_harga"];
          $content        =$tampil["content"];
					
					$tampil["harga_satuan"]="<span style='color:red'>Rp. ".uang($harga_satuan)."/$satuan_besar</span>";
					$tampil["jumlah_harga"]="<span style='color:red'>Rp. ".uang($jumlah_harga)."</span>";
					//$tampil["tgl"]=$tgl_input;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>
