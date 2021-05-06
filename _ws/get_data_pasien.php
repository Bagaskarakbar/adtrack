<?
	ini_set('memory_limit','256M');
	set_time_limit(0);
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	$GetPerusahaan="select top 15000 * from mt_master_pasien";
	
	$ResPerusahaan=$db->Execute($GetPerusahaan);
	while($TmpPerusahaan=$ResPerusahaan->fetchRow())
	{
		$datax[]=$TmpPerusahaan;
	}
	echo json_encode($datax);
?>