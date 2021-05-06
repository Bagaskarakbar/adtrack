<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	$kode_dokter=$loginInfo["kode_dokter"];
	
	

	if($kode_dokter==""){
		$sqlPlus="";
	}else{
		$layanan=baca_tabel('mt_dokter_bagian','fungsi_dokter',"where kode_dokter=$kode_dokter");
		$sqlPlus="AND tc_registrasi.flag_layanan='$layanan' AND tc_registrasi.kode_dokter='$kode_dokter'";
	}
	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	$Tgl=date("d");
	$Bln=date("m");
	$Thn=date("Y");

	 if(!empty($search)){
	 $sqlAddSem=" AND (tc_kunjungan.no_mr like '%$search%' or mt_master_pasien.nama_pasien like '%$search%' or mt_master_pasien.almt_ttp_pasien like '%$search%' or pl_tc_poli.no_antrian like '%$search%'or pl_tc_poli.tgl_jam_poli like '%$search%')";
	 }
	
	$sql = "SELECT
tc_registrasi.no_mr,
mt_bagian.nama_bagian,
tc_registrasi.flag_layanan,
tc_registrasi.nomor_antrian,
tc_registrasi.no_registrasi,
tc_kunjungan.no_kunjungan,
tc_kunjungan.status_keluar,
pl_tc_poli.tgl_jam_poli,
tc_registrasi.kode_dokter,
pl_tc_poli.id_pl_tc_poli,
pl_tc_poli.no_antrian,
mt_master_pasien.nama_pasien,
mt_master_pasien.jen_kelamin,
mt_master_pasien.almt_ttp_pasien
FROM
mt_bagian
INNER JOIN pl_tc_poli ON mt_bagian.kode_bagian = pl_tc_poli.kode_bagian
INNER JOIN tc_kunjungan ON pl_tc_poli.no_kunjungan = tc_kunjungan.no_kunjungan
INNER JOIN tc_registrasi ON tc_kunjungan.no_registrasi = tc_registrasi.no_registrasi
INNER JOIN mt_master_pasien ON tc_registrasi.no_mr = mt_master_pasien.no_mr
WHERE YEAR(tgl_jam_poli)='$Thn' AND MONTH(tgl_jam_poli)='$Bln' AND DAY(tgl_jam_poli)='$Tgl' AND tc_kunjungan.status_keluar is null $sqlAddSem $sqlPlus" ;
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

					$nm_poli			=$tampil["nama_poli"];
					$nm_dokter			=$tampil["nama_dokter"];
					$no_antrian			=$tampil["no_antrian"];
					$no_mr				=$tampil["no_mr"];
					$kode_poli			=$tampil["kode_poli"];
					$nm_pasien			=$tampil["nama_pasien"];
					$alamat				=$tampil["almt_ttp_pasien"];
					$jen_kelamin		=$tampil["jen_kelamin"];
					$nm_kel_pasien		=$tampil["nama_kel_pasien"];
					$kode_bagian_asal	=$tampil["kode_bagian_asal"];
					$kode_bagian		=$tampil["kode_bagian"];
					$nama_bagian_asal	=$tampil["nama_bagian_asal"];
					$no_kunjungan		=$tampil["no_kunjungan"];
					$no_registrasi		=$tampil["no_registrasi"];
					$kode_kelompok		=$tampil["kode_kelompok"];
					$kode_perusahaan	=$tampil["kode_perusahaan"];
					$flag_mcu			=$tampil["flag_mcu"];
					$id_pl_tc_poli		=$tampil["id_pl_tc_poli"];
					$tgl_jam_poli		=$tampil["tgl_jam_poli"];

					if($jen_kelamin=='L'){
						$icon="001-boy.svg";
					}else if($jen_kelamin=='P'){
						$icon="014-girl-7.svg";
					}else{
						$icon="018-girl-9.svg";
					}

					$old_date_timestamp = strtotime($tgl_jam_poli);
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					
					/*================= 		TR		===================*/
					$no_antrian="
						<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$no_antrian
						</span>
					";
					$nama_pasien="<div class='d-flex align-items-center'>
							<div class='symbol symbol-50 symbol-light mr-4'>
								<span class='symbol-label'>
									<img src='assets/media/svg/avatars/$icon' class='h-75 align-self-end' alt='' />
								</span>
							</div>
							<div>
								<a href='#' onclick=detailPasien('$no_mr','$no_kunjungan','$no_registrasi') class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm'>$nm_pasien</a>
							</div>
						</div>";
					$jam_poli="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$new_time
						</span>";
					$no_mr="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$no_mr
						</span>";
					
					$alamat="<span class='text-dark-75 font-weight-bolder d-block font-size-sm'>
							$alamat
						</span>";
					
					/*================= 		/TR		===================*/
					
					
					$tampil["no_antrian"]=$no_antrian;
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["alamat"]=$alamat;
					$tampil["tgl_jam"]=$jam_poli;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>