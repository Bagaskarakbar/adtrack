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
	 $sqlAddSem=" AND (mt_master_pasien.nama_pasien like '%$search%' OR tc_registrasi.no_mr like '%$search%' OR mt_master_pasien.almt_ttp_pasien like '%$search%' )";
	 }
	
	$sql = "SELECT
	tc_registrasi.no_mr,
	tc_registrasi.flag_bayar,
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
	mt_master_pasien.almt_ttp_pasien,
	mt_master_pasien.url_foto_pasien,
	kode_pesan_resep_dr
	FROM
	mt_bagian
	INNER JOIN pl_tc_poli ON mt_bagian.kode_bagian = pl_tc_poli.kode_bagian
	INNER JOIN tc_kunjungan ON pl_tc_poli.no_kunjungan = tc_kunjungan.no_kunjungan
	INNER JOIN tc_registrasi ON tc_kunjungan.no_registrasi = tc_registrasi.no_registrasi
	INNER JOIN mt_master_pasien ON tc_registrasi.no_mr = mt_master_pasien.no_mr
	INNER JOIN fr_tc_pesan_resep_dr ON tc_kunjungan.no_kunjungan=fr_tc_pesan_resep_dr.no_kunjungan
	WHERE tgl_selesai_obat is null  $sqlPlus $sqlAddSem" ;
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
					$url_foto_pasien	=$tampil["url_foto_pasien"];
					$flag_bayar			=$tampil["flag_bayar"];
					$kode_pesan_resep_dr=$tampil["kode_pesan_resep_dr"];

					
					$status_bayar="<button type='button' class='label label-primary label-pill label-inline mr-2' style='cursor: pointer;' onClick='ambilObat(".$kode_pesan_resep_dr.")' >Ambil</button>";
					

					if($url_foto_pasien !=""){
							$icon="<img src='$url_foto_pasien' class='h-75 align-self-end' alt='' width='35' height='30'/>";
						}else{
						$icon=	"<img src='assets/media/svg/avatars/001-boy.svg' class='h-75 align-self-end' alt='' />";
					
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
									$icon
								</span>
							</div>
							<div>
								$nm_pasien
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
					$paramUrl=json_encode($no_mr);
					$urlCetak="<a href='#' onClick='cetakResep(".$kode_pesan_resep_dr.",".$no_registrasi.",".$no_kunjungan.")' ><i class='fa fa-print' aria-hidden='true'></i></a>";
					
					$tampil["cetak_resep"]=$urlCetak;
					$tampil["no_antrian"]=$no_antrian;
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["alamat"]=$alamat;
					$tampil["tgl_jam"]=$jam_poli;
					$tampil["status_bayar"]=$status_bayar;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>