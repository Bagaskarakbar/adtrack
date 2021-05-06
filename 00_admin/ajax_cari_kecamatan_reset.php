<?
session_start();
require_once("../_lib/function/db.php"); /* koneksi */
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
?>

<select class="form-control" name="kecamatan" id="kecamatan" tabindex="6" onchange="ambilKecamatan()" required >
	<option>-- pilih Kecamatan --</option>
</select>