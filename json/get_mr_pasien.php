<?
	// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	// $db->debug=true;
	
	 if(!empty($search)){
	 $sqlAddSem=" AND (mt_karyawan.nama_pegawai like '%$search%' OR tc_status_pasien.tgl_input like '%$search%' )";
	 }


/* 	$sql = "SELECT
tc_kunjungan.id_tc_kunjungan,
tc_kunjungan.no_mr,
tc_kunjungan.kode_dokter,
tc_kunjungan.tgl_masuk,
tc_kunjungan.status_batal,
tc_kunjungan.status_mcu,
tc_kunjungan.umur_tahun,
tc_kunjungan.umur_bulan,
tc_kunjungan.umur_hari,
tc_kunjungan.kode_bagian_asal,
mt_karyawan.nama_pegawai,
mt_dokter_bagian.fungsi_dokter,
tc_kunjungan.no_kunjungan,
tc_registrasi.no_registrasi,
tc_registrasi.flag_bayar,
tc_status_pasien.tgl_input
FROM
tc_kunjungan
INNER JOIN mt_karyawan ON tc_kunjungan.kode_dokter = mt_karyawan.kode_dokter
INNER JOIN mt_dokter_bagian ON mt_dokter_bagian.kode_dokter = mt_karyawan.kode_dokter
INNER JOIN tc_registrasi ON tc_kunjungan.no_registrasi = tc_registrasi.no_registrasi
INNER JOIN tc_status_pasien ON tc_status_pasien.no_registrasi = tc_registrasi.no_registrasi
where tc_kunjungan.no_mr='$no_mr' $sqlAddSem
ORDER BY tc_status_pasien.tgl_input DESC
" ; */

	$sql = "select a.no_registrasi,a.no_kunjungan,a.no_mr,a.tgl_masuk,a.kode_dokter,kode_bagian_tujuan,kode_bagian_asal,nama_pegawai,
	c.nama_bagian,d.nama_bagian as nama_bagian_asal
	from tc_kunjungan as a  left outer join
	mt_karyawan as b on a.kode_dokter=b.kode_dokter
	left join mt_bagian as c on a.kode_bagian_tujuan=c.kode_bagian
	left join mt_bagian as d on a.kode_bagian_asal=d.kode_bagian 
	left join th_icd10_pasien as e on a.no_registrasi=e.no_registrasi and a.kode_bagian_tujuan=e.kode_bagian left join mt_master_icd10 as f on e.kode_icd=f.icd_10  where a.no_mr='$no_mr'  and c.group_bag not in('Group')  and d.group_bag not in('Group') AND  kode_bagian_tujuan = kode_bagian_asal group by a.no_registrasi,a.no_kunjungan,a.no_mr,a.tgl_masuk,a.kode_dokter,kode_bagian_tujuan,kode_bagian_asal,nama_pegawai,c.nama_bagian,d.nama_bagian order by no_kunjungan desc ";
	$sql_count="select count(no_kunjungan) as jum from ($sql) as a";
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
					$tgl_masuk				= $tampil["tgl_masuk"];
					$nama_pegawai				= $tampil["nama_pegawai"];
					$fungsi_dokter				= $tampil["fungsi_dokter"];
					$no_registrasi				= $tampil["no_registrasi"];
					$no_kunjungan				= $tampil["no_kunjungan"];
					$tgl_input					= $tampil["tgl_input"];
					$kode_bagian_asal			= $tampil["kode_bagian_asal"];
					$kode_bagian_tujuan			= $tampil["kode_bagian_tujuan"];
					
					$nama_bagian_asal=baca_tabel("mt_bagian","nama_bagian","WHERE kode_bagian='".$kode_bagian_asal."'");
					$kode_bagian_tujuan=baca_tabel("mt_bagian","nama_bagian","WHERE kode_bagian='".$kode_bagian_tujuan."'");
					
					
					if($tgl_input!=""){
						$tgl_input=$tgl_input;
					}else{
						$tgl_input="<span class='label label-danger label-pill label-inline mr-2'>Belum Periksa Soap</span>";
					}
					
					$tampil["aksi"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='Lihat Detail' onclick=LihatMrDetail('$no_mr','$no_registrasi','$no_kunjungan','$kode_bagian_asal')><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					
					$tampil["bagian_asal"]=$nama_bagian_asal;
					$tampil["bagian_tujuan"]=$kode_bagian_tujuan;
					$tampil["nama_dokter"]=$nama_pegawai;
					$tampil["tgl_pemeriksaan"]=$tgl_masuk;

					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>