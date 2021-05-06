<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (nama_instansi_pendidikan like '%$search%' or tahun_mulai like '%$search%' or tahun_lulus like '%$search%' or jurusan like '%$search%' or gelar like '%$search%')";
}
	$sql = "SELECT * FROM mt_pendidikan where kode_dokter=$kode $sqlAddSem" ;
	$sql_count="select count(id_mt_pendidikan) as jum from ($sql) as a";
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
						$id_mt_pendidikan 			= $tampil["id_mt_pendidikan"];
						$nama_instansi_pendidikan 	= $tampil["nama_instansi_pendidikan"];
						$kode_dokter 				= $tampil["kode_dokter"];
						$tahun_mulai 				= $tampil["tahun_mulai"];
						$tahun_lulus 				= $tampil["tahun_lulus"];
						$jurusan 					= $tampil["jurusan"];
						$gelar 						= $tampil["gelar"];
						
						
					//$old_date_timestamp = strtotime($tgl_periksa);
					//$tanggal = date('d-m-Y', $old_date_timestamp); 
					//$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					//$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' title='Edit  Data' onclick='AddPendidikan($id_mt_pendidikan)'><i class='las la-edit icon-lg text-success '></i></a>&nbsp;<a href='#' title='Hapus  Data' onclick='hapusPendidikan($id_mt_pendidikan)'><i class='las la-trash icon-lg text-danger '></i></a>";
					
					
					
					
					$tampil["id_mt_pendidikan"] 		= $id_mt_pendidikan;		
					$tampil["nama_instansi_pendidikan"] = $nama_instansi_pendidikan; 			
					$tampil["kode_dokter"]         		= $kode_dokter; 				
					$tampil["tahun_mulai"]        		= $tahun_mulai; 				
					$tampil["tahun_lulus"]        		= $tahun_lulus; 				
					$tampil["jurusan"]          		= $jurusan; 					
					$tampil["gelar"]            		= $gelar; 
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>
