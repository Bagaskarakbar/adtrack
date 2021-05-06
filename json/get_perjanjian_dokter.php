<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (nomer_str like '%$search%' or nomer_kontrak like '%$search%' or massa_berlaku like '%$search%')";
}
	$sql = "SELECT * FROM mt_perjanjian_dokter where kode_dokter=$kode $sqlAddSem" ;
	$sql_count="select count(id_mt_perjanjian_dokter) as jum from ($sql) as a";
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
						$id_mt_perjanjian_dokter 	= $tampil["id_mt_perjanjian_dokter"];
						$nomer_str	 				= $tampil["nomer_str"];
						$nomer_kontrak	 			= $tampil["nomer_kontrak"];
						$massa_berlaku 				= $tampil["massa_berlaku"];
						$kode_dokter 				= $tampil["kode_dokter"];
						
						
					//$old_date_timestamp = strtotime($tgl_lahir);
					//$tanggal = date('d-m-Y', $old_date_timestamp); 
					//$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					//$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' title='Edit  Data' onclick='AddPerjanjian($id_mt_perjanjian_dokter)'><i class='las la-edit icon-lg text-success '></i></a>&nbsp;<a href='#' title='Hapus  Data' onclick='hapusPerjanjian($id_mt_perjanjian_dokter)'><i class='las la-trash icon-lg text-danger '></i></a>";
					
					
					
								
					$tampil["nomer_str"]         	= $nomer_str; 						
					$tampil["nomer_kontrak"]        = $nomer_kontrak; 				
					$tampil["massa_berlaku"]        = $massa_berlaku; 		
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>
