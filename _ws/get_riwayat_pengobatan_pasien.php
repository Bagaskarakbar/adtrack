<?php 
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");

$input = json_decode(file_get_contents('php://input'),true);
$no_mr = $input["no_mr"];
$no_registrasi = $input["no_registrasi"];
$sql_query = "
SELECT
dbo.mt_bagian.nama_bagian,
dbo.tc_trans_pelayanan.nama_tindakan,
dbo.tc_trans_pelayanan.no_registrasi,
dbo.tc_trans_pelayanan.no_mr,
dbo.tc_trans_pelayanan.tgl_transaksi,
dbo.mt_jenis_tindakan.nama_jenis_tindakan,
dbo.mt_bagian.validasi
FROM
dbo.mt_bagian
INNER JOIN dbo.tc_trans_pelayanan ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
INNER JOIN dbo.mt_jenis_tindakan ON dbo.tc_trans_pelayanan.jenis_tindakan = dbo.mt_jenis_tindakan.jenis_tindakan
WHERE
dbo.tc_trans_pelayanan.no_mr = $no_mr AND 
dbo.tc_trans_pelayanan.no_registrasi = $no_registrasi AND
dbo.tc_trans_pelayanan.jenis_tindakan != 1 AND
dbo.tc_trans_pelayanan.jenis_tindakan != 2 AND
dbo.tc_trans_pelayanan.jenis_tindakan != 13 AND
dbo.tc_trans_pelayanan.jenis_tindakan != 15 AND
dbo.tc_trans_pelayanan.jenis_tindakan != 16
";

$run_sql_query = $db->Execute($sql_query);
while($data = $run_sql_query->fetchrow()){
	$validasi = $data['validasi'];
	if ($validasi == '0100' || $validasi == '0200' || $validasi == '0300' ) {
		$tempRiwayat['nama_tindakan'] = $data['nama_tindakan'];
		$tempRiwayat['nama_jenis_tindakan'] = $data['nama_jenis_tindakan'];
		$arr['riwayatPengobatan'][] = $tempRiwayat;
	}
}
if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>