<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	// $db->debug=true;
	$no_mr=$_GET['no_mr'];
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
}
	$sql = "SELECT a.*,b.nama_icd,c.nama_pasien from th_icd10_pasien as a JOIN mt_master_icd10 as b on b.icd_10 = a.kode_icd JOIN mt_master_pasien as c ON a.no_mr = c.no_mr WHERE c.no_mr='$no_mr' $sqlAddSem" ;
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

					$no_mr = $tampil["no_mr"];
					$nama_pasien = $tampil["nama_pasien"];
					$tgl_jam = $tampil["tgl_jam"];
					$no_registrasi = $tampil["no_registrasi"];
					$kode_icd = $tampil["kode_poli"];
					$nama_icd = $tampil["nama_icd"];

					
					//$fungsi_del="modal('dokter_act.php?kode_dokter=$kode_dokter&act=delete')";
					//$fungsi_edt="modal('dokter_addedit.php?kode_dokter=$kode_dokter&act=delete')";
					$old_date_timestamp = strtotime($tgl_jam);
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='' onclick=cek_RM('$no_mr','$tgl_input')><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["kode_icd"]=$kode_icd;
					$tampil["nama_icd"]=$nama_icd;
					$tampil["tgl_jam"]=$new_date;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>