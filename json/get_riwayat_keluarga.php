<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (nama_keluarga like '%$search%' or tgl_lahir like '%$search%' or status_keluarga like '%$search%')";
}
	$sql = "SELECT * FROM mt_riwayat_dokter where kode_dokter=$kode $sqlAddSem" ;
	$sql_count="select count(id_mt_riwayat_dokter) as jum from ($sql) as a";
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
						$id_mt_riwayat_dokter 		= $tampil["id_mt_riwayat_dokter"];
						$nama_keluarga 				= $tampil["nama_keluarga"];
						$tgl_lahir 					= $tampil["tgl_lahir"];
						$status_keluarga 			= $tampil["status_keluarga"];
						$kode_dokter 				= $tampil["kode_dokter"];
						
						
					$old_date_timestamp = strtotime($tgl_lahir);
					$tanggal = date('d-m-Y', $old_date_timestamp); 
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' title='Edit  Data' onclick='AddKeluarga($id_mt_riwayat_dokter)'><i class='las la-edit icon-lg text-success '></i></a>&nbsp;<a href='#' title='Hapus  Data' onclick='hapusKeluarga($id_mt_riwayat_dokter)'><i class='las la-trash icon-lg text-danger '></i></a>";
					
					
					
								
					$tampil["nama_keluarga"]         	= $nama_keluarga; 				
					$tampil["tgl_lahir"]        		= $tanggal; 				
					$tampil["status_keluarga"]        	= $status_keluarga; 				
					$tampil["kode_dokter"]          	= $kode_dokter; 		
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>
