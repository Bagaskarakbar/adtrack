<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function", "function.pilihan_list");

	if (is_numeric($id_dc_modul)) {
?>
	
	
	<?
		$sql = "SELECT id_dc_menu, nama_menu, no_urut FROM dc_menu WHERE id_dc_modul = $id_dc_modul ORDER BY no_urut";
		pilihan_list($sql, "nama_menu", "id_dc_menu");
	?>
	
<?
	} else {
?>
	
	<option value="">-- Pilih Menu --</option>
	
<?
	}
?>
