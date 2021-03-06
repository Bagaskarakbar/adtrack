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
		$sqlPlus=" AND (c.tipe_dokumen like '%$search%' or a.tgl_input like '%$search%')";
	}

	$sql="SELECT a.*, c.tipe_dokumen,d.nama_bagian FROM tc_pengajuan_dokumen as a INNER JOIN tc_pengajuan as b ON b.id_tc_pengajuan = a.id_tc_pengajuan INNER JOIN mt_dokumen as c ON c.id_mt_dokumen = a.id_mt_dokumen INNER JOIN mt_bagian as d on c.kode_bagian = d.kode_bagian";
	$sql_count="select count(id_tc_pengajuan_dokumen) as jum from ($sql) as a";
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
		$id_tc_pengajuan_dokumen	=$tampil["id_tc_pengajuan_dokumen"];
		$id_mt_dokumen				=$tampil["id_mt_dokumen"];
		$tipe_dokumen				=$tampil["tipe_dokumen"];
		$tgl_input					=$tampil["tgl_input"];
		$url_dokumen				=$tampil["url_dokumen"];
		$nama_bagian				=$tampil["nama_bagian"];
		$no = $i.".";
		
		//$download="<a href='#' onClick='DokView($url_dokumen)' ><i class='fa fa-download' style='color:#3699FF'></i></a>";
		$download="<i class='fa fa-download text-success' style='cursor: pointer' onClick='DokDownload($id_tc_pengajuan_dokumen)'></i>";
		$icon="<i class='pe-7s-check text-info' ></i>";

		$DataList['no']=$no;
		$DataList['id_mt_dokumen']=$id_mt_dokumen;
		$DataList['tipe_dokumen']=$tipe_dokumen;
		$DataList['nama_bagian']=$nama_bagian;
		$DataList['tgl']=date("d-m-Y",strtotime($tgl_input));
		$DataList['download']=$download;
		$data['items'][]=$DataList;
	}

	echo json_encode($data);
?>
