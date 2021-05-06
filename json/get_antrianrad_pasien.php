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

	if($jenis_layanan==""){
		$sqlLayanan="";
	}else{
		$sqlLayanan="AND tc_registrasi.flag_layanan='$jenis_layanan'";
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
	$hr_ini=date("Y-m-d");
	 if(!empty($search)){
	 $sqlAddSem=" AND (c.nama_pasien like '%$search%' OR b.no_mr like '%$search%' OR almt_ttp_pasien like '%$search%' )";
	 }

	$sql = "select no_antrian,kode_penunjang,nama_pasien,tgl_daftar,b.no_mr,almt_ttp_pasien,diagnosa,url_foto_pasien,id_pm_tc_penunjang from pm_tc_penunjang as a join tc_kunjungan as b on a.no_kunjungan=b.no_kunjungan join mt_master_pasien as c on b.no_mr=c.no_mr where flag_daftar is null and kode_bagian='".AV_RADIOLOGI."' AND a.tgl_daftar BETWEEN '$hr_ini 00:00:00' AND '$hr_ini 23:59:59 desc' $sqlAddSem" ;

	$sql_count="select count(id_pm_tc_penunjang) as jum from ($sql) as a";
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

					$kode_penunjang		=$tampil["kode_penunjang"];
					$no_antrian			=$tampil["no_antrian"];
					$no_mr				=$tampil["no_mr"];
					$nm_pasien			=$tampil["nama_pasien"];
					$tgl_daftar			=$tampil["tgl_daftar"];
					$almt_ttp_pasien	=$tampil["almt_ttp_pasien"];
					$diagnosa			=$tampil["diagnosa"];
					$url_foto_pasien	=$tampil["url_foto_pasien"];



					if($url_foto_pasien !=""){
							$icon="<img src='$url_foto_pasien' class='h-75 align-self-end' alt='' width='35' height='30'/>";
					}else{
							$icon=	"<img src='assets/media/svg/avatars/001-boy.svg' class='h-75 align-self-end' alt='' />";

					}

					$old_date_timestamp = strtotime($tgl_daftar);
					$new_time = date('H:i:s d-m-Y', $old_date_timestamp);
					// $new_time = date('H:i:s', $old_date_timestamp);


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
								<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>$nm_pasien</span>
							</div>
						</div>";
					$jam_poli="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$new_time
						</span>";
					$no_mr="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$no_mr
						</span>";

					$diagnosa="<span class='text-dark-75 font-weight-bolder d-block font-size-sm'>
							$diagnosa
						</span>";
					$periksa="<span class='label label-primary  label-pill label-inline mr-2' style='cursor:pointer' onClick='periksaLab($kode_penunjang)' >Periksa</span>";
					/*================= 		/TR		===================*/


					$tampil["no_antrian"]=$no_antrian;
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["diagnosa"]=$diagnosa;
					$tampil["tgl_jam"]=$tgl_daftar;
					$tampil["periksa"]=$periksa;
					$tampil["no"]=$i;

					$data['items'][]=$tampil;

				}
	echo json_encode($data);
?>
