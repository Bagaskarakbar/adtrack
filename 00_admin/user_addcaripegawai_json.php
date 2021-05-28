<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","variabel");
loadlib("function","function.olah_tabel");
loadlib("class","Paging");
//$db->debug=true;

switch ($tipeCari) {
	case "nama" :
	$sqlPlus = "AND nama_pegawai LIKE'%$filter%'";
	break;
	case "bagian" :
	$sqlPlus = "AND nama_bagian LIKE'%$filter%'";
	break;
	case "noinduk" :
	$sqlPlus = "AND no_induk LIKE'%$filter%'";
	break;
	default :
	$sqlPlus = "";
}

	/*$sql = "
		SELECT		k.*,b.nama_bagian
		FROM		mt_karyawan k, mt_bagian b
		WHERE		k.kode_bagian=b.kode_bagian
		AND			k.no_induk NOT IN (SELECT no_induk FROM dd_user)
			$sqlPlus
		ORDER BY	nama_pegawai
		";*/
		$sql = " SELECT k.*,b.nama_bagian,b.status_aktif FROM mt_karyawan as k LEFT JOIN mt_bagian as b ON k.kode_bagian=b.kode_bagian WHERE no_induk is not null $sqlPlus 	ORDER BY	nama_pegawai";
		$sql_count="select count(no_induk) as jum from ($sql) as a";
		$run_count=$db->Execute($sql_count);
		while($tpl_count=$run_count->fetchRow()){
			$data['count']=$tpl_count['jum'];
		}

	    /*SELECT		k.*,b.nama_bagian
		FROM		mt_karyawan k, mt_bagian b
		WHERE		k.kode_bagian=b.kode_bagian $sqlPlus
		ORDER BY	nama_pegawai*/
		$recperpage = $limit;
		$hal=($offset/$limit)+1;

		$pagenya = new Paging($db, $sql, $recperpage);
		$rsPaging = $pagenya->ExecPage($hal);
		$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;

		
		$i = $pagenya->pagingVars["firstno"];
		while ($tampil=$rsPaging->FetchRow()) {
			$i++;

			$no_induk = $tampil["no_induk"];
			$nama_pegawai = $tampil["nama_pegawai"];
			$status_aktif = $tampil["status_aktif"];
			$nama_bagian = $tampil["nama_bagian"];
			$kode_dokter = $tampil["kode_dokter"];
			$kode_spesialisasi = $tampil["kode_spesialisasi"];
			$url_foto_karyawan = $tampil["url_foto_karyawan"];
			
			if($status_aktif=="1"){
				$status="Aktif";
			}else if($status_aktif=="0"){
				$status="Non Aktif";
			}
			
			if($url_foto_karyawan!=""){
				$url_foto_karyawan="<img src='$url_foto_karyawan' width='50' height='50'/>";
			}else{
				$url_foto_karyawan=	"<img src='assets/media/svg/avatars/001-boy.svg' width='50' height='50' />";
			}
			
			$tampil['status']=$status;
			$tampil['foto']=$url_foto_karyawan;
			$tampil['add_user']="<i class='pe-7s-users text-success' style='cursor:pointer' onclick=add_user_act('$no_induk')></i>";
			$no = $i.".";
			$tampil["action_hapus"]="<a href='#' title='Hapus Data' onclick='hapus_karyawan($no_induk)'>
			<i class='pe-7s-trash text-danger '></i>
			</a>";
			$tampil["action_edit"]="<a href='#' title='Edit  Data' onclick='ubah_karyawan($no_induk)'>
			<i class='pe-7s-edit text-success '></i>
			</a>";

			if($kode_dokter!="" && $kode_spesialisasi!=""){
				$nama_bagian=baca_tabel("mt_spesialisasi_dokter","nama_spesialisasi"," where kode_spesialisasi=".$kode_spesialisasi );
				$tampil['nama_bagian']=$nama_bagian;
			}
			$tampil["no"]=$i;
			$data['items'][]=$tampil;
	} // end of while ($rsPaging->FetchRow())
	echo json_encode($data);
	?>