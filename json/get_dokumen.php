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
	$SqlGetDok="SELECT * FROM tc_pengajuan_dokumen where id_tc_pengajuan='$id'";
	$RunGetDok=$db->Execute($SqlGetDok);
	while($TplGetDok=$RunGetDok->fetchRow())
	{
		$id_tc_pengajuan_done	=$TplGetDok["id_tc_pengajuan"];
		$tgl_berlaku			=$TplGetDok["tgl_berlaku"];
		$arrLegal[$id_tc_pengajuan_done]=$id_tc_pengajuan_done;
	}
	//======================= Get Dokumen Has Been Done ============================//

	$sql="select a.*,b.nama_bagian from mt_dokumen as a join mt_bagian as b on a.kode_bagian=b.kode_bagian ";
	$sql_count="select count(a.id_mt_dokumen) as jum from ($sql) as a";
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
		$id_mt_dokumen	=$tampil["id_mt_dokumen"];
		$tipe_dokumen		=$tampil["tipe_dokumen"];
		$nama_bagian		=$tampil["nama_bagian"];
		$no = $i.".";
		
		if(isset($arrDok[$id_dd_legalitas]))
		{
			$TplGetCalonPeserta['status'] = $sudah_upload;
		}else{
			$TplGetCalonPeserta['status'] = $belum_upload;
		}
		
		$dokView="<i class='pe-7s-search text-success' style='cursor: pointer' onClick='DokView($id_mt_dokumen)'></i>";
		$icon="<i class='pe-7s-check text-info' ></i>";
		
		$DataList['no']=$no;
		$DataList['id_mt_dokumen']=$id_mt_dokumen;
		$DataList['tipe_dokumen']=$tipe_dokumen;
		$DataList['nama_bagian']=$nama_bagian;
		$DataList['icon']=$icon;
		$DataList['action']=$dokView;
		$data['items'][]=$DataList;
	}

	echo json_encode($data);
?>
