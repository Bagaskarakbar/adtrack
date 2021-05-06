<?
	session_start();
	require_once("../_lib/function/db.php");
	require_once("../_lib/function/function.olah_tabel.php");
    loadlib("function","function.datetime");
    loadlib("function","function.submit_uang");

	$result = true;

	$db->BeginTrans();

	//////////////////////////////////////////////////////////////////////

	unset($editDdKonfigurasi);

	$editDdKonfigurasi["nama_perusahaan"]		= $nama_perusahaan;
	$editDdKonfigurasi["nama_singkat"]			= $nama_singkat;
	$editDdKonfigurasi["nama_aplikasi"]			= $nama_aplikasi;
	$editDdKonfigurasi["alamat"]				= $alamat;
	$editDdKonfigurasi["kota"]					= $kota;
	$editDdKonfigurasi["propinsi"]				= $propinsi;
	$editDdKonfigurasi["kode_pos"]				= $kode_pos;
	$editDdKonfigurasi["telpon"]				= $telpon;
	$editDdKonfigurasi["fax"]					= $fax;
	$editDdKonfigurasi["nama_pimpinan"]			= $nama_pimpinan;
	$editDdKonfigurasi["keterangan"]			= $keterangan;
	$editDdKonfigurasi["kontak_person"]			= $kontak_person;
	$editDdKonfigurasi["html_title"]			= $html_title;
	$editDdKonfigurasi["logo"]					= $logo;
	$editDdKonfigurasi["logo_small"]			= $logo_small;

	/*Tambahan Puji*/
	$editDdKonfigurasi["kode_rs"]					= $kode_rs;
	$editDdKonfigurasi["tgl_registrasi"]			= date2str_baru($tgl_registrasi);
	$editDdKonfigurasi["jenis_rumah_sakit"]			= $jenis_rumah_sakit;
	$editDdKonfigurasi["kelas_rumah_sakit"]			= $kelas_rumah_sakit;
	$editDdKonfigurasi["penyelenggara_rumah_sakit"] = $penyelenggara_rumah_sakit;
	$editDdKonfigurasi["notelp_humas"]				= $notelp_humas;
	$editDdKonfigurasi["website"]					= $website;
	$editDdKonfigurasi["luas_tanah"]				= $luas_tanah;
	$editDdKonfigurasi["luas_bangunan"]				= $luas_bangunan;
	$editDdKonfigurasi["surat_izin"]				= $surat_izin;
	$editDdKonfigurasi["nomor_izin"]				= $nomor_izin;
	$editDdKonfigurasi["tanggal_izin"]				= date2str_baru($tanggal_izin);
	$editDdKonfigurasi["oleh_izin"]					= $oleh_izin;
	$editDdKonfigurasi["sifat_izin"]				= $sifat_izin;
	$editDdKonfigurasi["masa_berlaku"]				= $masa_berlaku;
	$editDdKonfigurasi["status_penyelenggara"]		= $status_penyelenggara;
	$editDdKonfigurasi["akreditas_rs"]				= $akreditas_rs;
	$editDdKonfigurasi["pentahapan_akreditas"]		= $pentahapan_akreditas;
	$editDdKonfigurasi["status_akreditas"]			= $status_akreditas;
	$editDdKonfigurasi["tanggal_akreditas"]			= date2str_baru($tanggal_akreditas);

	$jumlah_tt = $perinatologi + $kelas_vvip + $kelas_vip + $kelas_i + $kelas_ii + $kelas_iii + $icu + $picu + $nicu + $hcu + $iccu + $ruang_isolasi + $ruang_ugd + $ruang_bersalin + $ruang_operasi ;

	$editDdKonfigurasi["jumlah_tt"]					= $jumlah_tt;
	$editDdKonfigurasi["perinatologi"]				= $perinatologi;
	$editDdKonfigurasi["kelas_vvip"]				= $kelas_vvip;
	$editDdKonfigurasi["kelas_vip"]					= $kelas_vip;
	$editDdKonfigurasi["kelas_i"]					= $kelas_i;
	$editDdKonfigurasi["kelas_ii"]					= $kelas_ii;
	$editDdKonfigurasi["kelas_iii"]					= $kelas_iii;
	$editDdKonfigurasi["icu"]						= $icu;
	$editDdKonfigurasi["picu"]						= $picu;
	$editDdKonfigurasi["nicu"]						= $nicu;
	$editDdKonfigurasi["hcu"]						= $hcu;
	$editDdKonfigurasi["iccu"]						= $iccu;
	$editDdKonfigurasi["ruang_isolasi"]				= $ruang_isolasi;
	$editDdKonfigurasi["ruang_ugd"]					= $ruang_ugd;
	$editDdKonfigurasi["ruang_bersalin"]			= $ruang_bersalin;
	$editDdKonfigurasi["ruang_operasi"]				= $ruang_operasi;
	$editDdKonfigurasi["email"]						= $email;

	$result = update_tabel("dd_konfigurasi", $editDdKonfigurasi, "");

	//////////////////////////////////////////////////////////////////////

	$db->CommitTrans($result !== false);
	if($result){
		$data['code']='200';
	}else{
		$data['code']='500';
	}
	
	echo json_encode($data);
?>

