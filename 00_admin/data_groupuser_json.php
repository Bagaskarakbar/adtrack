<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	if($search!=""){
		$sqlPlus=" where (nama_group like'%$search%' or keterangan like'%$search%')";
	}

	$sql = "
	SELECT *
	FROM dd_user_group
	$sqlPlus " ;
	$sql_count="select count(id_dd_user_group) as jum from ($sql) as a";
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
	
	if($data['count'] == '0'){
		
		$data['items'][]="";
	}else{
		
		while ($tampil=$rsPaging->FetchRow()) {
					$i++;

					$id_dd_user_group			= $tampil["id_dd_user_group"];
					$nama_group					= $tampil["nama_group"];
					$keterangan					= $tampil["keterangan"];
					
					
					
					$tampil["action_hapus"]="<a href='#' title='Hapus' onclick='hapusGroupuser($id_dd_user_group)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
					$tampil["action_edit"]="<a href='#' title='Edit' onclick='ubahGroupuser($id_dd_user_group)'>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
					
					$tampil["nm_status_dr"]=$nm_status_dr;
					$tampil["no"]=$i;
					
					
					$data['items'][]=$tampil;
					
				}
	}
				
	echo json_encode($data);			
?>