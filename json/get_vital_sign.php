<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
}
	$sql = "SELECT * FROM gd_th_rujuk_ri where no_mr='$no_mr' $sqlAddSem" ;
	$sql_count="select count(kode_rujuk_ri) as jum from ($sql) as a";
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
					$keadaan_umum		= $tampil["keadaan_umum"];
					$kesadaran_pasien	= $tampil["kesadaran_pasien"];
					$tekanan_darah		= $tampil["tekanan_darah"];
					$nadi				= $tampil["nadi"];
					$suhu				= $tampil["suhu"];
					$pernafasan			= $tampil["pernafasan"];
					$berat_badan		= $tampil["berat_badan"];
					$tinggi_badan		= $tampil["tinggi_badan"];
					$lingkar_kepala		= $tampil["lingkar_kepala"];
					$lingkar_dada		= $tampil["lingkar_dada"];
					$lingkar_perut		= $tampil["lingkar_perut"];
					$respon_mata		= $tampil["respon_mata"];
					$respon_motorik		= $tampil["respon_motorik"];
					$respon_verbal		= $tampil["respon_verbal"];
					$tanggal		= $tampil["tgl_input"];

					
					//$fungsi_del="modal('dokter_act.php?kode_dokter=$kode_dokter&act=delete')";
					//$fungsi_edt="modal('dokter_addedit.php?kode_dokter=$kode_dokter&act=delete')";
					// $old_date_timestamp = strtotime($tanggal);
					// $tanggal = date('d-m-Y', $old_date_timestamp); 
					// $new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					// $new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='' onclick=cek_RM('$no_mr')><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					
					$tampil["keadaan_umum"]=$keadaan_umum;
					$tampil["kesadaran_pasien"]=$kesadaran_pasien;
					$tampil["tekanan_darah"]=$tekanan_darah;
					$tampil["nadi"]=$nadi;
					$tampil["suhu"]=$suhu;
					$tampil["pernafasan"]=$pernafasan;
					$tampil["tinggi_badan"]=$tinggi_badan;
					$tampil["berat_badan"]=$berat_badan;
					$tampil["tanggal"]=$tanggal;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>