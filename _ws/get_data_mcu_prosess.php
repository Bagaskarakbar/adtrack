<?
	set_time_limit(0);
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	// ==================== GET MR,REGIS, ===================//
	
	// $db->debug=true;
	$input = json_decode(file_get_contents('php://input'),true);
	$kode_perusahaan=$input['kode_perusahaan'];
	$GetPerusahaan="select no_registrasi, tc_registrasi.no_mr, tc_registrasi.kode_perusahaan, mt_master_pasien.nama_pasien, nama_departement, mt_master_pasien.posisi_pekerjaan, mt_master_pasien.id_dd_departement, mt_perusahaan.nama_perusahaan,  tc_registrasi.umur,  tc_registrasi.umur_hari,  tc_registrasi.umur_bulan,  mt_master_pasien.jen_kelamin from tc_registrasi join mt_master_pasien on tc_registrasi.no_mr=mt_master_pasien.no_mr join mt_perusahaan on tc_registrasi.kode_perusahaan=mt_perusahaan.kode_perusahaan LEFT JOIN dd_departement ON dd_departement.id_dd_departement=mt_master_pasien.id_dd_departement where tc_registrasi.kode_perusahaan='$kode_perusahaan' and kode_bagian_masuk='010901'";
	$ResPerusahaan=$db->Execute($GetPerusahaan);
	while($TmpPerusahaan=$ResPerusahaan->fetchRow())
	{
		$no_registrasi=$TmpPerusahaan["no_registrasi"];
		$no_mr=$TmpPerusahaan["no_mr"];	
		$arrReg[]=$no_registrasi;
		$arrMR[$no_registrasi]=$no_mr;
		$arrPasien[$no_registrasi]=$TmpPerusahaan["nama_pasien"];
		
		$arrRegistrasi[$no_registrasi]['mr']=$TmpPerusahaan["no_mr"];
		$arrRegistrasi[$no_registrasi]['nama_pasien']=$TmpPerusahaan["nama_pasien"];
		$arrRegistrasi[$no_registrasi]['departemen']=$TmpPerusahaan["nama_departement"];
		$arrRegistrasi[$no_registrasi]['posisi']=$TmpPerusahaan["posisi_pekerjaan"];
		$arrRegistrasi[$no_registrasi]['id_dd_departemen']=$TmpPerusahaan["id_dd_departement"];
		$arrRegistrasi[$no_registrasi]['nama_perusahaan']=$TmpPerusahaan["nama_perusahaan"];
		$arrRegistrasi[$no_registrasi]['umur']=$TmpPerusahaan["umur"];
		$arrRegistrasi[$no_registrasi]['umur_hari']=$TmpPerusahaan["umur_hari"];
		$arrRegistrasi[$no_registrasi]['umur_bulan']=$TmpPerusahaan["umur_bulan"];
		$arrRegistrasi[$no_registrasi]['jen_kelamin']=$TmpPerusahaan["jen_kelamin"];
		// $db->debug=true;
		//==================== tc_registrasi =============================================//
		$Q_registrasi="SELECT * FROM tc_registrasi WHERE kode_bagian_masuk='010901' and year(tgl_jam_masuk)>2016 and no_registrasi=$no_registrasi";
		$H_registrasi=$db->Execute($Q_registrasi);
		
		// $db->debug=false;
		$a=0;
		while($T_registrasi=$H_registrasi->fetchRow()){
			
			$hasilAll['registrasi'][$T_registrasi['id_tc_registrasi']]['isi_registrasi'][$a]=$T_registrasi;
			$a++;
		}
	}
	//=============== Get Kunjungan =======================//
	foreach($arrReg as $key=>$regis)
	{
		// $db->debug=true;
		$GetKunjungan="select no_kunjungan,no_registrasi,kode_bagian_asal,kode_bagian_tujuan,nama_bagian from tc_kunjungan join mt_bagian on tc_kunjungan.kode_bagian_tujuan=mt_bagian.kode_bagian where no_registrasi='$regis'";
		$ResKunjungan=$db->Execute($GetKunjungan);
		while($TmpKunjungan=$ResKunjungan->fetchRow())
		{
			$datax[$TmpKunjungan["no_kunjungan"]]["no_registrasi"]=$regis;
			$datax[$TmpKunjungan["no_kunjungan"]]["no_mr"]=$arrRegistrasi[$regis]["mr"];
			$datax[$TmpKunjungan["no_kunjungan"]]["no_kunjungan"]=$TmpKunjungan["no_kunjungan"];
			$datax[$TmpKunjungan["no_kunjungan"]]["kode_bagian"]=$TmpKunjungan["kode_bagian_tujuan"];
			$datax[$TmpKunjungan["no_kunjungan"]]["nama_bagian"]=$TmpKunjungan["nama_bagian"];
			$datax[$TmpKunjungan["no_kunjungan"]]["nama_pasien"]=$arrRegistrasi[$regis]["nama_pasien"];
			$datax[$TmpKunjungan["no_kunjungan"]]["departemen"]=$arrRegistrasi[$regis]["departemen"];
			$datax[$TmpKunjungan["no_kunjungan"]]["nama_departemen"]=$arrRegistrasi[$regis]["departemen"];
			$datax[$TmpKunjungan["no_kunjungan"]]["id_dd_departemen"]=$arrRegistrasi[$regis]["id_dd_departemen"];
			$datax[$TmpKunjungan["no_kunjungan"]]["nama_perusahaan"]=$arrRegistrasi[$regis]["nama_perusahaan"];
			$datax[$TmpKunjungan["no_kunjungan"]]["posisi"]=$arrRegistrasi[$regis]["posisi"];
			$datax[$TmpKunjungan["no_kunjungan"]]["umur"]=$arrRegistrasi[$regis]["umur"];
			$datax[$TmpKunjungan["no_kunjungan"]]["umur_hari"]=$arrRegistrasi[$regis]["umur_hari"];
			$datax[$TmpKunjungan["no_kunjungan"]]["umur_bulan"]=$arrRegistrasi[$regis]["umur_bulan"];
			$datax[$TmpKunjungan["no_kunjungan"]]["jenis_kelamin"]=$arrRegistrasi[$regis]["jen_kelamin"];
			$datax[$TmpKunjungan["no_kunjungan"]]["jen_kelamin"]=$arrRegistrasi[$regis]["jen_kelamin"];
			$datax[$TmpKunjungan["no_kunjungan"]]["kode_perusahaan"]=$kode_perusahaan;
			
			
			$dataAll[$TmpKunjungan["no_kunjungan"]]['kode_bagian']=$TmpKunjungan["kode_bagian_tujuan"];
			$dataAll[$TmpKunjungan["no_kunjungan"]]['no_kunjungan']=$TmpKunjungan["no_kunjungan"];
			
			$arr_kunjungan[$regis]['no_mr']=$arrRegistrasi[$regis]["mr"];
			$arr_kunjungan[$regis]['nama_pasien']=$arrRegistrasi[$regis]["nama_pasien"];
			$arr_kunjungan[$regis]['nama_perusahaan']=$arrRegistrasi[$regis]["nama_perusahaan"];
			$arr_kunjungan[$regis]['no_kunjungan']=$TmpKunjungan["no_kunjungan"];
			$arr_kunjungan[$regis]['id_dd_departemen']=$arrRegistrasi[$regis]["id_dd_departemen"];
			$arr_kunjungan[$regis]['nama_departemen']=$arrRegistrasi[$regis]["departemen"];
			$arr_kunjungan[$regis]['posisi']=$arrRegistrasi[$regis]["posisi"];
			$arr_kunjungan[$regis]['kode_bagian']=$arrRegistrasi[$regis]["kode_bagian_tujuan"];
			$arr_kunjungan[$regis]['nama_bagian']=$TmpKunjungan["nama_bagian"];
			$arr_kunjungan[$regis]['umur']=$arrRegistrasi[$regis]["umur"];
			$arr_kunjungan[$regis]['umur_hari']=$arrRegistrasi[$regis]["umur_hari"];
			$arr_kunjungan[$regis]['umur_bulan']=$arrRegistrasi[$regis]["umur_bulan"];
			$arr_kunjungan[$regis]['jenis_kelamin']=$arrRegistrasi[$regis]["jen_kelamin"];
			$arr_kunjungan[$regis]['kode_perusahaan']=$kode_perusahaan;
		}
		
		//=========================================================//
		if(is_array($arr_kunjungan[$regis])){
		
			$Q_tc_kesimpulan="SELECT * FROM tc_kesimpulan_mcu WHERE no_registrasi = $regis";
			$H_tc_kesimpulan=$db->Execute($Q_tc_kesimpulan);
			$x=0;
			while($T_tc_kesimpulan=$H_tc_kesimpulan->fetchRow())
			{
				foreach($arr_kunjungan[$regis] as $key_x=>$val_x){
					$T_tc_kesimpulan[$key_x]=$val_x;
				}
				$hasilAll['kesimpulan_mcu'][$T_tc_kesimpulan['id_tc_kesimpulan_mcu']]['hasil_kesimpulan_mcu'][$x]=$T_tc_kesimpulan;
				
				$x++;
			}
		}
		
		//=========================================================//
	}
	
	//==================== Isi Hasil =============================================//
	foreach($dataAll as $key=>$val)
	{
		if($val['kode_bagian']=='050101' || $val['kode_bagian']=='050201')
		{
			$get_kode_penunjang="select kode_penunjang from pm_tc_penunjang where no_kunjungan='$key'";
			$res_kode_penunjang=$db->Execute($get_kode_penunjang);
			$kode_penunjang=$res_kode_penunjang->fields('kode_penunjang');
			$get_kode_trans_pelayanan_paket_mcu="select kode_trans_pelayanan_paket_mcu from tc_trans_pelayanan_paket_mcu where kode_penunjang='$kode_penunjang'";
			$res_kode_trans_pelayanan_paket_mcu=$db->Execute($get_kode_trans_pelayanan_paket_mcu);
			$kode_trans_pelayanan_paket_mcu=$res_kode_trans_pelayanan_paket_mcu->fields('kode_trans_pelayanan_paket_mcu');
			$get_pm_tc_hasilpenunjang="select * from pm_tc_hasilpenunjang where kode_trans_pelayanan_paket_mcu='$kode_trans_pelayanan_paket_mcu'";
			$res_pm_tc_hasilpenunjang=$db->Execute($get_pm_tc_hasilpenunjang);
			while($tmp_pm_tc_hasilpenunjang=$res_pm_tc_hasilpenunjang->fetchRow())
			{
				
				$datax[$key]["hasil_lab"][]=$tmp_pm_tc_hasilpenunjang;
				
			}
			
			$hasilAll['lab'][]=$datax[$key];	
			
		}
		
		//==================== tc_pemeriksaan_fisik =============================================//
		
		$Q_pem_fisik="SELECT * FROM tc_pemeriksaan_fisik WHERE no_kunjungan='$key'";
		$H_pem_fisik=$db->Execute($Q_pem_fisik);
		$a=0;
		while($T_pem_fisik=$H_pem_fisik->fetchRow()){
			foreach($datax[$key] as $keya=>$vala){
				$T_pem_fisik[$keya]=$vala;
			}
			$hasilAll['pemeriksaan_fisik'][$T_pem_fisik['id_tc_pemeriksaan_fisik']]['hasil_pemeriksaan_fisik'][$a]=$T_pem_fisik;
			$a++;
		}
		
		//==================== tc_pemeriksaan_fisik_mcu =============================================//
		
		$Q_pem_fisik_mcu="SELECT tc_pemeriksaan_fisik_mcu.* FROM tc_pemeriksaan_fisik_mcu INNER JOIN pl_tc_poli ON pl_tc_poli.kode_gcu=tc_pemeriksaan_fisik_mcu.kode_mcu WHERE no_kunjungan='$key'";
		$H_pem_fisik_mcu=$db->Execute($Q_pem_fisik_mcu);
		$a=0;
		while($T_pem_fisik_mcu=$H_pem_fisik_mcu->fetchRow()){
			foreach($datax[$key] as $keya=>$vala){
				$T_pem_fisik_mcu[$keya]=$vala;
			}
			$hasilAll['pemeriksaan_fisik_mcu'][$T_pem_fisik_mcu['id_tc_pemeriksaan_fisik_mcu']]['hasil_pemeriksaan_fisik_mcu'][$a]=$T_pem_fisik_mcu;
			$a++;
		}
		
		//==================== tc_trans_pelayanan_paket_mcu =============================================//
		
		$Q_paket_mcu="SELECT * FROM tc_trans_pelayanan_paket_mcu WHERE no_kunjungan='$key'";
		$H_paket_mcu=$db->Execute($Q_paket_mcu);
		$a=0;
		while($T_paket_mcu=$H_paket_mcu->fetchRow()){
			
			$hasilAll['paket_mcu'][$T_paket_mcu['kode_trans_pelayanan_paket_mcu']]['isi_paket_mcu'][$a]=$T_paket_mcu;
			$a++;
		}
		
		//==================== pm_tc_penunjang =============================================//
		
		$Q_penunjang="SELECT * FROM pm_tc_penunjang WHERE no_kunjungan='$key'";
		$H_penunjang=$db->Execute($Q_penunjang);
		$a=0;
		while($T_penunjang=$H_penunjang->fetchRow()){
			
			$hasilAll['penunjang'][$T_penunjang['id_pm_tc_penunjang']]['isi_penunjang'][$a]=$T_penunjang;
			$a++;
		}
		
		
		
		//==================== tc_pemeriksaan_fisik_mcu =============================================//
		
		$Q_riwayat_medis="SELECT * FROM tc_riwayat_medis WHERE no_kunjungan='$key'";
		$H_riwayat_medis=$db->Execute($Q_riwayat_medis);
		$a=0;
		while($T_riwayat_medis=$H_riwayat_medis->fetchRow()){
			foreach($datax[$key] as $keya=>$vala){
				$T_riwayat_medis[$keya]=$vala;
			}
			$hasilAll['riwayat_medis'][$T_riwayat_medis['id_tc_riwayat_medis']]['isi_riwayat_medis'][$a]=$T_riwayat_medis;
			$a++;
		}
		
		
		
		//==================== mcu_tc_hasil =============================================//
		// $db->debug=true;
		$Q_tc_hasil="SELECT * FROM mcu_tc_hasil INNER JOIN pl_tc_poli ON pl_tc_poli.kode_gcu=mcu_tc_hasil.kode_mcu WHERE no_kunjungan='$key'";
		$H_tc_hasil=$db->Execute($Q_tc_hasil);
		$a=0;
		$db->debug=false;
		while($T_tc_hasil=$H_tc_hasil->fetchRow()){
			if($T_tc_hasil['kode_tc_hasilMcu']!=""){
				foreach($datax[$key] as $keya=>$vala){
					$T_tc_hasil[$keya]=$vala;
				}
				$hasilAll['tc_hasil'][$T_tc_hasil['kode_tc_hasilMcu']]['isi_tc_hasil'][$a]=$T_tc_hasil;
				$a++;
			}
		}
		
		
		
		
	}
	
	// echo "<pre>";
	// print_r($hasilAll);
	// echo "</pre>";
	// die;
	
	//==================== Isi Hasil =============================================//	
	echo json_encode($hasilAll);
?>