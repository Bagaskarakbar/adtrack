<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");
	//$db->debug=true;
	
switch ($tipeCari) {
	case "nama" :
	$sqlPlus = "AND nama_perusahaan LIKE'%$filter%'";
	break;
	default :
	$sqlPlus = "";
}

	$sql = "SELECT * FROM mt_perusahaan WHERE flag_mitra=1 $sqlPlus ORDER BY nama_perusahaan";
	$sql_count="select count(kode_perusahaan) as jum from ($sql) as a";
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
				$id_perusahaan			= $tampil["id_perusahaan"];
				$kode_perusahaan 		= $tampil["kode_perusahaan"];
				$nama_perusahaan 		= $tampil["nama_perusahaan"];
				$alamat	 				= $tampil["alamat"];
				$telpon		 			= $tampil["telpon1"];
				$kontakperson 			= $tampil["kontakperson"];
				$flag_status 			= $tampil["flag_status"];
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_yankes($id_perusahaan)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='ubah_yankes($id_perusahaan)'>
							<i class='las la-edit icon-lg text-success '></i>
							</a>";
				$tampil["perjanjian"] = $tampil["nama_perjanjian"];
				$tampil["yankes"]="<button class='btn btn-primary'> YANKES <button>";
				
				
							
				$status = $flag_status;
				$tampil["telpon"]		= $telpon;
				$kode_dokter 			= $tampil["kode_dokter"];
				
				if($status==1){
					$tampil['status']	="Aktif";
				}else{
					$tampil['status']	="Non Aktif";
				}
				

				$cek_del = "";

				//if($id_dd_user!="")$cek_del=baca_tabel("log_user_login","id_dd_user","WHERE id_dd_user=".$id_dd_user);
				if($id_dd_user=="1")$cek_del=1;
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>