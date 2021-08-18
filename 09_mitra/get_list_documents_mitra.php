<?
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");

    // $db->debug=true;

	// if(!empty($search)){
	// 	$sqlPlus=" AND (a.nama_pelanggan like '%$search%' or a.tgl_input like '%$search%' or f.jenis_pelanggan like '%$search%' or d.nama_layanan like '%$search%' or e.nama_paket like '%$search%')";
	// }

	$sql="SELECT * FROM tc_transaksi_dokumen WHERE id_tc_transaksi = '$id' AND id_tc_transaksi IS NOT NULL";
	$sql_count="SELECT COUNT(id_tc_transaksi_dokumen) AS jum FROM ($sql) AS a";
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
		$id_tc_transaksi_dokumen=$tampil["id_tc_transaksi_dokumen"];
		$id_mt_dokumen=$tampil["id_mt_dokumen"];
        $dokumen=$tampil["url_dokumen"];
		$no = $i.".";

		$DataList['no']=$no;

        if($id_mt_dokumen==19){
		    $DataList['tipe_dokumen']="Perintah Tagih";
        }else if($id_mt_dokumen==25){
            $DataList['tipe_dokumen']="Kwitansi";
        }else if($id_mt_dokumen==26){
            $DataList['tipe_dokumen']="Faktur Pajak";
        }

        if(isset($dokumen)){
            $DataList['status']="<i class='fa fa-fw fa-check' aria-hidden='true' title='sudah upload' style='color:#00b200'>";
            $DataList['details']="<button type='button' class='mb-2 mr-2 btn btn-success' onClick='update_docs_mitra()'><i class='fa fa-fw fa-edit' aria-hidden='true' title='perbaharui file'></i></button><button type='button' class='mb-2 mr-2 btn btn-danger' onClick='delete_docs_mitra($id_tc_transaksi_dokumen)'><i class='fa fa-fw fa-times' aria-hidden='true' title='hapus file'></i></button>";
        }
		// else{
        //     $DataList['status']="<i class='fa fa-fw fa-times' aria-hidden='true' title='belum upload' style='color:#cc0000'>";
        //     $DataList['details']="<button type='button' class='mb-2 mr-2 btn btn-info' onClick='insert_faktur_pajak()'><i class='fa fa-fw fa-upload' aria-hidden='true' title='unggah file'></i></button>";
        // }

		// $DataList['tgl_input']=date("d-m-Y", strtotime($tgl_input));
		$data['items'][]=$DataList;
	}

	echo json_encode($data);
?>
