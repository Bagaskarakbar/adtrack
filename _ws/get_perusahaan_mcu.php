<?
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	$GetPerusahaan="select nama_perusahaan,kode_perusahaan from mt_perusahaan where kode_perusahaan in  (select kode_perusahaan from tc_registrasi as a inner join tc_pemeriksaan_fisik as b on a.no_registrasi=b.no_registrasi where kode_bagian_masuk='010901' and kode_perusahaan is not null group by kode_perusahaan) ORDER BY nama_perusahaan";
	
	$ResPerusahaan=$db->Execute($GetPerusahaan);
	while($TmpPerusahaan=$ResPerusahaan->fetchRow())
	{
		$datax[]=$TmpPerusahaan;
	}
	echo json_encode($datax);
?>