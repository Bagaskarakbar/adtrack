<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
}
	$sql = "SELECT * FROM th_riwayat_pasien where no_mr='$no_mr' $sqlAddSem" ;
	$sql_count="select count(kode_riwayat) as jum from ($sql) as a";
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
					$kode_riwayat		= $tampil["kode_riwayat"];
					$no_kunjungan		= $tampil["no_kunjungan"];
					$no_mr				= $tampil["no_mr"];
					$nama_pasien		= $tampil["nama_pasien"];
					$diagnosa_awal		= $tampil["diagnosa_awal"];
					$anamnesa			= $tampil["anamnesa"];
					$pengobatan			= $tampil["pengobatan"];
					$dokter_pemeriksa	= $tampil["dokter_pemeriksa"];
					$pemeriksaan		= $tampil["pemeriksaan"];
					$tgl_periksa		= $tampil["tgl_periksa"];
					$kode_bagian		= $tampil["kode_bagian"];
					$diagnosa_akhir		= $tampil["diagnosa_akhir"];
					$kode_icd_diagnosa	= $tampil["kode_icd_diagnosa"];
					$kategori_tindakan	= $tampil["kategori_tindakan"];
					//$nama_diagnosa = baca_tabel("mt_icd_diagnosa","nama_diagnosa","where kode_icd_diagnosa=$kode_icd_diagnosa");
					

					if($kategori_tindakan == 1 ){
						$warna ="Merah";
					}else if($kategori_tindakan == 2){
						$warna ="Kuning";
					}else if($kategori_tindakan == 3){
						$warna ="Hijau";
					}else if($kategori_tindakan == 4){
						$warna ="Hitam";
					}

	
					$old_date_timestamp = strtotime($tgl_periksa);
					$tanggal = date('d-m-Y', $old_date_timestamp); 
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='' onclick=cek_RM('$no_mr')><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					
					$tampil["diagnosa_akhir"]=$diagnosa_akhir;
					$tampil["tanggal"]=$tanggal;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>