<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
	if($search) {
		$sqlPlus = " WHERE  nama_pegawai LIKE'%$search%'";
		
	}

	$sql = "SELECT * FROM karyawan_v  $sqlPlus ORDER BY nama_pegawai";
	$sql_count="select count(nama_pegawai) as jum from ($sql) as a";
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
				$tampil["no"]			=$i;
				$no_induk 				= $tampil["no_induk"];
				$nama_pegawai 			= $tampil["nama_pegawai"];
				$nama_bagian	 		= $tampil["nama_bagian"];
				$nama_jabatan		 	= $tampil["nama_jabatan"];
				$username 				= $tampil["username"];
				$nama_group 			= $tampil["nama_group"];
				
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_user_view($id_dd_user)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='ubah_user_view($id_dd_user)'>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
				

				$cek_del = "";

				//if($id_dd_user!="")$cek_del=baca_tabel("log_user_login","id_dd_user","WHERE id_dd_user=".$id_dd_user);
				if($id_dd_user=="1")$cek_del=1;
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>