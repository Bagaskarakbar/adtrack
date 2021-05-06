<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (b.no_mr like '%$search%' or a.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
	}
	
	$sql = "SELECT a.*,b.no_mr,c.nama_bagian from pl_tc_poli as a JOIN tc_kunjungan as b ON a.no_kunjungan = b.no_kunjungan JOIN mt_bagian as c ON a.kode_bagian = c.kode_bagian where a.status_periksa is not null $sqlAddSem" ;
	$sql_count="select count(id_pl_tc_poli) as jum from ($sql) as a";
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
					$tgl_jam_poli = $tampil["tgl_jam_poli"];
					$nama_bagian = $tampil["nama_bagian"];
					$nama_icd = $tampil["nama_icd"];

					
					//$fungsi_del="modal('dokter_act.php?kode_dokter=$kode_dokter&act=delete')";
					//$fungsi_edt="modal('dokter_addedit.php?kode_dokter=$kode_dokter&act=delete')";
					$old_date_timestamp = strtotime($tgl_jam_poli);
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					
					$tampil["nama"]="<a href='#' title='Edit  $nama_pasien' onclick=detail('$no_mr')>$nama_pasien</a>";
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["nama_bagian"]=$nama_bagian;
					$tampil["tgl_jam"]=$new_date;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>