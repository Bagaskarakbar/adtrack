<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

	require_once("../_lib/function/db_login.php");
	require_once("../_lib/function/function.olah_tabel.php");
	require_once("../_lib/function/function.max_kode_number.php");
	
	$data=file_get_contents("php://input");
	$arr=json_decode($data,TRUE);
	foreach($arr as $key => $val){
		$$key=$val;
	}
	
	$no_registrasi=max_kode_number("tc_registrasi","no_registrasi");
	$insertTcRegistrasi["no_registrasi"] = $no_registrasi;
	$insertTcRegistrasi["no_mr"] = $no_mr;
	$insertTcRegistrasi["kode_dokter"] = $kode_dokter;
	$insertTcRegistrasi["tgl_jam_masuk"] = $jam_antrian;
	$insertTcRegistrasi["kode_bagian_masuk"] = $kode_bagian;
	$insertTcRegistrasi["stat_pasien"] =$stat_pasien;
	$insertTcRegistrasi["asal_pasien"] = $kode_bagian;
	$insertTcRegistrasi["lama_baru"] = 1;

	insert_tabel("tc_registrasi",$insertTcRegistrasi);

	/*--2. Masuk ke tc_kunjungan--*/

	//Cari no_kunjungan

	$no_kunjungan=max_kode_number("tc_kunjungan","no_kunjungan");
	
	$insertTcKunjungan["no_kunjungan"] = $no_kunjungan;
	$insertTcKunjungan["no_registrasi"] = $no_registrasi;
	$insertTcKunjungan["no_mr"] = $no_mr;
	$insertTcKunjungan["kode_dokter"] = $kode_dokter;
	$insertTcKunjungan["kode_bagian_tujuan"] = $kode_bagian;
	$insertTcKunjungan["kode_bagian_asal"] = $kode_bagian;
	$insertTcKunjungan["tgl_masuk"] = $jam_antrian;
	$insertTcKunjungan["status_masuk"] = 0;

	insert_tabel("tc_kunjungan", $insertTcKunjungan);

		
	/*--3. Masuk ke trans_kartu--*/

	// jika pasien baru masukkan ke trans_cetak_kartu
	$kode_poli=max_kode_number("pl_tc_poli","kode_poli");
	$insertPlTcPoli["kode_poli"] = $kode_poli;
	$insertPlTcPoli["no_kunjungan"] = $no_kunjungan;
	$insertPlTcPoli["kode_bagian"] = $kode_bagian;
	$insertPlTcPoli["tgl_jam_poli"] = $jam_antrian;
	$insertPlTcPoli["kode_dokter"] = $kode_dokter;
	$insertPlTcPoli["no_antrian"] = $no_antrian;
	$insertPlTcPoli["nama_pasien"] = $nama;
	$insertPlTcPoli["asal_pasien"] = $asal_pasien;
	$result = insert_tabel("pl_tc_poli", $insertPlTcPoli);
	
	//=====================================================//
	// $id_hp_mr=max_kode_number("hp_mr","id_hp_mr");

	// $insertHpMr["id_hp_mr"] = $id_hp_mr;
	// $insertHpMr["no_mr_sementara"] = $no_mr;
	// $insertHpMr["kode_bagian"] = $kode_bagian;
	// $insertHpMr["jen_kelamin"] = $jen_kelamin;
	// $insertHpMr["email"] = $email;
	// $insertHpMr["no_hp"] = $no_hp;
	// $insertHpMr["tgl_lhr"] = $tgl_lhr;
	// $insertHpMr["almt_ttp_pasien"] = $almt_ttp_pasien;
	// $insertHpMr["tempat_lahir"] = $tempat_lahir;
	// $insertHpMr["gol_darah"] = $GolDarah;
	// $insertHpMr["alergi"] = $Alergi;
	// $insertHpMr["agama"] = $Agama;
	// $insertHpMr["no_id_pasien"] = $no_id_pasien;
	// $insertHpMr["nik"] = $nik;
	// $insertHpMr["nama_pasien"] = $nama;
	// $insertHpMr["id_mt_rs"] = $id_mt_rs;
	// $insertHpMr["stat_pasien"] = $stat_pasien;
	// $result = insert_tabel("hp_mr", $insertHpMr);

	//=====================================================//
	
	
	
	$respon['no_mr']=$no_mr;
	$respon['no_registrasi']=$no_registrasi;
	
	echo json_encode($respon);
?>