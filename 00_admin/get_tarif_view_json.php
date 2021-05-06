<?

	session_start();

	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.tidak_berulang");
	loadlib("function","function.date2str");
	loadlib("function","function.form");
    loadlib("function", "function.uang");
     
	if (isset($kode_bagian_cari)){
		$sql_plus = " AND kode_bagian = '$kode_bagian_cari'";
	}
	
	$sql_poli = "SELECT * FROM mt_bagian WHERE validasi='0100' AND status_aktif = 1 ";

	if (isset($kode_bagian_cari)){
		//PUNK-28/06/2013-14:48:26 
		if($rev=='1'){
			$viewnya = "admin_mt_tarif_revisi_view";
		} else {
			$viewnya = "admin_mt_tarif_view";
		}
		$sql = "SELECT * FROM ".$viewnya." WHERE kode_klas=16   $sqlPlus and kode_bagian='$kode_bagian_cari' ";
		$sql_count="select count(kode_tarif) as jum from ($sql) as a";
		$run_count=$db->Execute($sql_count);
		while($tpl_count=$run_count->fetchRow()){
			$data['count']=$tpl_count['jum'];
		}
		$recperpage = $limit;
		$hal=($offset/$limit)+1;

		$pagenya = new Paging($db, $sql, $recperpage);
		$rsPaging = $pagenya->ExecPage($hal);
		$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;
		$namaBagianCari = baca_tabel("mt_bagian","nama_bagian","WHERE kode_bagian='$kode_bagian_cari'");
	}
	
?>
<?
			if (isset($kode_bagian_cari)){
			$i = $pagenya->pagingVars["firstno"];
		
			while ($tampil=$rsPaging->FetchRow()) {
				$i++;
                                //print_r($tampil);
				
				$kode_tarif = $tampil["kode_tarif"];
				$kode_tindakan = $tampil["kode_tindakan"];
				$kode_master_tarif_detail = $tampil["kode_master_tarif_detail"];
				$nama_tarif = $tampil["nama_tarif"];
				$tingkatan = $tampil["tingkatan"];
				$ket = $tampil["ket"];
				$kode_bagian = $tampil["kode_bagian"];
				$referensi = $tampil["referensi"];
				$jenis_tindakan = $tampil["jenis_tindakan"];
				$paket_askes = $tampil["paket_askes"];
				$kode_rs_asri = $tampil["kode_rs_asri"];
				$flag_perawat = $tampil["flag_perawat"];
				$flag_backlog = $tampil["flag_backlog"];
				$harga_paket = $tampil["harga_paket"];
				$kode_referensi = $tampil["kode_referensi"];
				$jml_hari = $tampil["jml_hari"];
				$kd_ruangan = $tampil["kd_ruangan"];
				$anestesi = $tampil["anestesi"];
				$total = $tampil["total"];
				$jasa_dr_asisten = $tampil["jasa_dr_asisten"];
				$pendapatan_rs = $tampil["pendapatan_rs"];
				$alat_rs = $tampil["alat_rs"];
				$overhead = $tampil["overhead"];
				$bill_dr3 = $tampil["bill_dr3"];
				$biaya_lain = $tampil["biaya_lain"];
				$obat = $tampil["obat"];
				$alkes = $tampil["alkes"];
				$alat_rs = $tampil["alat_rs"];
				$adm = $tampil["adm"];
				$overhead = $tampil["overhead"];
				$bhp = $tampil["bhp"];
				$pendapatan_rs = $tampil["pendapatan_rs"];
				$kodeBagian = $tampil["kode_bagian"];
				$kodeTindakan = $tampil["kode_tindakan"];
				$nama_klas = $tampil["nama_klas"];
				$bill_dr1 = $tampil["bill_dr1"];
				$bill_dr2 = $tampil["bill_dr2"];

				
				$bagian=substr($kode_bagian,-5,3);


				if($act!='REV')$cekTarif = baca_tabel("tc_trans_pelayanan","kode_tarif","where kode_tarif = '".$kode_tarif."'");
				
				$DataList['i']=$i;
				$DataList['tarif_detail']="<a href='#' onclick='openPop('tarif_view_detail.php?kode_tarif=$kode_tarif&act=$act&kode_master_tarif_detail=$kode_master_tarif_detail&kode_bagian_cari=$kode_bagian_cari')'>
						<IMG SRC='../_images/icons/ico_caridok.png' WIDTH='12' HEIGHT='14' BORDER='0' ALT=''></a>";
				if($tingkatan=="5"){
					$DataList['act_edit']="<a href='#' onclick='openPop('tarif_view_edit2.php?kode_tarif=$kode_tarif&rev=$rev&kode_master_tarif_detail=$kode_master_tarif_detail&kode_bagian_cari=$kode_bagian_cari&detail=0')'>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
				}else{
					$DataList['act_edit']="";
				}
				if($tingkatan=="5"  && $cekTarif==''){
					$DataList['act_hapus']="<a class='hapus' href='tarif_view_hapus.php?rev=$rev&kode_master_tarif_detail=$kode_master_tarif_detail&kode_tarif=$kode_tarif&kode_bagian_cari=$kode_bagian_cari&detail=0' title='Hapus'><i class='las la-trash-alt icon-lg text-danger '></i></a>";					
				}else{
					$DataList['act_hapus']="";
				}
				$DataList['tarif_det']="<p style='cursor: pointer;color: blue;' onclick=tarif_detail('$kode_bagian','','$kode_tarif') >$nama_tarif&nbsp;</p>";
				$DataList['total']=uang($total,true);
				$DataList['bill_dr1']=uang($bill_dr1,true);
				$DataList['bill_dr2']=uang($bill_dr2,true);
				$DataList['bill_dr3']=uang($bill_dr3,true);
				$DataList['jasa_dr_asisten']=uang($jasa_dr_asisten,true);
				$DataList['pendapatan_rs']=uang($pendapatan_rs,true);
				$DataList['overhead']=uang($overhead,true);
				$DataList['alat_rs']=uang($alat_rs,true);
				$DataList['kelas']='Kelas RJ';
				$data['items'][]=$DataList;
		
			} 
		}
		echo json_encode($data);
?>