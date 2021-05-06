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
	
	// $id_mt_karyawan=baca_tabel("dd_user","id_mt_karyawan","where id_dd_user='".$loginInfo["id_dd_user"]."'");
	// $kode_dokter=baca_tabel("mt_karyawan","kode_dokter","WHERE id_mt_karyawan='$id_mt_karyawan'");

	// if($kode_dokter!="" && $kode_dokter!=" "){
		// $sqlPlus=" AND tc_kunjungan.kode_dokter='$kode_dokter'";
	// }
	//////////////////////////////////////////////////////////////////////////////////////

	// $klinik_hd = '';
	// if($loginInfo['id_dd_user']!='')$id_dd_user_group=baca_tabel("dd_user","id_dd_user_group","WHERE id_dd_user=".$loginInfo['id_dd_user']);
	// if($id_dd_user_group==97){ //pantek HD
		// $klinik_hd = "AND pl_tc_poli.kode_bagian='013101'";
		// $judul = "Hemodialisa";
	// } else {
		// $klinik_hd = "AND pl_tc_poli.kode_bagian<>'013101'";
		// $judul = "Klinik";
	// }
	//////////////////////////////////////////////////////////////////////////////////////
		// $db->debug=true;

	if($tanggal!=""){
		$tgl=date("d ",strtotime($tanggal));
		
		$daftar_hari = array(
		 'Sunday'		=> 'Minggu',
		 'Monday'		=> 'Senin',
		 'Tuesday'		=> 'Selasa',
		 'Wednesday'	=> 'Rabu',
		 'Thursday'		=> 'Kamis',
		 'Friday'		=> 'Jumat',
		 'Saturday'		=> 'Sabtu'
		);
		$namahari = date('l', strtotime($tanggal));

		$carihari=$daftar_hari[$namahari];
		//echo $carihari;
		$sqlAddSem=" where range_hari like '%$carihari%'";
		
	}else{
		$sqlAddSem="";
	}

	
	// print_r($tgl);
	// die;
	
	// $dNow=date("d");
	// $mNow=date("m");
	// $yNow=date("Y");

	// if(!empty($search)){
	
	// }
	
	$sql = "select * from mt_jadwal_dokter_v $sqlAddSem" ;
	$sql_count="select count(id_mt_jadwal_dokter) as jum from ($sql) as a";
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

					$nama_pegawai		=$tampil["nama_pegawai"];
					$nama_spesialisasi	=$tampil["nama_spesialisasi"];
					$nama_bagian		=$tampil["nama_bagian"];
					$hari				=$tampil["range_hari"];
					$jam_mulai			=$tampil["jam_mulai"];
					$jam_akhir			=$tampil["jam_akhir"];
					$waktu_periksa		=$tampil["waktu_periksa"];
					$keterangan			=$tampil["keterangan"];
					$kode_spesialisasi	=$tampil["kode_spesialisasi"];
					$kode_dokter	=$tampil["kode_dokter"];
					
						// $sqlKaryawan=read_tabel("mt_karyawan","*","where kode_dokter='$id_mt_karyawan'");
						// while ($tampil=$sql->FetchRow()) {
							// $nama_pegawai		= $tampil["nama_pegawai"];
							// $flag_medis			= $tampil["flag_tenaga_medis"];
							// $url_foto_karyawan	= $tampil["url_foto_karyawan"];
						// }
						
						$url_foto_karyawan=baca_tabel("mt_karyawan","url_foto_karyawan","WHERE kode_dokter='".$kode_dokter."'");
						
						if($url_foto_karyawan !=""){
							$icon="<img src='$url_foto_karyawan' class='h-75 align-self-end' alt='' />";
						}else{
						$icon=	"<img src='assets/media/svg/avatars/001-boy.svg' class='h-75 align-self-end' alt='' />";
					
						}
					
					/*================= ====TR		===================*/
				
				
					$foto_dokter="<div class='symbol symbol-50 symbol-light mr-4'>
								<span class='symbol-label'>
									$icon
								</span>
							</div>";
					$nama_pegawai="<div class='d-flex align-items-center'>
							
							<div>
								<a href='#' onclick=detailDokter('$kode_dokter','$kode_spesialisasi') class='text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-sm'>$nama_pegawai</a>
							</div>
						</div>";
					$nama_spesialisasi="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$nama_spesialisasi
						</span>";
					$nama_bagian="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$nama_bagian
						</span>";
					$hari="<span class='text-dark-75 font-weight-bolder d-block font-size-sm text-center'>
							$jam_mulai
						</span>";
					
					$waktu_periksa="<span class='text-dark-75 font-weight-bolder d-block font-size-sm'>
							$waktu_periksa
						</span>";
						
					$keterangan="<span class='text-dark-75 font-weight-bolder d-block font-size-sm'>
							$keterangan
						</span>";
					
					/*================= 		/TR		===================*/

					$tampil["foto_dokter"]=$foto_dokter;
					$tampil["nama_pegawai"]=$nama_pegawai;
					$tampil["nama_spesialisasi"]=$nama_spesialisasi;
					$tampil["nama_bagian"]=$nama_bagian;
					$tampil["hari"]=$hari;
					$tampil["waktu_periksa"]=$waktu_periksa;
					$tampil["keterangan"]=$keterangan;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>