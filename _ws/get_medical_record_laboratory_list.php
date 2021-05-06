<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$input = json_decode(file_get_contents('php://input'),true);
$no_mr = $input['no_mr'];
// $year = $input['year'];
// $month = $input['month'];

$sql_query ="
SELECT TOP 10 c.*,a.no_mr,d.jen_kelamin from tc_kunjungan a
join tc_registrasi b on a.no_registrasi=b.no_registrasi
join pm_tc_penunjang c on a.no_kunjungan=c.no_kunjungan
join mt_master_pasien d on b.no_mr=d.no_mr
where b.no_mr='$no_mr' AND c.kode_bagian='050101' AND tgl_isihasil is not null 
ORDER BY tgl_isihasil DESC
";
/*AND YEAR(tgl_isihasil) = $year AND MONTH(tgl_isihasil) = $month */

$run_list_laboratori = $db->Execute($sql_query);
while($temp_laboratori = $run_list_laboratori->fetchrow()){
	$laboratoriData['tgl_transaksi'] = $temp_laboratori['tgl_isihasil'];
	$laboratoriData['no_kunjungan'] = $temp_laboratori['no_kunjungan'];
	$laboratoriData['nama_dokter'] = $temp_laboratori['dr_pengirim'];
	$laboratoriData['diagnosa'] = $temp_laboratori['diagnosa'];
	$arr['laboratoriData'][] = $laboratoriData;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>