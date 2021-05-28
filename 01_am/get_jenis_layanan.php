<?
session_start();
require_once("../_lib/function/db.php"); /* koneksi */
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
$db->debug=true;
?>

<select name="paket_layanan" id="paket_layanan" class="swal2-input">
  <option value="" disabled selected>Paket Layanan</option>
  <?
  $getPaket="SELECT * FROM mt_paket WHERE id_mt_layanan=$id_mt_layanan ORDER BY id_mt_paket ASC";
  pilihan_list($getPaket,"nama_paket","id_mt_paket","id_mt_paket");
  ?>
</select>
