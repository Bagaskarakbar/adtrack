<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$input = json_decode(file_get_contents('php://input'),true); 
$no_kunjungan = $input['no_kunjungan'];
$gender = $input['gender'];
// $sql_query ="
// SELECT
// dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang,
// dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan,
// dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm,
// dbo.pm_tc_hasilpenunjang.hasil,
// dbo.pm_tc_hasilpenunjang.keterangan,
// dbo.pm_tc_hasilpenunjang.kesimpulan,
// dbo.pm_tc_hasilpenunjang.kesan,
// dbo.pm_tc_hasilpenunjang.url_foto,
// dbo.tc_trans_pelayanan.no_mr,
// dbo.pm_mt_standarhasil.nama_pemeriksaan,
// dbo.pm_mt_standarhasil.standar_hasil_wanita,
// dbo.pm_mt_standarhasil.standar_hasil_pria,
// dbo.mt_master_pasien.jen_kelamin,
// dbo.tc_trans_pelayanan.tgl_transaksi,
// dbo.tc_trans_pelayanan.no_registrasi,
// dbo.mt_karyawan.nama_pegawai

// FROM
// dbo.pm_tc_hasilpenunjang
// INNER JOIN dbo.tc_trans_pelayanan ON dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
// INNER JOIN dbo.pm_mt_standarhasil ON dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm
// INNER JOIN dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
// INNER JOIN dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter
// WHERE
// dbo.pm_mt_standarhasil.kode_bagian = '050101' AND
// dbo.tc_trans_pelayanan.no_mr = '$no_mr' AND
// dbo.tc_trans_pelayanan.no_kunjungan = '$no_kunjungan'
// ";

$sql_query="
SELECT
a.kode_tc_hasilpenunjang,
a.kode_trans_pelayanan,
a.kode_mt_hasilpm,
a.hasil,
a.keterangan,
a.kesimpulan,
a.kesan,
a.flag_mcu,
a.url_foto,
a.kode_trans_pelayanan_paket_mcu,
dbo.pm_mt_standarhasil.standar_hasil_pria,
dbo.pm_mt_standarhasil.standar_hasil_wanita,
dbo.pm_mt_standarhasil.nama_pemeriksaan

FROM
dbo.pm_tc_hasilpenunjang AS a
JOIN dbo.tc_trans_pelayanan AS b ON a.kode_trans_pelayanan = b.kode_trans_pelayanan
INNER JOIN dbo.pm_mt_standarhasil ON a.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm
WHERE
b.no_kunjungan = '$no_kunjungan'
";

$run_list_laboratori = $db->Execute($sql_query);
while($temp_laboratori_detail = $run_list_laboratori->fetchrow()){
	$laboratoriDataDetail['nama_pemeriksaan'] = $temp_laboratori_detail['nama_pemeriksaan'];
	if(strcmp($gender,"P")){
		$laboratoriDataDetail['standar_hasil'] = $temp_laboratori_detail['standar_hasil_wanita'];
	}
	elseif(strcmp($gender,"L")){
		$laboratoriDataDetail['standar_hasil'] = $temp_laboratori_detail['standar_hasil_wanita'];
	}
	$laboratoriDataDetail['hasil'] = $temp_laboratori_detail['hasil'];
	$arr['laboratoriDataDetail'][] = $laboratoriDataDetail;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
 ?>