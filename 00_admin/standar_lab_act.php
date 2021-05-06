<?
	session_start();
	require_once("../_lib/function/db.php");
	require_once("../_lib/function/function.olah_tabel.php");
	loadlib("function","function.cek_kiriman");
	loadlib("function","function.cek_kiriman");
	loadlib("function","function.max_kode_number");
    // cek_kiriman();
	 //$db->debug=true;
	//$cek_kode=baca_tabel("pm_mt_standarhasil","count(kode_mt_hasilpm)","where kode_tarif='".$kode_tarif."'");
	
	
	/* */


	$result = true;


	$db->BeginTrans();

	//////////////////////////////////////////////////////////////////////

	
	
	switch ($validasi) {

// TAMBAH //////////////////////////////////////////////////////////////////////////////////////
	case "1":
		$kode_tarif = substr($nama_tarif ,-9);
		$cek_kode=baca_tabel("pm_mt_standarhasil","max(kode_mt_hasilpm)","where kode_tarif='".$kode_tarif."'");
		$tambah_kode=substr($cek_kode,-3)+1;
		//$cek_kode=$cek_kode+1;
		$kode_mt_hasilpm=$kode_tarif."".$tambah_kode;

		$cek_ada=baca_tabel("pm_mt_standarhasil","kode_mt_hasilpm","where kode_mt_hasilpm=".$kode_mt_hasilpm);
		//print_r($cek_ada);
		if($cek_ada!=""){
			$kode_mt_pm=read_tabel("pm_mt_standarhasil","max(kode_mt_hasilpm) kd_mt","");
			$kd_mt = $kode_mt_pm->fields["kd_mt"];	
			
			$tambah_kode=substr($kd_mt,-3)+1;
			$kode_mt_hasilpm=$kode_tarif."".$tambah_kode;
			
			$cek_ada=baca_tabel("pm_mt_standarhasil","kode_mt_hasilpm"," where kode_mt_hasilpm='$kode_mt_hasilpm'");
			
			if($cek_ada!=""){
				$kode_mt_hasilpm=max_kode_number("pm_mt_standarhasil","kode_mt_hasilpm","");
			}
			
			
		}
		
		unset($insertPmMtStandarhasil);

		$insertPmMtStandarhasil["kode_mt_hasilpm"] = $kode_mt_hasilpm;
		$insertPmMtStandarhasil["kode_tarif"] = $kode_tarif;
		$insertPmMtStandarhasil["nama_pemeriksaan"] = $nama_pemeriksaan;
		$insertPmMtStandarhasil["kode_bagian"] = $kode_bagnya;


		if($kode_bagnya=='050201'){
			$insertPmMtStandarhasil["standar_rad"] = $standar_rad;
			$insertPmMtStandarhasil["kesan"] = $txt_kesan;
			$insertPmMtStandarhasil["anjuran"] = $txt_anjuran;

		}else{
			$masukan=array('<', '>');
			$pengganti=array('&lt;', '&gt;');
			$insertPmMtStandarhasil["standar_hasil_wanita"] = str_replace($masukan,$pengganti,$standar_hasil_wanita); 
			$insertPmMtStandarhasil["standar_hasil_pria"] = str_replace($masukan,$pengganti,$standar_hasil_pria);
			$insertPmMtStandarhasil["standar_hasil_wanita_min"] = $standar_hasil_wanita_min;
			$insertPmMtStandarhasil["standar_hasil_wanita_max"] = $standar_hasil_wanita_max;
			$insertPmMtStandarhasil["standar_hasil_pria_min"] = $standar_hasil_pria_min;
			$insertPmMtStandarhasil["standar_hasil_pria_max"] = $standar_hasil_pria_max;
			$insertPmMtStandarhasil["satuan"] = $satuan;

			$insertPmMtStandarhasil["umur_mulai"] = $umur_mulai;
			$insertPmMtStandarhasil["satuan_umur_mulai"] = $satuan_umur_mulai;
			$insertPmMtStandarhasil["umur_akhir"] = $umur_akhir;
			$insertPmMtStandarhasil["satuan_umur_akhir"] = $satuan_umur_mulai;

			$insertPmMtStandarhasil["detail_item_1"] = $detail_item_1;
			$insertPmMtStandarhasil["detail_item_2"] = $detail_item_2;
			$insertPmMtStandarhasil["keterangan_pemeriksaan_laki"] = $keterangan_pemeriksaan_laki;
			$insertPmMtStandarhasil["keterangan_pemeriksaan_perm"] = $keterangan_pemeriksaan_perm;
			$insertPmMtStandarhasil["keterangan"] = $keterangan;
		}
		

		$result = true;
		$db->BeginTrans();
		$result = insert_tabel("pm_mt_standarhasil", $insertPmMtStandarhasil);
		$db->CommitTrans($result !== false);

		break;

	// EDIT ///////////////////////////////////////////////////////////////////////////////////////
	case "2":
		unset($editPmMtStandarhasil);

		$editPmMtStandarhasil["kode_mt_hasilpm"] = $kode_mt_hasilpm;
		$editPmMtStandarhasil["kode_tarif"] = $kode_tarif;
		$editPmMtStandarhasil["nama_pemeriksaan"] = $nama_pemeriksaan;
		$editPmMtStandarhasil["kode_bagian"] = $kode_bagnya;

		
		if($kode_bagnya=='050201'){
			$editPmMtStandarhasil["standar_rad"] = $standar_rad;
			$editPmMtStandarhasil["kesan"] = $txt_kesan;
			$editPmMtStandarhasil["anjuran"] = $txt_anjuran;

		}else{
			$masukan=array('<', '>');
			$pengganti=array('&lt;', '&gt;');
			$editPmMtStandarhasil["standar_hasil_wanita"] = str_replace($masukan,$pengganti,$standar_hasil_wanita); 
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
			$editPmMtStandarhasil["keterangan_pemeriksaan_laki"] = $keterangan_pemeriksaan_laki;
			$editPmMtStandarhasil["keterangan_pemeriksaan_perm"] = $keterangan_pemeriksaan_perm;
			$editPmMtStandarhasil["keterangan"] = $keterangan;
		}
		$result = true;
		$db->BeginTrans();
		$result = update_tabel("pm_mt_standarhasil", $editPmMtStandarhasil, "WHERE kode_mt_hasilpm=$kode_mt_hasilpm");	
		$db->CommitTrans($result !== false);

		break;

	// HAPUS //////////////////////////////////////////////////////////////////////////////////////
	case "3":

		$result = true;
		$db->BeginTrans();
		$result = delete_tabel("pm_mt_standarhasil", "WHERE kode_mt_hasilpm=$kode_mt_hasilpm");	
		$db->CommitTrans($result !== false);

		break;

	}



	

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
 
