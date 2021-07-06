<?
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");
	//$db->debug=true;

	/* switch ($tipeCari) {
		case "kelompok" :
			$sqlPlus = "AND nama_modular LIKE'%$filter%'";
			break;
		case "modul" :
			$sqlPlus = "AND nama_modul LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	} */

	if(!empty($search)){
		$sqlPlus=" AND (tipe_dokumen like '%$search%' or tipe_dokumen like '%$search%')";
	}

	$sql="select * from tc_monitoring_detail where id_tc_monitoring=$id order by tgl_selesai asc";
	$sql_count="select count(id_tc_monitoring_detail) as jum from ($sql) as a";
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

	$done="<i class='pe-7s-check text-info' ></i>";
	$done_not="<i class='pe-7s-check text-danger' ></i>";

	while ($tampil=$rsPaging->FetchRow()) {
		$i++;
		$id_tc_monitoring_detail	=$tampil["id_tc_monitoring_detail"];
		$keterangan					=$tampil["keterangan"];
		$id_tc_monitoring			=$tampil["id_tc_monitoring"];
		$tgl_mulai					=$tampil["tgl_mulai"];
		$tgl_selesai				=$tampil["tgl_selesai"];
		$progres					=$tampil["progres"];
		$no = $i.".";
		
		
		if(isset($tgl_mulai)){
			$DataList['tgl_mulai'] = date("d-m-Y", strtotime($tgl_mulai));
		}else{
			$DataList['tgl_mulai'] = "-";
		}
		
		if(isset($tgl_selesai)){
			$DataList['tgl_selesai'] = date("d-m-Y", strtotime($tgl_selesai));
		}else{
			$DataList['tgl_selesai'] = "-";
		}
		
		if(isset($progres)){
			$DataList['progres'] = $progres." %";
		}else{
			$DataList['progres'] = "-";
		}
		
		$action="<i class='pe-7s-trash text-danger' style='cursor: pointer' onClick='DeleteMonDet($id_tc_monitoring_detail)'></i>";
		$icon="<i class='pe-7s-check text-info' ></i>";
		
		$DataList['no']=$no;
		$DataList['keterangan']=$keterangan;
		$DataList['icon']=$icon;
		$DataList['action']=$action;
		$data['items'][]=$DataList;
	}

	echo json_encode($data);
?>
