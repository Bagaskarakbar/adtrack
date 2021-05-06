<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once("../_lib/function/db.php");
loadlib("function","variabel");
loadlib("function","function.olah_tabel");
loadlib("class","Paging");
// $db->debug=true;

// $mrPasien=$_GET['mr_cari'];
// echo  $mrPasien;

// // $sql_pasien="SELECT * FROM mt_master_pasien WHERE no_mr='$mrPasien'"
// // $data_pasien=$db->Execute($sql_pasien);
// // 
// // 
// $SqlGetPasien="select nama_pasien,no_mr from mt_master_pasien where nama_pasien like '%$cari%'";
// $RunGetPasien=$db->Execute($SqlGetPasien);
// while($TplGetPasien=$RunGetPasien->fetchRow()){
// 	$nama_pasien=$TplGetPasien['nama_pasien'];
// 	$no_mr=$TplGetPasien['no_mr'];
// 	$aksi="buka_pasien('$nama_pasien')";
// 	echo "<option value='$nama_pasien | $no_mr' onclick='$aksi'></option>";
// }

// if(!empty($search)){
// 	$sqlSearch=" AND (nama_pegawai LIKE '%".$search."%' OR kode_dokter LIKE '%".$search."%')";
// }
$kode_dokter = $_GET['kode_dokter'];
$sql = "SELECT id_mt_jadwal_dokter,karyawan.kode_dokter,range_hari FROM mt_karyawan AS karyawan JOIN mt_dokter_bagian AS dokter_bagian ON karyawan.kode_dokter = dokter_bagian.kode_dokter JOIN mt_bagian AS poli_bagian ON dokter_bagian.kode_bagian = poli_bagian.kode_bagian join mt_jadwal_dokter as jadwal on karyawan.kode_dokter = jadwal.kode_dokter WHERE karyawan.kode_dokter = $kode_dokter group by nama_pegawai asc";

$sql_count="SELECT count(id_mt_jadwal_dokter) as jum from ($sql) as a";
$run_count=$db->Execute($sql_count);
while($tpl_count=$run_count->fetchRow()){
	$data['count']=$tpl_count['jum'];
}
$recperpage = $limit;
$hal=($offset/$limit)+1;
$pagenya = new Paging($db, $sql, $recperpage);
$rsPaging = $pagenya->ExecPage($hal);
$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;
$i = $pagenya->pagingVars["firstno"];

while ($tampil=$rsPaging->FetchRow()) {
	$i++;
	$tampil["no"] = $i;
	$range_hari = $tampil["range_hari"];
	$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='ubah_yankes($id_perusahaan)'>
	<i class='las la-edit icon-lg text-success '></i>
	</a>";

	$data['items'][]=$tampil;

}
echo json_encode($data);			
?>