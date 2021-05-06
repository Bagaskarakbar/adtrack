<?
	
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
}
	$sql = "SELECT
	tc_status_pasien.status_pasien,
	tc_status_pasien.terapi,
	tc_status_pasien.id_tc_status_pasien,
	tc_status_pasien.tgl_input,
	tc_status_pasien.no_mr,
	tc_soap.keterangan,
	tc_status_pasien.no_registrasi,
	tc_status_pasien.no_kunjungan
FROM
	tc_status_pasien
INNER JOIN tc_soap ON tc_soap.no_mr = tc_status_pasien.no_mr
AND tc_soap.no_kunjungan = tc_status_pasien.no_kunjungan
AND tc_soap.no_registrasi = tc_status_pasien.no_registrasi
WHERE
	tc_status_pasien.no_mr = '$no_mr'
 $sqlAddSem" ;
	$sql_count="select count(id_tc_status_pasien) as jum from ($sql) as a";
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
					$status_pasien		= $tampil["status_pasien"];
					$terapi				= $tampil["terapi"];
					$no_mr				= $tampil["no_mr"];
					$keterangan			= $tampil["keterangan"];
					$tgl_input			= $tampil["tgl_input"];
					
					$tampil["action"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='' onclick=cek_RM('$no_mr')><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					
					$tampil["subyektive"]=$status_pasien;
					$tampil["objective"]=$keterangan;
					$tampil["analisys"]=$terapi;
					$tampil["tanggal"]=$tgl_input;

					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>