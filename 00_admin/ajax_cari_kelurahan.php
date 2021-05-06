<?
session_start();
require_once("../_lib/function/db.php"); /* koneksi */
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
?>

<select class="form-control" name="kelurahan" id="kelurahan" tabindex="7" >
	<option value="0">-- pilih Kelurahan --</option>
	<? 
	$getKelurahan="SELECT id_dc_kelurahan, nama_kelurahan FROM dc_kelurahan WHERE id_dc_kecamatan = $id_dc_kecamatan AND $id_dc_kota=$id_dc_kota AND $id_dc_propinsi = $id_dc_propinsi";
	pilihan_list($getKelurahan,"nama_kelurahan","id_dc_kelurahan","id_dc_kelurahan"); ?>
</select>