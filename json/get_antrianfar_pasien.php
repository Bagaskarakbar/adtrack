<?
	// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	$kode_dokter=$loginInfo["kode_dokter"];
	$jenis_layanan=$_GET['jenis_layanan'];
	$dokter=$_GET['kode_dokter'];


	if($kode_dokter==""){
		$sqlPlus="";
	}else{
		$bagian=baca_tabel('mt_dokter_bagian','kode_bagian',"where kode_dokter=$kode_dokter");
		$sqlPlus="AND mt_dokter_bagian.kode_bagian='$bagian'";
	}
	
	if($jenis_layanan==""){
		$sqlLayanan="";
	}else{
		$sqlLayanan="AND tc_registrasi.kode_bagian_masuk='$jenis_layanan'";
	}
	
	if($dokter==""){
		$sqlFilterDokter="";
	}else{
		$sqlFilterDokter="AND tc_registrasi.kode_dokter='$dokter'";
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
tc_registrasi.flag_layanan,
tc_registrasi.nomor_antrian,
tc_registrasi.no_registrasi,
tc_registrasi.kode_bagian_masuk,
fr_tc_pesan_resep_dr.tgl_pesan,
tc_registrasi.kode_dokter,
fr_tc_pesan_resep_dr.kode_pesan_resep_dr,
mt_master_pasien.nama_pasien,
mt_master_pasien.jen_kelamin,
mt_master_pasien.almt_ttp_pasien,
mt_master_pasien.url_foto_pasien
FROM
mt_bagian
INNER JOIN fr_tc_pesan_resep_dr
INNER JOIN tc_registrasi ON fr_tc_pesan_resep_dr.no_registrasi = tc_registrasi.no_registrasi
INNER JOIN mt_master_pasien ON fr_tc_pesan_resep_dr.no_mr = mt_master_pasien.no_mr
WHERE status_workorder is null" ;
	$sql_count="select count(kode_pesan_resep_dr) as jum from ($sql) as a";
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
					
					if($jen_kelamin=="L"){
						$gbr="001-boy.svg";
					}else{
						$gbr="003-girl-1.svg";
					}

					if($flag_bayar==""){
						$status_bayar="<span class='label label-danger label-pill label-inline mr-2'>Belum Bayar</span>";
					}else{
						$status_bayar="<span class='label label-primary  label-pill label-inline mr-2'>Sudah Bayar</span>";
					}

					if($url_foto_pasien !=""){
							$icon="<img src='$url_foto_pasien' class='h-75 align-self-end' alt='' width='35' height='30'/>";
						}else{
						$icon=	"<img src='assets/media/svg/avatars/$gbr' class='h-75 align-self-end' alt='' />";
					
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
								<a href='#' onclick=detailPasien('$no_mr','$no_kunjungan','$no_registrasi','$layanan') class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm'>$nm_pasien</a>
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
					
					
					$tampil["no_antrian"]=$i;
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