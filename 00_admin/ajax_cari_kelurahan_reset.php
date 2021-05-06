<?
session_start();
require_once("../_lib/function/db.php"); /* koneksi */
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
?>

<select class="form-control" name="kelurahan" id="kelurahan" tabindex="10" onchange="" required >
	<option>-- pilih Kelurahan --</option>
</select>