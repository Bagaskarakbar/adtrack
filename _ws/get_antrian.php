<?
include "_lib/function/db_login.php";
$SqlgetJadwal="SELECT jam_mulai,jam_akhir,waktu_periksa FROM [dbo].[mt_jadwal_dokter] where kode_dokter='204' AND kode_bagian='011701' AND jumat = '1' ";
$RungetJadwal=$db->Execute($SqlgetJadwal);
while($TplgetJadwal=$RungetJadwal->fetchRow()){
	$jam_mulai=$TplgetJadwal['jam_mulai'];
	$jam_akhir=$TplgetJadwal['jam_akhir'];
	$waktu_periksa=$TplgetJadwal['waktu_periksa'];
}
$awal=strtotime($jam_akhir)-strtotime($jam_mulai);
echo $awal;
$slot=(($awal/60)/$waktu_periksa);
$slot=round($slot);
$date=date("Y-m-d");
$SqlPlAntrian="select no_antrian from pl_tc_poli where kode_dokter='204' AND kode_bagian='011701' and tgl_jam_poli BETWEEN '2018-01-02 00:00:00' AND '2018-01-02 23:59:00'";
$RunPlAntrian=$db->Execute($SqlPlAntrian);
while($TplPlAntrian=$RunPlAntrian->fetchRow()){
	
	$no_antrian=$TplPlAntrian['no_antrian'];
	$arrAntrian[$no_antrian]=$no_antrian;
}

for($i=1;i<=$slot;$i++){
	//checking antrian isi
	if($arrAntrian[$i] > 0){
		$arrSlot[$i]=1;
	}else{
		$arrSlot[$i]=0;
	}
	
}

echo json_encode($arrSlot);
?>