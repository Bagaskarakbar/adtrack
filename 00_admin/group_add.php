<?	session_start();

	require_once("../_lib/function/db.php");
	loadlib("function","function.pilihan_list");
?>

<select name="tipeCari" onChange="pilihPrivillage()" class="form-control" id="idKelompok">
																<option value="">-- Pilih Group User --</option>
																<?$sql_kelompok = "select * from dd_user_group ";
																	pilihan_list($sql_kelompok,"nama_group","id_dd_user_group","id_dd_user_group",$tipeCari);
																			
																?>
																</select>