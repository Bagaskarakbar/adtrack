<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$no_mr = $input['no_mr'];
// $year = $input['year'];
// $month = $input['month'];

$sql_query ="
SELECT TOP 10
dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang,
dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan,
dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm,
dbo.pm_tc_hasilpenunjang.hasil,
dbo.pm_tc_hasilpenunjang.keterangan,
dbo.pm_tc_hasilpenunjang.kesimpulan,
dbo.pm_tc_hasilpenunjang.kesan,
dbo.pm_tc_hasilpenunjang.url_foto,
dbo.tc_trans_pelayanan.no_mr,
dbo.pm_mt_standarhasil.nama_pemeriksaan,
dbo.pm_mt_standarhasil.standar_hasil_wanita,
dbo.pm_mt_standarhasil.standar_hasil_pria,
dbo.mt_master_pasien.jen_kelamin,
dbo.tc_trans_pelayanan.tgl_transaksi,
dbo.tc_trans_pelayanan.no_registrasi,
dbo.mt_karyawan.nama_pegawai
FROM
dbo.pm_tc_hasilpenunjang
INNER JOIN dbo.tc_trans_pelayanan ON dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
INNER JOIN dbo.pm_mt_standarhasil ON dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm
INNER JOIN dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
INNER JOIN dbo.mt_karyawan ON dbo.tc_trans_pelayanan.kode_dokter1 = dbo.mt_karyawan.kode_dokter
WHERE
dbo.pm_mt_standarhasil.kode_bagian = '050201' AND
dbo.tc_trans_pelayanan.no_mr = '$no_mr'
ORDER BY
dbo.tc_trans_pelayanan.tgl_transaksi DESC
";
/*AND YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) = $year AND MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) = $month */


$run_list_radiologi = $db->Execute($sql_query);
while($temp_radiologi = $run_list_radiologi->fetchrow()){
	$radiologiData['tgl_transaksi'] = $temp_radiologi['tgl_transaksi'];
	$radiologiData['nama_tindakan'] = $temp_radiologi['nama_pemeriksaan'];
	$radiologiData['temuan'] = $temp_radiologi['hasil'];
	$radiologiData['kesan'] = $temp_radiologi['kesan'];
	$radiologiData['url_foto'] = $temp_radiologi['url_foto'];
	if(strcmp($radiologiData['url_foto'],"null")){
		$radiologiData['url_foto'] = "empty";
	}
	else{
		$radiologiData['url_foto'] = $temp_radiologi['url_foto'];
	}
	$radiologiData['no_registrasi'] = $temp_radiologi['no_registrasi'];
	$arr['radiologiData'][] = $radiologiData;
}
if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
 ?>