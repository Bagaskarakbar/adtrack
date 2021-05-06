<?php
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
$input = json_decode(file_get_contents('php://input'),true);

$username = "'".$input["username"]."'";
$password = $input["password"];

$passwordmd5 = "'".md5($password)."'";

$SqlCekLogin="SELECT
dbo.mt_karyawan.nama_pegawai, dbo.mt_spesialisasi_dokter.nama_spesialisasi, dbo.mt_karyawan.url_foto_karyawan, dbo.mt_karyawan.kode_dokter,dbo.dd_user.id_dd_user
FROM
dbo.mt_karyawan
INNER JOIN dbo.dd_user ON dbo.mt_karyawan.no_induk = dbo.dd_user.no_induk
INNER JOIN dbo.mt_spesialisasi_dokter ON dbo.mt_karyawan.kode_spesialisasi = dbo.mt_spesialisasi_dokter.kode_spesialisasi
WHERE
dbo.mt_karyawan.kode_dokter IS NOT NULL AND
dbo.dd_user.username=$username AND
dbo.dd_user.password=$passwordmd5";

$RunCekLogin = $db->Execute($SqlCekLogin);
while ($tempdatalogin = $RunCekLogin->fetchrow()) {
	$arr['nama_pegawai'] = $tempdatalogin['nama_pegawai'];
	$arr['nama_spesialisasi'] = $tempdatalogin['nama_spesialisasi'];
	$arr['url_foto_karyawan'] = str_replace("../","",$tempdatalogin['url_foto_karyawan']);
	$arr['kode_dokter'] = $tempdatalogin['kode_dokter'];
	$arr['id_dd_user'] = $tempdatalogin['id_dd_user'];
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>