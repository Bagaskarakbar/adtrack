<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (tc_kunjungan.no_mr like '%$search%' or mt_master_pasien.nama_pasien like '%$search%' or mt_bagian.nama_bagian like '%$search%' or  tc_kunjungan.tgl_masuk like '%$search%')";
}
	$sql = "SELECT tc_kunjungan.id_tc_kunjungan, tc_kunjungan.no_mr, tc_kunjungan.no_kunjungan, mt_master_pasien.nama_pasien, mt_bagian.nama_bagian, tc_kunjungan.tgl_masuk, tc_kunjungan.kode_bagian_tujuan, pl_tc_poli.kode_poli, gd_tc_gawat_darurat.kode_gd, tc_kunjungan.kode_bagian_asal,tc_kunjungan.no_registrasi FROM tc_kunjungan INNER JOIN mt_bagian ON tc_kunjungan.kode_bagian_tujuan = mt_bagian.kode_bagian INNER JOIN mt_master_pasien ON tc_kunjungan.no_mr = mt_master_pasien.no_mr LEFT JOIN pl_tc_poli on tc_kunjungan.no_kunjungan=pl_tc_poli.no_kunjungan LEFT JOIN gd_tc_gawat_darurat on tc_kunjungan.no_kunjungan=gd_tc_gawat_darurat.no_kunjungan where (kode_bagian_tujuan like '01%' or kode_bagian_tujuan like '02%' or kode_bagian_tujuan like '03%') AND kode_bagian_tujuan <> '020003' $sqlAddSem" ;
	$sql_count="select count(id_tc_kunjungan) as jum from ($sql) as a";
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

					$id_tc_kunjungan = $tampil["id_tc_kunjungan"];
					$no_mr = $tampil["no_mr"];
					$nama_pasien = $tampil["nama_pasien"];
					$nama_bagian = $tampil["nama_bagian"];
					$tgl_masuk = $tampil["tgl_masuk"];
					$kode_bagian_tujuan = $tampil["kode_bagian_tujuan"];
					$kode_bagian_asal = $tampil["kode_bagian_asal"];
					$no_kunjungan = $tampil["no_kunjungan"];
					$no_registrasi = $tampil["no_registrasi"];
					$kode_poli = $tampil["kode_poli"];
					$kode_gd = $tampil["kode_gd"];
					$kode_ri = $tampil["kode_ri"];

					
					//$fungsi_del="modal('dokter_act.php?kode_dokter=$kode_dokter&act=delete')";
					//$fungsi_edt="modal('dokter_addedit.php?kode_dokter=$kode_dokter&act=delete')";
					$old_date_timestamp = strtotime($tgl_masuk);
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='' onclick=''><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["nama_bagian"]=$nama_bagian;
					$tampil["tgl_masuk"]=$new_date;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>