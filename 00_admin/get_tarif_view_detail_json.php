<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.datetime");
	loadlib("function","function.uang");

	switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "WHERE nama_pasien LIKE'%$filter%'";
			break;
		case "mr" :
			$filter = (int)$filter;
			$sqlPlus = "WHERE no_mr = $filter";
			break;
		default :
			$sqlPlus = "";
	}

		if($rev=='1'){
			$viewnya = "admin_mt_tarif_revisi_view";
		} else {
			$viewnya = "admin_mt_tarif_view";
		}

	$sql = "select * from ".$viewnya." WHERE kode_klas<>16 and kode_tarif='$kode_tarif' $sqlPlus";

	$sql_count="select count(kode_tarif) as jum from ($sql) as a";
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


				$kode_tarif = $tampil["kode_tarif"];
				$nama_tarif = $tampil["nama_tarif"];
				$tingkatan = $tampil["tingkatan"];
				$referensi = $tampil["referensi"];
				$jenis_tindakan = $tampil["jenis_tindakan"];
				$paket_askes = $tampil["paket_askes"];
				$bill_rs = $tampil["bill_rs"];
				$kode_klas = $tampil["kode_klas"];
				$bill_dr1 = $tampil["bill_dr1"];
				$bill_dr2 = $tampil["bill_dr2"];
				$bill_dr3 = $tampil["bill_dr3"];
				$bhp = $tampil["bhp"];
				$rs = $tampil["bill_rs"];
				$total = $tampil["bill_rs"]+$tampil["bill_dr3"]+$tampil["bill_dr2"]+$tampil["bill_dr1"];
				$kode_tgl_tarif = $tampil["kode_tgl_tarif"];
				$kode_master_tarif_detail = $tampil["kode_master_tarif_detail"];
				$nama_klas = $tampil["nama_klas"];
				$kode_bagian = $tampil["kode_bagian"];
				$nama_bagian = $tampil["nama_bagian"];
				$tgl_berlaku = $tampil["tgl_berlaku"];
				$status = $tampil["status"];
				$DataList['no']=$i;
				$DataList['kode_tarif']=$kode_tarif;
				$DataList['nama_tarif']=$nama_tarif;
				$DataList['nama_bagian']=$nama_bagian;
				$DataList['nama_klas']=$nama_klas;
				$DataList['total']=uang($total,true);
				$data['items'][]=$DataList;
			} 
	echo json_encode($data);
?>