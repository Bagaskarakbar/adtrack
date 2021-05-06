<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	loadlib("function","function.uang");
	//$db->debug=true;
	
	
	if(!empty($search)){
	$sqlAddSem=" AND (a.no_izin_praktek like '%$search%' or b.nama_propinsi like '%$search%' or c.nama_kota like '%$search%')";
}
	$sql = "SELECT a.*, b.nama_propinsi, c.nama_kota FROM mt_dokter_detail as a left JOIN dc_propinsi as b ON b.id_dc_propinsi = a.id_dc_propinsi left JOIN dc_kota as c ON c.id_dc_kota = a.id_dc_kota where a.kode_dokter=$kode $sqlAddSem" ;
	$sql_count="select count(id_mt_dokter_detail) as jum from ($sql) as a";
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
						$id_mt_dokter_detail 	= $tampil["id_mt_dokter_detail"];
						$kode_dokter 			= $tampil["kode_dokter"];
						$no_izin_praktek 		= $tampil["no_izin_praktek"];
						$id_dc_propinsi 		= $tampil["id_dc_propinsi"];
						$id_dc_kota 			= $tampil["id_dc_kota"];
						$status_dokter 			= $tampil["status_dokter"];
						$kode_bagian 			= $tampil["kode_bagian"];
						
                        switch ($status_dokter){
							case "0":
								$nm_status_dr = "Junior";
								break;
							case "1":
								$nm_status_dr = "Senior";
								break;
							case "2":
								$nm_status_dr = "Prof";
								break;
							case "3":
								$nm_status_dr = "Spesialis";
								break;
							case "4":
								$nm_status_dr = "Sub Spesialis";
								break;
							case "5":
								$nm_status_dr = "Umum";
								break;
							case "6":
								$nm_status_dr = "Terapis";
								break;
						}
					//$old_date_timestamp = strtotime($tgl_periksa);
					//$tanggal = date('d-m-Y', $old_date_timestamp); 
					//$new_date = date('d-m-Y H:i:s', $old_date_timestamp); 
					//$new_time = date('H:i:s', $old_date_timestamp); 
					
					$tampil["action"]="<a href='#' title='Edit  Data' onclick='AddDokDet($id_mt_dokter_detail)'><i class='las la-edit icon-lg text-success '></i></a>&nbsp;<a href='#' title='Hapus  Data' onclick='hapusRiwayatPraktek($id_mt_dokter_detail)'><i class='las la-trash icon-lg text-danger '></i></a>";
					
					$nama_propinsi = baca_tabel("dc_propinsi", "nama_propinsi", "where id_dc_propinsi='" . $id_dc_propinsi . "'");
					$nama_kota = baca_tabel("dc_kota", "nama_kota", "where id_dc_kota='" . $id_dc_kota . "'");
					
							
					$tampil["nomer"]=$no_izin_praktek;
					$tampil["propinsi"]=$nama_propinsi;
					$tampil["kota"]=$nama_kota;
					$tampil["status"]=$nm_status_dr;
					$tampil["no"]=$i;
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>