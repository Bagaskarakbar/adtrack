<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	// $db->debug=true;
	

	$sql = "SELECT
tc_status_pasien.status_pasien,
tc_status_pasien.terapi,
tc_status_pasien.id_tc_status_pasien,
tc_status_pasien.tgl_input,
tc_status_pasien.no_mr,
tc_kunjungan.no_kunjungan,
tc_kunjungan.kode_dokter,
tc_kunjungan.tgl_masuk,
mt_karyawan.nama_pegawai,
tc_kunjungan.no_registrasi
FROM
tc_status_pasien
INNER JOIN tc_kunjungan ON tc_status_pasien.no_kunjungan = tc_kunjungan.no_kunjungan
INNER JOIN mt_karyawan ON tc_kunjungan.kode_dokter = mt_karyawan.kode_dokter
where tc_status_pasien.no_mr='$no_mr' ORDER BY tgl_masuk DESC" ;
	$sql_count="select count(id_tc_status_pasien) as jum from ($sql) as a";
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
					$status_pasien		= $tampil["status_pasien"];
					$terapi				= $tampil["terapi"];
					$no_mr				= $tampil["no_mr"];
					$keterangan			= $tampil["keterangan"];
					$nama_pegawai		= $tampil["nama_pegawai"];
					$tgl_masuk			= $tampil["tgl_masuk"];
					$kode_dokter		= $tampil["kode_dokter"];
					$no_kunjungan		= $tampil["no_kunjungan"];
					$no_registrasi		= $tampil["no_registrasi"];
					
					$fungsi_dokter=baca_tabel("mt_dokter_bagian","fungsi_dokter","WHERE kode_dokter='".$kode_dokter."'");
					
					if($fungsi_dokter==1){
						$status="Telekonsul";
					}else if($fungsi_dokter==2){
						$status="Telemedicine";
					}else{
						$status="Homecare";
					}
					$tampil["aksi"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm'  title='Lihat Riwayat Pemeriksaan' onclick=LihatRiwayat('$no_mr','$no_registrasi','$no_kunjungan')><span class='icon-2x text-dark-50 flaticon-notes'></a>";
					
					$tampil["fungsi_dokter"]=$status;
					$tampil["subyektive"]=$status_pasien;
					$tampil["objective"]=$keterangan;
					$tampil["analisys"]=$terapi;
					$tampil["nama_dokter"]=$nama_pegawai;
					$tampil["tanggal"]=$tgl_masuk;

					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>