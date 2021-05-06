<?session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	
	switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "AND k.nama_pegawai LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	}

	$sql = " SELECT k.* FROM mt_karyawan k  WHERE 1=1 $sqlPlus ORDER BY urutan_karyawan" ;
	$sql_count="select count(id_mt_karyawan) as jum from ($sql) as a";
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

					$id_mt_karyawan			= $tampil["id_mt_karyawan"];
					$nama_pegawai		= $tampil["nama_pegawai"];
					$status_dr			= $tampil["status_dr"];
					$status				= $tampil["status"];
					$no_mr				= $tampil["no_mr"];
					$nama_spesialisasi	= $tampil["nama_spesialisasi"];
					$kode_dokter		= $tampil["kode_dokter"];
					$url_foto_karyawan	= $tampil["url_foto_karyawan"];
					$status_input		= $tampil["status_input"];
					$flag_tenaga_medis	= $tampil["flag_tenaga_medis"];
					
					switch ($status_dr){
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
					
					if($flag_tenaga_medis==1){
							$tenaga_medis="Full Time";
						}else if($flag_tenaga_medis==2){
							$tenaga_medis="Part Time";
						}else{
							$tenaga_medis="Dokter Tamu";
						}

					
					
					
					
					
					if($url_foto_karyawan!=""){
						$url_foto_karyawan="<img src='$url_foto_karyawan' width='50' height='50'/>";
					}else{
						$url_foto_karyawan=	"<img src='assets/media/svg/avatars/001-boy.svg' width='50' height='50' />";
					}
					
					
					
					$tampil["action_hapus"]="<a href='#' title='Hapus  $nama_pegawai' onclick='HapusDokter($id_mt_karyawan)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
					$tampil["action_edit"]="<a href='#' title='Edit  $nama_pegawai' onclick='ubah($id_mt_karyawan)'>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
					$tampil["detail"]="<button class='btn btn-primary' onclick='detailDokter(".$id_mt_karyawan.")'>Detail</button>";		
					$tampil["nm_status_dr"]=$nm_status_dr;
					$tampil["foto"]=$url_foto_karyawan;
					$tampil["jenis_dokter"]=$fungsi_dokter;
					$tampil["tenaga_medis"]=$tenaga_medis;
					$tampil["status_dokter"]=$status_dokterX;
					$tampil["no"]=$i;
					
					
					
					
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>