<?

	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
/* 	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
} */
	$sql = "select a.*,b.nama_icd from th_icd10_pasien a left join mt_master_icd10 b on a.kode_icd=b.icd_10 JOIN th_riwayat_pasien c on a.kode_riwayat=c.kode_riwayat where a.no_mr='$no_mr' and a.no_registrasi=$no_registrasi" ;
	$sql_count="select count(kode_icd_pasien) as jum from ($sql) as a";
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
					$kode_icd_pasien 	= $tampil["kode_icd_pasien"];
					$kode_riwayat 	= $tampil["kode_riwayat"];
					$tgl_jam 			= $tampil["tgl_jam"];
					$kodeICD 			= $tampil["kode_icd"];
					$kelompok_icd		=$tampil["kelompok_icd"];
					if(isset($kelompok_icd)){
					$nama_kelompok		=baca_tabel("mt_master_icd10","nama_icd","where icd_10='".$kelompok_icd."'");
					}
					$kodeAsterik 		= $tampil["kode_asterik"];
					$diagnosa 			= $tampil["diagnosa"];
					$tipeRL 			= $tampil["tipe_rl"];
					$kode_riwayat		=$tampil["kode_riwayat"];
					$jns_penyakit 		= $tampil["jns_penyakit"];
					$nama_icd10 		= $tampil["nama_icd"];
					if($kodeAsterik!=""){
						$nama_asterik = baca_tabel("mt_master_icd10","nama_icd","where icd_10='".$kodeAsterik."'");
					}
					
					$old_date_timestamp = strtotime($tgl_jam);
					$tanggal = date('d-m-Y', $old_date_timestamp); 
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_icd10($kode_icd_pasien,$kode_riwayat)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
					
					$tampil["tanggal"]=$tanggal;
					$tampil["kelompok_icd"]=$kelompok_icd;
					$tampil["nama_kelompok"]=$nama_kelompok;
					$tampil["kodeICD"]=$kodeICD;
					$tampil["nama_icd10"]=$nama_icd10;
					$tampil["kodeAsterik"]=$kodeAsterik;
					$tampil["nama_aterik"]=$nama_asterik;
					$tampil["no"]=$i;
					
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>