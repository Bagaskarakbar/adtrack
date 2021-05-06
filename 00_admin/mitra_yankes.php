<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.pilihan_list");
$SqlGetYankes="select kode_perusahaan,nama_perusahaan from mt_perusahaan where jenis_kerjasama='3'";

?>
<select class='form-control' name='kode_perusahaan'>
	<?
	pilihan_list($SqlGetYankes,"nama_perusahaan","kode_perusahaan");
	?>
</select>