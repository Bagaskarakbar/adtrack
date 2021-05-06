<?

// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);
session_start();
require_once("../_lib/function/db.php");
loadlib("function","variabel");
loadlib("function","function.olah_tabel");
// $db->debug= true;
switch($act){
	case "add": 
	list ($status1,$hari1) = split (";", $senin);
	list ($status2,$hari2) = split (";", $selasa);
	list ($status3,$hari3) = split (";", $rabu);
	list ($status4,$hari4) = split (";", $kamis);
	list ($status5,$hari5) = split (";", $jumat);
	list ($status6,$hari6) = split (";", $sabtu);
	list ($status7,$hari7) = split (";", $minggu);

	$range_hari = "";
	if ($hari1!="") $range_hari .= $hari1.",";
	if ($hari2!="") $range_hari .= $hari2.",";
	if ($hari3!="") $range_hari .= $hari3.",";
	if ($hari4!="") $range_hari .= $hari4.",";
	if ($hari5!="") $range_hari .= $hari5.",";
	if ($hari6!="") $range_hari .= $hari6.",";
	if ($hari7!="") $range_hari .= $hari7.",";

	

	
	$range=substr($range_hari,0,-1);


	// $db->debug=true;

	$result = true;

	$db->BeginTrans();

	//////////////////////////////////////////////////////////////////////

	unset($addMtJadwalDokter);
	$addMtJadwalDokter["id_mt_jadwal_dokter"] = $id_mt_jadwal_dokter;
	$addMtJadwalDokter["kode_dokter"] = $kode_dokter;
	$addMtJadwalDokter["kode_bagian"] = $kode_bagian;
	$addMtJadwalDokter["range_hari"] = $range;
	$addMtJadwalDokter["jam_mulai"] = date("Y-m-d")." ".$jam_awal.":".$menit_awal.":00";
	$addMtJadwalDokter["jam_akhir"] = date("Y-m-d")." ".$jam_akhir.":".$menit_akhir.":00";
	$addMtJadwalDokter["senin"] = $status1;
	$addMtJadwalDokter["selasa"] = $status2;
	$addMtJadwalDokter["rabu"] = $status3;
	$addMtJadwalDokter["kamis"] = $status4;
	$addMtJadwalDokter["jumat"] = $status5;
	$addMtJadwalDokter["sabtu"] = $status6;
	$addMtJadwalDokter["minggu"] = $status7;
	$addMtJadwalDokter["tgl_input"] = date("Y-m-d")." "."18:00".":00";
	$addMtJadwalDokter["waktu_periksa"] = $waktu_periksa;
	$result = insert_tabel("mt_jadwal_dokter", $addMtJadwalDokter);

	//////////////////////////////////////////////////////////////////////

	$db->CommitTrans($result !== false);

	break;

	case "edit":
	list ($status1,$hari1) = split (";", $senin);
	list ($status2,$hari2) = split (";", $selasa);
	list ($status3,$hari3) = split (";", $rabu);
	list ($status4,$hari4) = split (";", $kamis);
	list ($status5,$hari5) = split (";", $jumat);
	list ($status6,$hari6) = split (";", $sabtu);
	list ($status7,$hari7) = split (";", $minggu);

	$range_hari = "";
	if ($hari1!="") $range_hari .= $hari1.",";
	if ($hari2!="") $range_hari .= $hari2.",";
	if ($hari3!="") $range_hari .= $hari3.",";
	if ($hari4!="") $range_hari .= $hari4.",";
	if ($hari5!="") $range_hari .= $hari5.",";
	if ($hari6!="") $range_hari .= $hari6.",";
	if ($hari7!="") $range_hari .= $hari7.",";




	$range=substr($range_hari,0,-1);


	// $db->debug=true;

	$result = true;

	$db->BeginTrans();

	//////////////////////////////////////////////////////////////////////

	unset($editMtJadwalDokter);

	$editMtJadwalDokter["range_hari"] = $range;
	$editMtJadwalDokter["jam_mulai"] = date("Y-m-d")." ".$jam_awal.":".$menit_awal.":00";
	$editMtJadwalDokter["jam_akhir"] = date("Y-m-d")." ".$jam_akhir.":".$menit_akhir.":00";
	$editMtJadwalDokter["senin"] = $status1;
	$editMtJadwalDokter["selasa"] = $status2;
	$editMtJadwalDokter["rabu"] = $status3;
	$editMtJadwalDokter["kamis"] = $status4;
	$editMtJadwalDokter["jumat"] = $status5;
	$editMtJadwalDokter["sabtu"] = $status6;
	$editMtJadwalDokter["minggu"] = $status7;
	$editMtJadwalDokter["waktu_periksa"] = $waktu_periksa;
	$result = update_tabel("mt_jadwal_dokter", $editMtJadwalDokter, "WHERE id_mt_jadwal_dokter=$id_mt_jadwal_dokter");

	//////////////////////////////////////////////////////////////////////

	$db->CommitTrans($result !== false);
	break;
}


if($result){
	$data['code']=200;
	echo json_encode($data);
}else{
	$data['code']=500;
	echo json_encode($data);
}
die();
?>










