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
			$sqlAddSem=" where (nama_kecamatan like '%$search%' or nama_kota like '%$search%' or nama_propinsi like '%$search%')";
		}

	$sql = "select id_dc_kecamatan,nama_kecamatan,nama_kota,nama_propinsi from dc_kecamatan as a join dc_kota as b on a.id_dc_kota=b.id_dc_kota join dc_propinsi as c on b.id_dc_propinsi=c.id_dc_propinsi $sqlAddSem order by nama_propinsi ";
	$sql_count="select count(id_dc_kecamatan) as jum from ($sql) as a";
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
				$tampil["no"]			= $i;
				$id_dc_kecamatan 		= $tampil["id_dc_kecamatan"];
				$nama_kecamatan 		= $tampil["nama_kecamatan"];
				$nama_kota 				= $tampil["nama_kota"];
				$nama_propinsi 			= $tampil["nama_propinsi"];
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapusKecamatan($id_dc_kecamatan)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='addKecamatan($id_dc_kecamatan)'>
							<i class='las la-edit icon-lg text-success '></i>";
							
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>