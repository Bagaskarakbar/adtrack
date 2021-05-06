<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	/*
	$sql_plus=" AND id_mt_master_pasien IS NULL ";

	$filter=trim($filter);
	if (isset($topik)) {
		switch ($topik) {
			case "nama" :
				$sql_plus=" AND mt_master_pasien.nama_pasien LIKE '%$filter%' ";
				break;
			case "mr" :
				
					$sql_plus="AND mt_master_pasien.no_mr = '$filter' ";			
				
				break;
			case "mr_lama" :
				
					$sql_plus="AND mt_master_pasien.no_mr_lama = '$filter' ";			
				
				break;
			case "nasabah" :
				if($kode_kelompok>0){
					$sql_plus="AND mt_master_pasien.kode_kelompok=$kode_kelompok";
				}else
				{
					$sql_plus="AND mt_master_pasien.kode_kelompok is not null";
				}
				
				break;
			case "alamat" :
				$sql_plus="AND mt_master_pasien.almt_ttp_pasien LIKE '%$filter%' ";
				break;
			case "tgl_lahir" :
				$tgl_1=$txt_tahun_lahir."-".$txt_bulan_lahir."-".$txt_tanggal_lahir." 00:00:00";
				$tgl_2=$txt_tahun_lahir."-".$txt_bulan_lahir."-".$txt_tanggal_lahir." 23:59:59";
				$sql_plus="AND mt_master_pasien.tgl_lhr BETWEEN '$tgl_1' and '$tgl_2'";
				break;
			case "ktp" :
				$sql_plus="AND mt_master_pasien.no_ktp LIKE '%$filter%'";
				break;
			case "telpon" :
				$sql_plus="AND mt_master_pasien.tlp_almt_ttp LIKE '%$filter%'";
				break;
			default :
				$sql_plus = "";
		}

	}
	*/
	if(!empty($search)){
	$sqlAddSem=" AND (no_mr like '%$search%' or nama_pasien like '%$search%' or almt_ttp_pasien like '%$search%' or tgl_lhr like '%$search%')";
}
	$sql = "select mt_master_pasien.no_mr,mt_master_pasien.no_mr_lama,mt_master_pasien.tgl_lhr, mt_master_pasien.kode_kelompok,nama_pasien,almt_ttp_pasien,mt_nasabah.nama_kelompok,mt_perusahaan.nama_perusahaan,mt_master_pasien.status_meninggal,jen_kelamin from mt_master_pasien left join mt_nasabah on mt_master_pasien.kode_kelompok = mt_nasabah.kode_kelompok left join mt_perusahaan on mt_master_pasien.kode_perusahaan = mt_perusahaan.kode_perusahaan where mt_master_pasien.no_mr is not null and status_meninggal=0  $sqlAddSem order by no_mr" ;
	$sql_count="select count(no_mr) as jum from ($sql) as a";
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

					$no_mr				=$tampil["no_mr"];
					$no_mr_lama			=$tampil["no_mr_lama"];
					$hubungan			=$tampil["hubungan"];
					$kota				=$tampil["kota"];
					$nama_pasien		=$tampil["nama_pasien"];
					$nama_panggilan		=$tampil["nama_panggilan"];
					$nama_kel_pasien	=$tampil["nama_kel_pasien"];
					$no_ktp				=$tampil["no_ktp"];
					$pekerjaan			=$tampil["pekerjaan"];
					$tgl_lhr			=$tampil["tgl_lhr"];
					$no_ktp				=$tampil["no_ktp"];
					$almt_ttp_pasien	=$tampil["almt_ttp_pasien"];
					$kode_perusahaan	=$tampil["kode_perusahaan"];
					$kode_kelompok		=$tampil["kode_kelompok"];
					$nasabah			=$tampil["nama_kelompok"];
					$perusahaan			=$tampil["nama_perusahaan"];
					$status_meninggal	=$tampil["status_meninggal"];
					$jen_kelamin		=$tampil["jen_kelamin"];

					
					//$fungsi_del="modal('dokter_act.php?kode_dokter=$kode_dokter&act=delete')";
					//$fungsi_edt="modal('dokter_addedit.php?kode_dokter=$kode_dokter&act=delete')";
					$old_date_timestamp = strtotime($tgl_lhr);
					$new_date = date('d-m-Y', $old_date_timestamp); ;
					
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["almt_ttp_pasien"]=$almt_ttp_pasien;
					$tampil["tgl_lhr"]=$new_date;
					$tampil["jen_kelamin"]=$jen_kelamin;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>