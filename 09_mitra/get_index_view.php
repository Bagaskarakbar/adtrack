<?
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	// $db->debug=true;

	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");

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
		$sqlPlus=" AND (a.nama_pelanggan like '%$search%' or a.tgl_input like '%$search%' or f.jenis_pelanggan like '%$search%' or d.nama_layanan like '%$search%' or e.nama_paket like '%$search%')";
	}

	$sql="SELECT a.id_tc_transaksi, a.nama_pelanggan, a.tgl_input, b.jenis_project, c.nama_bundling, d.nama_layanan, e.nama_paket, f.jenis_pelanggan 
	FROM tc_transaksi AS a 
	JOIN mt_jenis_project AS b ON a.id_mt_jenis_project = b.id_mt_jenis_project 
	JOIN mt_bundling AS c ON a.id_mt_bundling = c.id_mt_bundling 
	JOIN mt_layanan AS d ON a.id_mt_layanan = d.id_mt_layanan 
	JOIN mt_paket AS e ON a.id_mt_paket = e.id_mt_paket 
	JOIN mt_jenis_pelanggan AS f ON a.id_mt_jenis_pelanggan = f.id_mt_jenis_pelanggan
	JOIN tc_pengajuan AS g ON a.id_tc_pengajuan = g.id_tc_pengajuan
	WHERE a.id_tc_transaksi is not null $sqlPlus ORDER BY a.id_tc_transaksi";
	$sql_count="select count(a.id_tc_transaksi) as jum from ($sql) as a";
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
		$id_tc_transaksi=$tampil["id_tc_transaksi"];
		$nama_pelanggan=$tampil["nama_pelanggan"];
		$jenis_pelanggan=$tampil["jenis_pelanggan"];
		$nama_layanan=$tampil["nama_layanan"];
		$paket_layanan=$tampil["nama_paket"];
		$tgl_input=$tampil["tgl_input"];
		$no = $i.".";

		$DataList['no']=$no;
		$DataList['nama_pelanggan']=$nama_pelanggan;
		$DataList['jenis_pelanggan']=$jenis_pelanggan;
		$DataList['nama_layanan']=$nama_layanan;
		$DataList['paket_layanan']=$paket_layanan;
		$DataList['tgl_input']=date("d-m-Y", strtotime($tgl_input));
		$DataList['details']="<button type='button' id='PopoverCustomT-4' class='btn btn-primary btn-sm'><a href='#' style='color: white; text-decoration: none;' onClick='list_mitra_modal($id_tc_transaksi)'>Detail</a></button>";
		$data['items'][]=$DataList;
	}

	echo json_encode($data);
?>
