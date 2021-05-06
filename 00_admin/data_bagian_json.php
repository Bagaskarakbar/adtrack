<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	if($search!=""){
		$sqlPlus=" where (nama_bagian like'%$search%' or kode_bagian like '%$search%')";
	}

	$sql = "
	SELECT *
	FROM mt_bagian
	$sqlPlus " ;
	$sql_count="select count(kode_bagian) as jum from ($sql) as a";
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

					$id_mt_bagian			= $tampil["id_mt_bagian"];
					$kode_bagian			= $tampil["kode_bagian"];
					$nama_bagian			= $tampil["nama_bagian"];
					
					
					$tampil["action_hapus"]="<a href='#' title='Hapus' onclick='hapusBagian($id_mt_bagian)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
					$tampil["action_edit"]="<a href='#' title='Edit' onclick='addBagian($id_mt_bagian)'>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
					$tampil["detail"]="<button class='btn btn-primary' onclick='detailDokter(".$kode_dokter.")'>Detail</button>";		
					$tampil["nm_status_dr"]=$nm_status_dr;
					$tampil["no"]=$i;
					
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>