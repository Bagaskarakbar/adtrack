<?
	session_start();
	require_once("../_lib/function/db.php");
	require_once("../_lib/function/function.olah_tabel.php");
	// $db->debug=true;
	$result = true;

	$db->BeginTrans();

	//////////////////////////////////////////////////////////////////////

	unset($editPmMtStandarhasil);

	//$editPmMtStandarhasil["kode_mt_hasilpm"] = $kode_mt_hasilpm;
	//$editPmMtStandarhasil["kode_tarif"] = $kode_tarif;
	$editPmMtStandarhasil["nama_pemeriksaan"] = $nama_pemeriksaan;
	
	//$editPmMtStandarhasil["kode_bagian"] = $kode_bagian;
	if($kode_bagian=='050201'){
		$editPmMtStandarhasil["standar_rad"] = $standar_rad;
		$editPmMtStandarhasil["kesan"] = $txt_kesan;
		$editPmMtStandarhasil["anjuran"] = $txt_anjuran;
	}else{
		$masukan=array('<', '>');
		$pengganti=array('&lt;', '&gt;');
		$editPmMtStandarhasil["standar_hasil_wanita"] =  str_replace($masukan,$pengganti,$standar_hasil_wanita); 
		$editPmMtStandarhasil["standar_hasil_pria"] = str_replace($masukan,$pengganti,$standar_hasil_pria);
		$editPmMtStandarhasil["standar_hasil_wanita_min"] = $standar_hasil_wanita_min;
		$editPmMtStandarhasil["standar_hasil_wanita_max"] = $standar_hasil_wanita_max;
		$editPmMtStandarhasil["standar_hasil_pria_min"] = $standar_hasil_pria_min;
		$editPmMtStandarhasil["standar_hasil_pria_max"] = $standar_hasil_pria_max;
		$editPmMtStandarhasil["satuan"] = $satuan;
		$editPmMtStandarhasil["umur_mulai"] = $umur_mulai;
		$editPmMtStandarhasil["satuan_umur_mulai"] = $satuan_umur_mulai;
		$editPmMtStandarhasil["umur_akhir"] = $umur_akhir;
		$editPmMtStandarhasil["satuan_umur_akhir"] = $satuan_umur_mulai;
		$editPmMtStandarhasil["detail_item_1"] = $detail_item_1;
	    $editPmMtStandarhasil["detail_item_2"] = $detail_item_2;
		$editPmMtStandarhasil["keterangan"] = $keterangan;
		$editPmMtStandarhasil["keterangan_pemeriksaan_perm"] = $keterangan_pemeriksaan_perm;
		
	}
	$result = update_tabel("pm_mt_standarhasil", $editPmMtStandarhasil, "WHERE kode_mt_hasilpm='".$kode_mt_hasilpm."'");

	//////////////////////////////////////////////////////////////////////
// $result=false;
// die;
	
	$db->CommitTrans($result !== false);
	//////////////////////////////////////////////////////////////////////
	if($result){
		$data['code']='200';
	}else{
		$data['code']='500';
	}
	echo json_encode($data);
?>				