<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	// $db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
}
	$sql = "SELECT * FROM tc_trans_pelayanan where no_mr='$no_mr' AND no_kunjungan=$no_kunjungan AND kode_bagian like '01%' $sqlAddSem" ;
	$sql_count="select count(kode_trans_pelayanan) as jum from ($sql) as a";
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
					$kode_trans_pelayanan = $tampil["kode_trans_pelayanan"];
					$kode_tc_trans_kasir = $tampil["kode_tc_trans_kasir"];
					$no_kunjungan = $tampil["no_kunjungan"];
					$no_registrasi = $tampil["no_registrasi"];
					$no_mr = $tampil["no_mr"];
					$kode_kelompok = $tampil["kode_kelompok"];
					$kode_perusahaan = $tampil["kode_perusahaan"];
					$tgl_transaksi = $tampil["tgl_transaksi"];
					$jenis_tindakan = $tampil["jenis_tindakan"];
					$nama_tindakan = $tampil["nama_tindakan"];
					$bill_rs = $tampil["bill_rs"];
					$bill_dr1 = $tampil["bill_dr1"];
					$bill_dr2 = $tampil["bill_dr2"];
					$kode_dokter1 = $tampil["kode_dokter1"];
					$kode_perawat = $tampil["kode_perawat"];
					$kode_dokter2 = $tampil["kode_dokter2"];
					$kode_ri = $tampil["kode_ri"];
					$kode_poli = $tampil["kode_poli"];
					$jumlah = $tampil["jumlah"];
					$kode_barang = $tampil["kode_barang"];
					$kode_penunjang = $tampil["kode_penunjang"];
					$kode_depo_stok = $tampil["kode_depo_stok"];
					//$kode_gd = $tampil["kode_gd"];
					$kode_tarif = $tampil["kode_tarif"];
					$kode_master_tarif_detail = $tampil["kode_master_tarif_detail"];
					$kd_tr_resep = $tampil["kd_tr_resep"];
					//$biaya=$bill_rs+$bill_dr1+$bill_dr2;
					$biaya=$bill_rs;
					if (trim($kode_dokter1)==""){
						$nama_dokter = "-";
					} else {
						$nama_dokter=baca_tabel("mt_karyawan","nama_pegawai","where kode_dokter=$kode_dokter1");
					}

					if (trim($kode_perawat)==""){
						$nama_perawat = "-";
					} else {
						$nama_perawat=baca_tabel("mt_karyawan","nama_pegawai","where kode_perawat='$kode_perawat'");
					}

					
					//$fungsi_del="modal('dokter_act.php?kode_dokter=$kode_dokter&act=delete')";
					//$fungsi_edt="modal('dokter_addedit.php?kode_dokter=$kode_dokter&act=delete')";
					$old_date_timestamp = strtotime($tgl_transaksi);
					$tanggal = date('d-m-Y', $old_date_timestamp); 
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' class='btn btn-light-success font-weight-bolder font-size-sm  title='' onclick=cek_RM('$no_mr')><img src='/assets/media/svg/icons/Files/File.svg'/></a>";
					
					$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_tindakan($kode_trans_pelayanan)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
					
					$tampil["nama_tindakan"]=$nama_tindakan;
					$tampil["jumlah"]=uang($jumlah);
					$tampil["tekanan_darah"]=$tekanan_darah;
					$tampil["nama_dokter"]=$nama_dokter;
					$tampil["nama_perawat"]=$nama_perawat;
					$tampil["biaya"]=number_format($biaya,2,",",".");
					$tampil["tanggal"]=$tanggal;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>