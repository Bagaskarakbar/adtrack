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
	
	//======================= Get Dokumen Has Been Done ============================//
	$SqlGetMon="SELECT * FROM tc_monitoring where id_tc_transaksi='$id'";
	$RunGetMon=$db->Execute($SqlGetMon);
	while($TplGetMon=$RunGetMon->fetchRow())
	{
		$id_tc_transaksi_done	=$TplGetMon["id_tc_transaksi"];
		$id_mt_monitoring		=$TplGetMon["id_mt_monitoring"];
		$tgl_mulai				=$TplGetMon["tgl_mulai"];
		$tgl_selesai			=$TplGetMon["tgl_selesai"];
		$status_done			=$TplGetMon["status"];
		$progres			=$TplGetMon["progres"];
		
		$arrMon[$id_mt_monitoring]=$TplGetMon;
		$arrIdTr[$id_mt_monitoring]=$id_tc_transaksi_done;
		$arrIdMt[$id_mt_monitoring]=$id_mt_monitoring_done;
		$arrTglM[$id_mt_monitoring]=$tgl_mulai;
		$arrTglS[$id_mt_monitoring]=$tgl_selesai;
		$arrProg[$id_mt_monitoring]=$progres;
		$arrStatus[$id_mt_monitoring]=$status_done;
	}
	//======================= Get Dokumen Has Been Done ============================//

	$sql="select * from mt_monitoring";
	$sql_count="select count(id_mt_monitoring) as jum from ($sql) as a";
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

	$done="<div class='badge badge-info'> Done </div>";
	$done_not="<div class='badge badge-danger'> In Progres </div>";

	while ($tampil=$rsPaging->FetchRow()) {
		$i++;
		$id_mt_monitoring	=$tampil["id_mt_monitoring"];
		$nama_monitoring	=$tampil["nama_monitoring"];
		$no = $i.".";
		
		 if(isset($arrStatus[$id_mt_monitoring]))
		{
			$DataList['status'] = $done;
		}else{
			$DataList['status'] = $done_not;
		}
		
		if(isset($arrTglM[$id_mt_monitoring])){
			$DataList['tgl_mulai'] = date("d-m-Y", strtotime($arrTglM[$id_mt_monitoring]));
		}else{
			$DataList['tgl_mulai'] = "-";
		}
		
		if(isset($arrTglS[$id_mt_monitoring])){
			$DataList['tgl_selesai'] = date("d-m-Y", strtotime($arrTglS[$id_mt_monitoring]));
		}else{
			$DataList['tgl_selesai'] = "-";
		}
		
		if(isset($arrTglS[$id_mt_monitoring])){
			//$DataList['progres'] =$arrProg[$id_mt_monitoring]." %";
			$DataList['progres'] ="<div class='widget-numbers mt-0 fsize-3 text-success'>".$arrProg[$id_mt_monitoring]." %</div>";
			
		}else{
			$DataList['progres'] = "-";
		}
		
		$action="<i class='pe-7s-search text-success' style='cursor: pointer' onClick='AddMon($id_mt_monitoring,$id)'></i>";
		$icon="<i class='pe-7s-check text-info' ></i>";
		
		$DataList['no']=$no;
		$DataList['nama']=$nama_monitoring;
		$DataList['icon']=$icon;
		$DataList['action']=$action;
		$data['items'][]=$DataList;
	}

	echo json_encode($data);
?>
