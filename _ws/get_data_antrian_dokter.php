<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);
$kode_dokter = $input['kode_dokter'];
$modul = $input['modul'];

$umum = 0;
$asuransi = 0;
$bpjs = 0;
$jml_pasien = 0;

if($modul == 1){
	$sql_query_tambahan = "";
}
elseif($modul == 2){
	$sql_query_tambahan ="AND dbo.pl_tc_poli.status_selesai_poli != 1";
}

$sql_query = "SELECT DISTINCT
dbo.pl_tc_poli.id_pl_tc_poli,
dbo.pl_tc_poli.nama_pasien,
dbo.mt_nasabah.nama_kelompok,
dbo.mt_master_pasien.url_foto,
dbo.pl_tc_poli.tgl_jam_poli,
dbo.pl_tc_poli.no_antrian,
dbo.tc_kunjungan.no_mr,
dbo.tc_kunjungan.no_kunjungan,
dbo.tc_kunjungan.no_registrasi,
dbo.pl_tc_poli.kode_bagian,
dbo.mt_master_pasien.kode_kelompok,
dbo.mt_master_pasien.kode_perusahaan
FROM
dbo.pl_tc_poli
LEFT JOIN dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
INNER JOIN dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
INNER JOIN dbo.mt_nasabah ON dbo.mt_master_pasien.kode_kelompok = dbo.mt_nasabah.kode_kelompok
WHERE
dbo.pl_tc_poli.kode_dokter = '$kode_dokter' AND
dbo.pl_tc_poli.tgl_jam_poli BETWEEN '2020-02-19 00:00:00' AND '2020-02-19 23:59:59'
$sql_query_tambahan
ORDER BY dbo.pl_tc_poli.no_antrian ASC";

$runGetAntrian = $db->Execute($sql_query);
while($tempDataAntrian=$runGetAntrian->fetchrow()){
	$datapasien['id_pl_tc_poli']=$tempDataAntrian['id_pl_tc_poli'];
	$datapasien['nama_pasien']=$tempDataAntrian['nama_pasien'];
	$datapasien['url_foto']=$tempDataAntrian['url_foto'];
	$datapasien['nama_kelompok']=$tempDataAntrian['nama_kelompok'];
	$datapasien['tgl_jam_poli']=$tempDataAntrian['tgl_jam_poli'];
	$datapasien['no_antrian']=$tempDataAntrian['no_antrian'];
	$datapasien['no_kunjungan']=$tempDataAntrian['no_kunjungan'];
	$datapasien['no_registrasi']=$tempDataAntrian['no_registrasi'];
	$datapasien['no_mr'] = $tempDataAntrian['no_mr'];
	$datapasien['kode_bagian'] = $tempDataAntrian['kode_bagian'];
	$datapasien['kode_kelompok'] = $tempDataAntrian['kode_kelompok'];
	$datapasien['kode_perusahaan'] = $tempDataAntrian['kode_perusahaan'];

	switch ($tempDataAntrian['nama_kelompok']) {
		case 'Umum':
		$umum++;
		break;
		case 'Asuransi/Perusahaan':
		$asuransi++;
		break;
		case 'BPJS':
		$bpjs++;
		break;
	}
	$jml_pasien++;

	$arr['datapasien'][]=$datapasien;
}


if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['umum'] = $umum;
	$arr['asuransi'] = $asuransi;
	$arr['bpjs'] = $bpjs;
	$arr['jml_pasien'] = $jml_pasien;
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>