<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (instansi like '%$search%' or tahun_jabatan like '%$search%')";
}
	$sql = "SELECT a.*,b.nama_spesialisasi FROM mt_jabatan_dokter as a LEFT JOIN mt_spesialisasi_dokter as b ON b.kode_spesialisasi = a.kode_spesialisasi where kode_dokter=$kode $sqlAddSem" ;
	$sql_count="select count(id_mt_jabatan_dokter) as jum from ($sql) as a";
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
						$id_mt_jabatan_dokter 		= $tampil["id_mt_jabatan_dokter"];
						$instansi	 				= $tampil["instansi"];
						$tahun	 					= $tampil["tahun_jabatan"];
						$status_keluarga 			= $tampil["status_keluarga"];
						$kode_dokter 				= $tampil["kode_dokter"];
						$nama_spesialisasi 			= $tampil["nama_spesialisasi"];
						
						
					//$old_date_timestamp = strtotime($tgl_lahir);
					//$tanggal = date('d-m-Y', $old_date_timestamp); 
					//$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					//$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' title='Edit  Data' onclick='AddJabatan($id_mt_jabatan_dokter)'><i class='las la-edit icon-lg text-success '></i></a>&nbsp;<a href='#' title='Hapus  Data' onclick='hapusJabatan($id_mt_jabatan_dokter)'><i class='las la-trash icon-lg text-danger '></i></a>";
					
					
					
								
					$tampil["instansi"]         	= $instansi; 						
					$tampil["tahun_jabatan"]     	= $tahun; 				
					$tampil["nama_spesialisasi"]	= $nama_spesialisasi; 				
					$tampil["kode_dokter"]          = $kode_dokter; 		
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>
