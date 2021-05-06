<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$no_mr = $input['no_mr'];
// $year = $input['year'];
// $month = $input['month'];

$sql_riwayat_pasien = "SELECT TOP 10
dbo.th_riwayat_pasien.no_registrasi,
dbo.th_riwayat_pasien.tgl_periksa,
dbo.th_riwayat_pasien.dokter_pemeriksa,
dbo.th_riwayat_pasien.diagnosa_akhir,
dbo.th_riwayat_pasien.kode_bagian,
dbo.th_riwayat_pasien.icd_10,
dbo.tc_kunjungan.kode_bagian_tujuan,
dbo.mt_bagian.nama_bagian
FROM
dbo.th_riwayat_pasien
INNER JOIN dbo.tc_kunjungan ON dbo.th_riwayat_pasien.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
INNER JOIN dbo.mt_bagian ON dbo.th_riwayat_pasien.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE
dbo.th_riwayat_pasien.no_mr = $no_mr
ORDER BY dbo.th_riwayat_pasien.tgl_periksa DESC
";
/*AND YEAR(dbo.th_riwayat_pasien.tgl_periksa) = $year AND MONTH(dbo.th_riwayat_pasien.tgl_periksa) = $month*/

$run_riwayat_pasien =$db->Execute($sql_riwayat_pasien);
while($tempRiwayatPasien = $run_riwayat_pasien->fetchrow()){
	$Lab = 0;
	$Rad = 0;
	$Fisio = 0;

	$daftarRiwayatPasien['tgl_periksa'] = $tempRiwayatPasien['tgl_periksa'];
	$daftarRiwayatPasien['nama_bagian'] = $tempRiwayatPasien['nama_bagian'];
	$daftarRiwayatPasien['diagnosa_akhir'] = $tempRiwayatPasien['diagnosa_akhir'];
	$daftarRiwayatPasien['dokter_pemeriksa'] = $tempRiwayatPasien['dokter_pemeriksa'];
	$daftarRiwayatPasien['icd_10'] = $tempRiwayatPasien['icd_10'];
	$daftarRiwayatPasien['kode_bagian_tujuan'] = $tempRiwayatPasien['kode_bagian_tujuan'];
	$daftarRiwayatPasien['no_registrasi'] = $tempRiwayatPasien['no_registrasi'];
	
	$noreg = $tempRiwayatPasien['no_registrasi'];

	$sqlcarirujukan = "SELECT 
	SUM(case when kode_bagian_tujuan = '050101' then 1 else 0 end) AS Lab,
	SUM(case when kode_bagian_tujuan = '050201' then 1 else 0 end) AS Rad,
	SUM(case when kode_bagian_tujuan = '050301' then 1 else 0 end) AS Fisio
	FROM [dbo].[tc_kunjungan] where no_registrasi = $noreg";

	$runcarirujukan = $db->Execute($sqlcarirujukan);
	while ($tempRujukan = $runcarirujukan->fetchrow()) {
		if ($tempRujukan['Lab']>0) {
			$Lab= 1;
		}
		if ($tempRujukan['Rad']>0) {
			$Rad = 1;
		}
		if ($tempRujukan['Fisio']>0) {
			$Fisio = 1;
		}
	};

	$daftarRiwayatPasien['Lab'] = $Lab;
	$daftarRiwayatPasien['Rad'] = $Rad;
	$daftarRiwayatPasien['Fisio'] = $Fisio;

	$arr['daftarRiwayatPasien'][] = $daftarRiwayatPasien;

};

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>