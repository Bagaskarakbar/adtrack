<!doctype html>
<?

// logic layer ==========================================================================================================;
session_start();
//error_reporting(0);
include "_lib/function/db_login.php";
include "_lib/function/function.olah_tabel.php";
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.datetime");
loadlib("class","Security");

//$db->debug=true;
$modulnya=array();
$modularnya=array();
$sec=new Security($db);

if ($sec->isLoggedIn(session_id())) {
	if ($sec->isValidUser()) {
		$modularnya=$sec->hakModular();

		foreach ($modularnya as $k=>$id_dc_modular) {
			$modulnya[$id_dc_modular]=$sec->hakModul($id_dc_modular);
		}

		if (count($modulnya,COUNT_RECURSIVE)==1) {
			$lokasi="modul.php";
		}

	} else {
		$lokasi="modul.php";
	}
} else {
	$lokasi="index.php";
}
//echo $lokasi;
//die;
if (isset($lokasi)) {
	header('Location:'.$lokasi);
}

//print_r($modulnya);

$userInfo=$sec->get("userInfo");
$id_dd_user=$userInfo["id_dd_user"];
$username=$userInfo["username"];
$no_induk=$userInfo["no_induk"];
$id_dd_jenis_user = $userInfo["id_dd_jenis_user"];
$no_id_jenis = $userInfo["no_id_jenis"];
if ($id_dd_jenis_user!="1"){
	$hasil_admin = read_tabel("mt_karyawan","*","WHERE no_induk = $no_id_jenis");
	$nama_user = $hasil_admin ->fields["nama_pegawai"];
} else {
	$nama_user = "Administrator";
}

// harusnya ngambil dari database..
$nm_pegawai=baca_tabel("mt_karyawan","nama_pegawai","WHERE no_induk='".$no_induk."'");
$kd_bagian=baca_tabel("mt_karyawan","kode_bagian","WHERE no_induk='".$no_induk."'");
$foto_karyawan=baca_tabel("mt_karyawan","url_foto_karyawan","WHERE no_induk='".$no_induk."'");

$r=read_tabel("dd_konfigurasi","*");
while ($konf=$r->FetchRow()) {
	$nama_perusahaan=$konf["nama_perusahaan"];
	$nama_aplikasi=$konf["nama_aplikasi"];
	//$nama_singkat=$konf["nama_singkat"];
	$alamat=$konf["alamat"];
	$kota=$konf["kota"];
	$kode_pos=$konf["kode_pos"];
	$telpon=$konf["telpon"];
	$fax=$konf["fax"];
	$logo_small=$konf["logo_small"];
	$html_title=$konf["html_title"];
	$id_dd_paket=$konf["id_dd_paket"];
}



// seharusnya pake login_time
$status_tgl=$userInfo["status_tgl"];
$tanggal=$status_tgl;
//list($tanggal,$waktu)=split('[ ]',$status_tgl);
$halo=greeting(date("H"));
$npp=$userInfo["npp"];



// seharusnya pake ip log seblmnya
$ip=$_SERVER['REMOTE_ADDR'];

//$=$userInfo[""];


//======================= 	GET MODUL 	========================//
foreach ($modularnya as $k=>$id_dc_modular) {
	$nama_modular=baca_tabel("dc_modular","nama_modular","WHERE id_dc_modular=".$id_dc_modular);

	foreach ($modulnya[$id_dc_modular] as $k=>$id_dc_modul) {

		$rModul=read_tabel("dc_modul","*","WHERE id_dc_modul=".$id_dc_modul);

		while ($resModul=$rModul->FetchRow()) {
			$icon=$resModul["logo"];
			$arrIcon = explode(".",$icon);
			$icon_hover = $arrIcon[0]."_hover.".$arrIcon[1];
			$nama_modul=$resModul["nama_modul"];
			$id_dc_modul=$resModul["id_dc_modul"];
			$folder=$resModul["folder"];
		}
	}
}

$userInfo['nama_user']=$nama_user;
$userInfo['foto_karyawan']=$foto_karyawan;
$userInfo['nm_pegawai']=$nm_pegawai;
$userInfo['id_dd_paket']=$id_dd_paket;
$_SESSION['logininfo']=$userInfo;

//=======================	END 	=======================//
//echo $nama_modular;
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>DocTrec - AdMedika</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="./main.css" rel="stylesheet"></head>
<body>
    <?php include "layout.php"?>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1200
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3699FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#F3F6F9",
						"dark": "#212121"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1F0FF",
						"secondary": "#ECF0F3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#212121",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#ECF0F3",
					"gray-300": "#E5EAEE",
					"gray-400": "#D6D6E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#80808F",
					"gray-700": "#464E5F",
					"gray-800": "#1B283F",
					"gray-900": "#212121"
				}
			},
			"font-family": "Poppins"
		};
	</script>

	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js?v=7.0.4"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.4"></script>
	<script src="assets/js/scripts.bundle.js?v=7.0.4"></script>

	<!--end::Global Theme Bundle-->

	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.4"></script>

	<!--end::Page Vendors-->

	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/js/pages/widgets.js?v=7.0.4"></script>
	<script type="text/javascript" src="./assets/scripts/main.js"></script>
	<script src="_averin_js/main.js"></script>
	<script>
		function loadModul(a,b){
			$("#kt_wrapper").load("_header_shift.php",{modul:a,folder:b});
		}
		function loadHeader(a,b){
			$("#kt_header").load("_header.php",{modul:a,folder:b});
		}
		function loadKonten(link){
			$("#kt_content").load(link);
		}
		function load_konten_cari(url,nmForm){
			var strPost=$("#"+nmForm).serialize();
			$("#kt_content").load(url,strPost);
		}
		function change_frame(link){
			$("#tab_frame").load(link);
		}

		//loadKonten("<?=$folder?>/index.php");
		loadHeader(<?=$modul?>,'<?=$folder?>');
		loadModul(<?=$modul?>,'<?=$folder?>');

	</script>
</body>
</html>
