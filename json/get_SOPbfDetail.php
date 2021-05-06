<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.uang");
	loadlib("class","Paging");
	//$db->debug=true;
	
	if(!empty($search)){
		$sqlAddSem=" and (b.nama_perusahaan like '%$search%' or a.no_po like '%$search%' or a.tgl_po like '%$search%' or a.tgl_kirim like '%$search%')";
	}
	$sql = "SELECT a.id_tc_po,b.kode_perusahaan,b.nama_perusahaan,a.no_po,a.tgl_po,a.tgl_kirim,a.tgl_konfirm_apotik from so_konf_detail_v as a join mt_peserta_v as b on a.kode_perusahaan_pemesan=b.kode_perusahaan where a.flag_konfirmasi in (1,2) and (a.tgl_konfirm_apotik is not null or a.konfirm_apotik = 1) and a.flag_pack is null and a.kode_perusahaan='$id' $sqlAddSem" ;
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
					$nama_perusahaan 	= $tampil["nama_perusahaan"];
					$kode_perusahaan 	= $tampil["kode_perusahaan"];
					$no_po				= $tampil["no_po"];
					$tgl_po 			= $tampil["tgl_po"];
					$tgl_kirim 			= $tampil["tgl_kirim"];
					$tgl_konfirm_apotik = $tampil["tgl_konfirm_apotik"];
					
					$tot_harga = baca_tabel("tc_po_detail_v", "sum(jumlah_harga)", "where id_tc_po='" . $id_tc_po . "'");
					
					$nilai_konstanta = baca_tabel("mt_konstanta", "nilai_kosntanta", "where idKonstanta='2'");
										
					$old_date_timestamp = strtotime($tgl_po);
					$tanggal = date('d-m-Y', $old_date_timestamp); 
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$total="<span style='color:red'>Rp. ".uang($tot_harga)."</span>";
					
					$detail="<a href='#' title='Detail Barang So' onclick=detailSO('$id_tc_po','$kode_perusahaan')><i class='las la-list icon-lg text-success'></i></a>";
					
					$tampil["nama"]=$nama_perusahaan;
					$tampil["no_po"]=$no_po;
					$tampil["tot_harga"]=$total;
					$tampil["tgl_po"]=date('d-m-Y', strtotime($tgl_po));
					$tampil["tgl_kirim"]=date('d-m-Y', strtotime($tgl_kirim));
					$tampil["tgl_konfirmasi_apotik"]=date('d-m-Y', strtotime($tgl_konfirm_apotik));
					$tampil["tgl_batas_konfirmasi_apotik"]=date('d-m-Y', strtotime($tgl_konfirm_apotik."+$nilai_konstanta days"));
					$tampil["detail"]=$detail;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>