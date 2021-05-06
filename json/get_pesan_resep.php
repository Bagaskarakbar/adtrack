<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_mr like '%$search%' or c.nama_pasien like '%$search%' or b.nama_icd like '%$search%')";
}
	$sql = "SELECT a.tgl_pesan,b.* FROM fr_tc_pesan_resep_dr as a, fr_tc_far_detail_dr as b where a.kode_pesan_resep_dr=b.kode_pesan_resep_dr and  a.kode_pesan_resep_dr=" . $kode_pesan_resep_dr . " order by a.kode_pesan_resep_dr $sqlAddSem" ;
	$sql_count="select count(kd_tr_resep_dr) as jum from ($sql) as a";
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
						$kd_tr_resep = $tampil["kd_tr_resep"];
						$kode_pesan_resep_dr = $tampil["kode_pesan_resep_dr"];
						$kode_trans_far = $tampil["kode_trans_far"];
						$jumlah_pesan = $tampil["jumlah_pesan"];
						$jumlah_tebus = $tampil["jumlah_tebus"];
						$kode_brg = $tampil["kode_brg"];
						$nama_dosis = $tampil["nama_dosis"];
						$flag_dosis = $tampil["flag_dosis"];
						$kd_tr_resep_dr = $tampil["kd_tr_resep_dr"];
						$id_tc_far_racikan = $tampil["id_tc_far_racikan"];
						$note = $tampil["note"];
						 $note = $tampil["note"];
                            if ($flag_dosis == 1) {
                                $ket = "Sebelum Makan";
                            } else if ($flag_dosis == 2) {
                                $ket = "Sesudah Makan";
                            } else if ($flag_dosis == 3) {
                                $ket = "Saat Makan";
                            } else if ($flag_dosis == 4) {
                                $ket = "Tetes";
                            } else if ($flag_dosis == 5) {
                                $ket = "Oles";
                            }
	
					$old_date_timestamp = strtotime($tgl_periksa);
					$tanggal = date('d-m-Y', $old_date_timestamp); 
					$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					$new_time = date('H:i:s', $old_date_timestamp); 
					
					$nama_brg = baca_tabel("mt_barang", "nama_brg", "where kode_brg='" . $kode_brg . "' and flag_aktif=1");
					 $satuan = baca_tabel("mt_barang", "satuan_kecil", "where kode_brg='" . $kode_brg . "' and flag_aktif=1");
                            if ($nama_brg == "") {
                                if ($id_tc_far_racikan != "") {
                                    $nama_brg = baca_tabel("tc_far_racikan", "nama_racikan", "where id_tc_far_racikan=" . $id_tc_far_racikan);
                                    $nama_dosis = baca_tabel("tc_far_racikan", "nama_dosis", "where id_tc_far_racikan=" . $id_tc_far_racikan);
                                    $flag_dosis = baca_tabel("tc_far_racikan", "flag_dosis", "where id_tc_far_racikan=" . $id_tc_far_racikan);
                                }
                            }

                            if ($satuan == "") {
                                if ($id_tc_far_racikan != "") {
                                    $satuan = baca_tabel("tc_far_racikan", "satuan_kecil", "where id_tc_far_racikan=" . $id_tc_far_racikan);
                                }
                            }
							
					$tampil["action_hapus"]="<a href='#' title='Hapus Resep' onclick='hapus_resep($kd_tr_resep_dr)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";		
					
					$tampil["nama_brg"]=$nama_brg;
					$tampil["note"]=$note;
					$tampil["satuan"]=$satuan;
					$tampil["nama_dosis"]=$nama_dosis;
					$tampil["jumlah_pesan"]=$jumlah_pesan;
					$tampil["ket"]=$ket;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>