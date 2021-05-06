
<?
	// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once("../_lib/function/db.php");
loadlib("function","variabel");
loadlib("function","function.olah_tabel");
loadlib("class","Paging");
loadlib("function","function.date2str");
loadlib("function","function.datetime");
	
	
	 // $db->debug=true;
	
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
mt_bagian.nama_bagian,
tc_registrasi.flag_layanan,
tc_registrasi.nomor_antrian,
tc_registrasi.no_registrasi,
tc_registrasi.kode_bagian_masuk,
tc_kunjungan.no_kunjungan,
tc_kunjungan.status_keluar,
tc_kunjungan.kode_bagian_asal,
tc_kunjungan.kode_bagian_tujuan,
pl_tc_poli.tgl_jam_poli,
pl_tc_poli.kode_dokter,
pl_tc_poli.no_antrian,
pl_tc_poli.id_pl_tc_poli,
pl_tc_poli.kode_poli,
pl_tc_poli.kode_bagian as kode_bagian_poli,
mt_master_pasien.nama_pasien,
mt_master_pasien.jen_kelamin,
mt_master_pasien.almt_ttp_pasien,
mt_master_pasien.url_foto_pasien,
mt_master_pasien.gol_darah,
mt_master_pasien.tgl_lhr,
mt_master_pasien.alergi,
mt_master_pasien.no_hp,
mt_dokter_bagian.kode_bagian
FROM
mt_bagian
INNER JOIN pl_tc_poli ON mt_bagian.kode_bagian = pl_tc_poli.kode_bagian
INNER JOIN tc_kunjungan ON pl_tc_poli.no_kunjungan = tc_kunjungan.no_kunjungan
INNER JOIN tc_registrasi ON tc_kunjungan.no_registrasi = tc_registrasi.no_registrasi
INNER JOIN mt_master_pasien ON tc_registrasi.no_mr = mt_master_pasien.no_mr
INNER JOIN mt_dokter_bagian ON tc_registrasi.kode_dokter = mt_dokter_bagian.kode_dokter
WHERE YEAR(tgl_jam_poli)='$Thn' AND MONTH(tgl_jam_poli)='$Bln' AND DAY(tgl_jam_poli)='$Tgl' AND tc_kunjungan.status_keluar is null  $sqlPlus $sqlAddSem $sqlLayanan $sqlFilterDokter" ;
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
					$kode_bagian_tujuan		=$tampil["kode_bagian_tujuan"];
					
					$no_kunjungan		=$tampil["no_kunjungan"];
					$no_registrasi		=$tampil["no_registrasi"];
					$kode_kelompok		=$tampil["kode_kelompok"];
					$kode_perusahaan	=$tampil["kode_perusahaan"];
					$flag_mcu			=$tampil["flag_mcu"];
					$id_pl_tc_poli		=$tampil["id_pl_tc_poli"];
					$tgl_jam_poli		=$tampil["tgl_jam_poli"];
					$url_foto_pasien	=$tampil["url_foto_pasien"];
					$flag_bayar			=$tampil["flag_bayar"];
					$gol_darah			=$tampil["gol_darah"];
					$tgl_lhr			=$tampil["tgl_lhr"];
					$alergi				=$tampil["alergi"];
					$no_hp				=$tampil["no_hp"];
					$kode_dokter		=$tampil["kode_dokter"];
					$kode_bagian_poli		=$tampil["kode_bagian_poli"];
					
					$nama_dokter=baca_tabel('mt_karyawan','nama_pegawai',"where kode_dokter=$kode_dokter");
					
					
					
						$klinik=baca_tabel("mt_bagian","nama_bagian","where kode_bagian=$kode_bagian_poli");
					
					if ($kode_bagian_asal == $kode_bagian_poli){
						$bagian_asal="Registrasi";
					}else{
						$bagian_asal=baca_tabel("mt_bagian","nama_bagian","where kode_bagian=$kode_bagian_asal");
					}
		
					$umur=umur($tgl_lhr);

					
					
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
					/* $no_antrian="
						<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$no_antrian
						</span>
					";
			 */
					$nama_pasien="<div class='d-flex align-items-center'>
							<div class='symbol symbol-50 symbol-light mr-4'>
								<span class='symbol-label'>
									$icon
								</span>
							</div>
							<div>
								<a  href='#' class='tooltipC'>$nm_pasien
								  <div class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm tooltiptextC'>
									<table bolder='0' style='width:100%'>
									<tr>
										<td style='text-align: center; vertical-align: middle;'><b><u>$nm_pasien</u></b></td>
									</tr>
									 </table>
									 
									<table bolder='0' style='width:100%'>
									  <tr>
										<td style='text-align:right'>Umur</td>
										<td>:</td>
										<td>".$umur." Tahun, Golongan Darah : $gol_darah , $sex </td>
									  </tr>
									  <tr>
										<td style='text-align:right'>Alergi</td>
										<td>:</td>
										<td>$alergi</td>
									  </tr>
									  <tr>
										<td style='text-align:right'>No Hp</td>
										<td>:</td>
										<td>$no_hp </td>
									  </tr>
									  <tr>
										<td style='text-align:right'>Alamat</td>
										<td>:</td>
										<td>$alamat </td>
									  </tr>
									</table>
								  </div>
								</a>
							</div>
							
						</div>";
						
					$nama_pasien_action="<div class='d-flex align-items-center'>
							<div class='symbol symbol-50 symbol-light mr-4'>
								<span class='symbol-label'>
									$icon
								</span>
							</div>
							<div>
								<a href='#' onclick=detailPasien('$no_mr','$no_kunjungan','$no_registrasi','$kode_bagian_tujuan','$kode_poli') class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm tooltipC'>$nm_pasien
								<div class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm tooltiptextC'>
									<table bolder='0' style='width:100%'>
									<tr>
										<td style='text-align: center; vertical-align: middle;'><b><u> $nm_pasien</u></b></td>
									</tr>
									 </table>
									 
									<table bolder='0' style='width:100%'>
									  <tr>
										<td style='text-align:right'>Umur</td>
										<td>:</td>
										<td>".$umur." Tahun, Golongan Darah : $gol_darah , $sex </td>
									  </tr>
									  <tr>
										<td style='text-align:right'>Alergi</td>
										<td>:</td>
										<td>$alergi</td>
									  </tr>
									  <tr>
										<td style='text-align:right'>No. Hp</td>
										<td>:</td>
										<td>$no_hp </td>
									  </tr>
									  <tr>
										<td style='text-align:right'>Alamat</td>
										<td>:</td>
										<td>$alamat </td>
									  </tr>
									</table>
								  </div>
								</a>
							</div>
						</div>";
						
					$nama_pasien_old="<div class='d-flex align-items-center'>
							<div class='symbol symbol-50 symbol-light mr-4'>
								<span class='symbol-label'>
									$icon
								</span>
							</div>
							<div>
								<a href='#' onclick=detailPasien('$no_mr','$no_kunjungan','$no_registrasi','$kode_bagian') class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm'>$nm_pasien</a>
							</div>
						</div>";
		/* 			$jam_poli="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$new_time
						</span>";
					$no_mr="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$no_mr
						</span>";
					
					$alamat="<span class='text-dark-75 font-weight-bolder d-block font-size-sm'>
							$alamat
						</span>"; */
					
				/* 	$nama_dokter="<span class='text-dark-75 font-weight-bolder d-block font-size-sm'>
							$nama_dokter
						</span>"; */
					
					/*================= 		/TR		===================*/
					
					
					$tampil["no_antrian"]=$no_antrian;
					$tampil["no_mr"]=$no_mr;
					$tampil["nama_pasien"]=$nama_pasien;
					$tampil["nama_pasien_action"]=$nama_pasien_action;
					//$tampil["alamat"]=$alamat;
					$tampil["tgl_jam"]=$new_time;
					$tampil["nama_dokter"]=$nama_dokter;
					$tampil["klinik"]=$klinik;
					$tampil["bagian_asal"]=$bagian_asal;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>
		
	