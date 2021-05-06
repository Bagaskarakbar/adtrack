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
			$sqlAddSem=" where (nama_kelurahan like '%$search%' or nama_kecamatan like '%$search%')";
		}
		
	$sql = "select id_dc_kelurahan,nama_kelurahan,nama_kecamatan,nama_kota,nama_propinsi from dc_kelurahan as a join dc_kecamatan as b on a.id_dc_kecamatan=b.id_dc_kecamatan join dc_kota as c on b.id_dc_kota=c.id_dc_kota join dc_propinsi as d on c.id_dc_propinsi=d.id_dc_propinsi $sqlAddSem order by nama_propinsi,nama_kota,nama_kecamatan";
	$sql_count="select count(id_dc_kelurahan) as jum from ($sql) as a";
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
				$id_dc_kelurahan 		= $tampil["id_dc_kelurahan"];
				$id_dc_kecamatan 		= $tampil["id_dc_kecamatan"];
				$nama_kecamatan 		= $tampil["nama_kecamatan"];
				$nama_kota 				= $tampil["nama_kota"];
				$nama_propinsi 			= $tampil["nama_propinsi"];
				$nama_kelurahan 		= $tampil["nama_kelurahan"];
				
				$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapusKelurahan($id_dc_kelurahan)'>
							<i class='las la-trash-alt icon-lg text-danger '></i>
							</a>";
				$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='addKelurahan($id_dc_kelurahan)'>
							<i class='las la-edit icon-lg text-success '></i>";
							
				$data['items'][]=$tampil;
			}
			echo json_encode($data);	
		?>