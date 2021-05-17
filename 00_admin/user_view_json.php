<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");

	/* switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "WHERE nama_pegawai LIKE'%$filter%'";
			break;
		case "id" :
			$sqlPlus = "WHERE username LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	} */
	
	if(!empty($search)){
		$sqlPlus=" where (nama_pegawai like '%$search%' or username like '%$search%' or nama_bagian like '%$search%')";
	}

	$sql = "SELECT * FROM user_karyawan_v $sqlPlus ORDER BY username";
	$sql_count="select count(id_dd_user) as jum from ($sql) as a";
	$run_count=$db->Execute($sql_count);
	while($tpl_count=$run_count->fetchRow()){
		$data['count']=$tpl_count['jum'];
	}
	$recperpage = $limit;
	$hal=($offset/$limit)+1;

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;
	?>
	<?
			$i = $pagenya->pagingVars["firstno"];
		
			while ($tampil=$rsPaging->FetchRow()) {
				$i++;
				$tampil["no"]=$i;
				$id_dd_user = $tampil["id_dd_user"];
				$username = $tampil["username"];
				$nama_pegawai = $tampil["nama_pegawai"];
				$nama_bagian = $tampil["nama_bagian"];
				$no_induk = $tampil["no_induk"];
				$nama_group = $tampil["nama_group"];
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_user_view($id_dd_user)'>
							<i class='pe-7s-trash text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a title='Edit  Data' onclick='ubah_user_view($id_dd_user)'>
							<i class='pe-7s-edit text-success '></i>
							</a>";
				$status = $tampil["status"];
				$kode_dokter = $tampil["kode_dokter"];
				if($status==0){
					$tampil['status']="Aktif";
				}else{
					$tampil['status']="Non Aktif";
				}
				if(is_numeric($kode_dokter)){

						$kode_spesialisasi=baca_tabel("mt_karyawan","kode_spesialisasi"," where kode_dokter=".$kode_dokter );
						if(is_numeric($kode_spesialisasi)){
							$nama_bagian =baca_tabel("mt_spesialisasi_dokter","nama_spesialisasi"," where kode_spesialisasi=".$kode_spesialisasi );
						}
						$tampil['nama_bagian']=$nama_bagian;
			}

				$cek_del = "";

				//if($id_dd_user!="")$cek_del=baca_tabel("log_user_login","id_dd_user","WHERE id_dd_user=".$id_dd_user);
				if($id_dd_user=="1")$cek_del=1;
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>