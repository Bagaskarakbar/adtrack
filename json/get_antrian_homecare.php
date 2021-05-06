<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	// $kode_dokter=$loginInfo["id_dd_user"];
	
	$id_mt_karyawan=baca_tabel('dd_user','id_mt_karyawan',"where id_dd_user='".$loginInfo['id_dd_user']."'");

	$kode_perawat=baca_tabel('mt_karyawan','kode_perawat',"where id_mt_karyawan='$id_mt_karyawan'");

	// if($kode_dokter==""){
		// $sqlPlus="";
	// }else{
		// $layanan=baca_tabel('mt_dokter_bagian','fungsi_dokter',"where kode_dokter=$kode_dokter");
		// $sqlPlus="AND tc_registrasi.flag_layanan='$layanan' AND tc_registrasi.kode_dokter='$kode_dokter'";
	// }
	


	 if(!empty($search)){
	 $sqlAddSem=" AND (tc_kunjungan.no_mr like '%$search%' or mt_master_pasien.nama_pasien like '%$search%' or mt_master_pasien.almt_ttp_pasien like '%$search%' or pl_tc_poli.no_antrian like '%$search%'or pl_tc_poli.tgl_jam_poli like '%$search%')";
	 }
	
	$sql = "SELECT
mt_master_pasien.nama_pasien,
tc_kunjungan.kode_dokter,
tc_kunjungan.tgl_masuk,
tc_kunjungan.status_keluar,
tc_kunjungan.id_tc_kunjungan,
tc_kunjungan.no_kunjungan,
tc_kunjungan.no_registrasi,
mt_master_pasien.url_foto_pasien,
mt_master_pasien.id_dc_kota,
mt_master_pasien.no_mr
FROM
mt_master_pasien
INNER JOIN tc_kunjungan ON tc_kunjungan.no_mr = mt_master_pasien.no_mr where kode_dokter='$kode_dokter' AND tgl_masuk BETWEEN '$tanggal 00:00:00' AND '$tanggal 23:59:59'" ;
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

					$nmpasien			=$tampil["nama_pasien"];
					$nm_dokter			=$tampil["nama_dokter"];
					$no_antrian			=$tampil["no_antrian"];
					$status_pasien			=$tampil["status_keluar"];
					$url_foto_pasien			=$tampil["url_foto_pasien"];
					$id_dc_kota			=$tampil["id_dc_kota"];
					$no_mr			=$tampil["no_mr"];
					$no_kunjungan			=$tampil["no_kunjungan"];
					$no_registrasi			=$tampil["no_registrasi"];

					if($url_foto_pasien!=""){
						$icon="<img src='$url_foto_pasien' class='h-75 align-self-end' alt='' width='40' height='30' />";
					}else{
						$icon="<img src='assets/media/svg/avatars/018-girl-9.svg' class='h-75 align-self-end' alt='' />";
					}

					if($status_pasien=='1'){
						$status="<span class='label label-success label-pill label-inline mr-2'>Selesai Tindakan</span>  ";
					}else{
						$status="<span class='label label-danger  label-pill label-inline mr-2'>Dalam Antrian</span> ";
					}
					
					$lokasi=baca_tabel("dc_kota","nama_kota","WHERE id_dc_kota='".$id_dc_kota."'");
					
					/*================= 		TR		===================*/
					$no_antrian="
						<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$no_antrian
						</span>
					";
					
					if($kode_perawat!=""){
						$pasien="<a href='#' onclick=detailPasien('$no_mr','$no_kunjungan','$no_registrasi') class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm'>$nmpasien</a>";
					}else{
						$pasien="$nmpasien";
					}
					
				$nama_pasien="<div class='d-flex align-items-center'>
							<div class='symbol symbol-50 symbol-light mr-4'>
								<span class='symbol-label'>
									$icon
								</span>
							</div>
							<div>
								$pasien
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
					
					
					$tampil["no"]=$i;
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["status_pasien"]=$status;
					$tampil["lokasi"]=$lokasi;

					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>