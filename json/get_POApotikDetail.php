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
	$sql = "SELECT a.id_tc_po,b.kode_perusahaan,b.nama_perusahaan,a.no_po,a.tgl_po,a.tgl_kirim,a.tgl_konfirmasi,a.tgl_konfirm_apotik from po_konf_detail_v as a join mt_peserta_v as b on a.kode_perusahaan_pemesan=b.kode_perusahaan where a.kode_perusahaan='$id' $sqlAddSem" ;
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
					$nama_perusahaan 	= $tampil["nama_perusahaan"];
					$no_po				= $tampil["no_po"];
					$tgl_po 			= $tampil["tgl_po"];
					$tgl_kirim 			= $tampil["tgl_kirim"];
					$tgl_konfirmasi 	= $tampil["tgl_konfirmasi"];
					
					$tot_harga = baca_tabel("tc_po_detail_v", "sum(jumlah_harga)", "where id_tc_po='" . $id_tc_po . "'");
					
					$nilai_konstanta = baca_tabel("mt_konstanta", "nilai_kosntanta", "where idKonstanta='1'");
										
										
					$total="<span style='color:red'>Rp. ".uang($tot_harga)."</span>";
					
					$action="<a href='#' title='Coment' onclick=Coment('$id_tc_po','$kode_perusahaan')>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
							
					$cek = baca_tabel("tc_cs", "id_tc_po", "where id_tc_po='" . $id_tc_po . "'");
					
					if($cek==""){
						$history_cs=$nama_perusahaan;
					}else{
						$history_cs="<a href='#'  style='color:red' title='History Pengaduan' onclick=history_cs('$id_tc_po','$kode_perusahaan')>$nama_perusahaan</a>";
					}
					
					$detail="<a href='#' title='Detail Barang Po' onclick=detailPO('$id_tc_po','$kode_perusahaan')><i class='las la-list icon-lg text-success'></i></a>";
					
					$tampil["nama"]=$history_cs;
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