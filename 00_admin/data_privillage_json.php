<?	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","function.olah_tabel");
	
	$sql = "
	SELECT		s.*,m.nama_menu,m.no_urut AS no_urut_menu,d.nama_modul,d.id_dc_modul
		FROM		dc_sub_menu s,dc_menu m,dc_modul d
		WHERE		s.id_dc_menu=m.id_dc_menu AND m.id_dc_modul=d.id_dc_modul 
		ORDER BY	d.nama_modul,m.no_urut,s.no_urut 
	" ;
	
	$rsPaging=$db->Execute($sql);
			
				while ($tampil=$rsPaging->FetchRow()) {
					$i++;

					$id_dc_sub_menu 	= $tampil["id_dc_sub_menu"];
					$id_dc_menu 		= $tampil["id_dc_menu"];
					$id_dc_modul 		= $tampil["id_dc_modul"];
					$nama_sub_menu 		= $tampil["nama_sub_menu"];
					$url_sub_menu 		= $tampil["url_sub_menu"];
					$keterangan 		= $tampil["keterangan"];
					$no_urut 			= $tampil["no_urut"];
					$input_id 			= $tampil["input_id"];
					$input_tgl 			= $tampil["input_tgl"];
					$nama_menu 			= $tampil["nama_menu"];
					$nama_modul 		= $tampil["nama_modul"];
					
					if($kelompok!=""){
						
						$hak_akses=baca_tabel("dd_user_group_detail","id_dc_sub_menu"," where id_dc_sub_menu=$id_dc_sub_menu and id_dd_user_group=$kelompok");
						
					}else{
						
						$hak_akses="";
						
					}
					if($hak_akses!=""){
						$tampil["aktif"]="
						<select name='hak_akses_menu[$id_dc_sub_menu]' class='form-control'>
							<option value='5' selected>Aktif</option>
							<option value='0'>Non Aktif</option>
						</select>
						";
					}else{
						$tampil["aktif"]="
						<select name='hak_akses_menu[$id_dc_sub_menu]' class='form-control'>
							<option value='0'>Non Aktif</option>
							<option value='5'>Aktif</option>
						</select>
						";
					}
					$tampil["no"]=$i;
					$data['items'][]=$tampil;
					
				}
	echo json_encode($data);			
?>