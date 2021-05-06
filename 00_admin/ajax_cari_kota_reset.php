<?
session_start();
require_once("../_lib/function/db.php"); /* koneksi */
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
?>

<select class="form-control" name="kota" id="kota" tabindex="8" onchange="ambilKota()" >
	<option>-- pilih Kota --</option>
</select>
