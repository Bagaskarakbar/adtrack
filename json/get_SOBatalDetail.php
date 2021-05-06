<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.uang");
	loadlib("class","Paging");
	//$db->debug=true;
	
	if(!empty($search)){
		$sqlAddSem=" and (nama_apotik like '%$search%' or no_po like '%$search%' or tgl_po like '%$search%' or tgl_kirim like '%$search%' or tgl_konfirmasi like '%$search%')";
	}
	$sql = "SELECT id_tc_po,kode_perusahaan,nama_apotik,no_po,tgl_po,tgl_kirim,tgl_konfirmasi,tgl_konfirm_apotik from tc_po_v where flag_konfirmasi='3' or flag_konfirmasi='99' and kode_perusahaan='$id' $sqlAddSem" ;
	$sql_count="select count(id_tc_po) as jum from ($sql) as a";
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

					$id_tc_po 			= $tampil["id_tc_po"];
					$kode_perusahaan 	= $tampil["kode_perusahaan"];
					$nama_perusahaan 	= $tampil["nama_apotik"];
					$no_po				= $tampil["no_po"];
					$tgl_po 			= $tampil["tgl_po"];
					$tgl_kirim 			= $tampil["tgl_kirim"];
					$tgl_konfirmasi 	= $tampil["tgl_konfirmasi"];
					
					//$tot_harga = baca_tabel("tc_po_detail_v", "sum(jumlah_harga)", "where id_tc_po='" . $id_tc_po . "'");
					
					//$total="<span style='color:red'>Rp. ".uang($tot_harga)."</span>";
					
					$nilai_konstanta = baca_tabel("mt_konstanta", "nilai_kosntanta", "where idKonstanta='2'");
										
										
					
					
			
					$detail="<a href='#' title='Detail Barang Po' onclick=detailSOBatal('$id_tc_po','$kode_perusahaan')><i class='las la-list icon-lg text-success'></i></a>";
					
					$tampil["nama"]=$nama_perusahaan;
					$tampil["no_po"]=$no_po;
					$tampil["tot_harga"]=$total;
					$tampil["tgl_po"]=date('d-m-Y', strtotime($tgl_po));
					$tampil["tgl_kirim"]=date('d-m-Y', strtotime($tgl_kirim));
					$tampil["tgl_konfirmasi"]=date('d-m-Y', strtotime($tgl_konfirmasi));
					$tampil["tgl_batas_konfirmasi"]=date('d-m-Y', strtotime($tgl_konfirmasi."+$nilai_konstanta days"));
					$tampil["no"]=$i;
					$tampil["action"]=$action;
					$tampil["detail"]=$detail;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>