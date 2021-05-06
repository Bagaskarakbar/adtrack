<?
	session_start();
	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	// ==================== GET MR,REGIS, ===================//
	
	
	$Q_tarif="SELECT * FROM mt_master_tarif WHERE kode_bagian IN (010901,050101,050201)";
	$H_tarif=$db->Execute($Q_tarif);
	while($T_tarif=$H_tarif->fetchRow()){
		$data['tarif']['isi_tarif'][$T_tarif['kode_tarif']]=$T_tarif;
	}
	
	$Q_standarhasil="SELECT * FROM pm_mt_standarhasil";
	$H_standarhasil=$db->Execute($Q_standarhasil);
	while($T_standarhasil=$H_standarhasil->fetchRow()){
		$data['standarhasil']['isi_standarhasil'][$T_standarhasil['kode_mt_hasilpm']]=$T_standarhasil;
	}
	
	$Q_perusahaan="SELECT * FROM mt_perusahaan";
	$H_perusahaan=$db->Execute($Q_perusahaan);
	while($T_perusahaan=$H_perusahaan->fetchRow()){
		$data['perusahaan']['isi_perusahaan'][$T_perusahaan['kode_perusahaan']]=$T_perusahaan;
	}
	
	$Q_departement="SELECT * FROM dd_departement";
	$H_departement=$db->Execute($Q_departement);
	while($T_departement=$H_departement->fetchRow()){
		$data['departement']['isi_departement'][$T_departement['id_dd_departement']]=$T_departement;
	}
	
	$Q_kategori="SELECT * FROM dd_mcu_kategori_perusahaan";
	$H_kategori=$db->Execute($Q_kategori);
	while($T_kategori=$H_kategori->fetchRow()){
		$data['kategori']['isi_kategori'][$T_kategori['id_dd_mcu_kategori_perusahaan']]=$T_kategori;
	}
	
	$Q_riwayat="SELECT * FROM dd_riwayat_medis";
	$H_riwayat=$db->Execute($Q_riwayat);
	while($T_riwayat=$H_riwayat->fetchRow()){
		$data['riwayat']['isi_riwayat'][$T_riwayat['id_dd_riwayat_medis']]=$T_riwayat;
	}
	
	$Q_kesimpulan_mcu="SELECT * FROM mt_kesimpulan_mcu";
	$H_kesimpulan_mcu=$db->Execute($Q_kesimpulan_mcu);
	while($T_kesimpulan_mcu=$H_kesimpulan_mcu->fetchRow()){
		$data['kesimpulan_mcu']['isi_kesimpulan_mcu'][$T_kesimpulan_mcu['id_mt_kesimpulan_mcu']]=$T_kesimpulan_mcu;
	}
	
	echo json_encode($data);
?>