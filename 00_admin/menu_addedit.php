<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
//$db->debug=true;
if ($id_dc_menu) {

	$judul="Edit";
	$aksi="edit";
	$sql = "SELECT * FROM dc_menu where id_dc_menu=$id_dc_menu";

	$hasil =& $db->Execute($sql);

	$id_dc_menu = $hasil->Fields('id_dc_menu');
	$id_dc_modul = $hasil->Fields('id_dc_modul');
	$nama_menu = $hasil->Fields('nama_menu');
	$url = $hasil->Fields('url');
	$no_urut = $hasil->Fields('no_urut');
	$input_id = $hasil->Fields('input_id');
	$input_tgl = $hasil->Fields('input_tgl');

}else{

	$judul="Tambah";
	$aksi="add";
}
//var_dump($_SESSION);
//$loginInfo["username"]
//die;
?>

<div class="card-body">
	<!-- ========================================================================================= -->
	<div class="card-title">
		<h3 class="card-label"><?= $judul?> Menu</h3>
	</div>
	<!-- ========================================================================================= -->

	<!-- ========================================================================================= -->
	<div id="isiUtama">

		<form name="xxx" method="post" action="#" id="formDataMenu">
		<table cellpadding="0" cellspacing="0" class="table">
		<tr>
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kiri">

				<table cellpadding="0" cellspacing="0" >
				<tr>
					<td class="field">Modul</td>
					<td class="input">
						<select class="form-control"name="id_dc_modul">
						<?  
						$sql_kelompok = "select * from dc_modul";
						pilihan_list($sql_kelompok,"nama_modul","id_dc_modul","id_dc_modul",$id_dc_modul);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field">Nama Menu</td>
					<td class="input"><input type="text" class="form-control" name="nama_menu" value="<?= $nama_menu ?>" style="width:200px"></td>
				</tr>
				<tr>
					<td class="field">No Urut</td>
					<td class="input"><input type="text" class="form-control" name="no_urut" value="<?= $no_urut ?>" style="width:200px"></td>
				</tr>

				</table>

			</td>
			<!-- --------------------------------------------------------------------------------- -->
		</tr>
		</table>
		<input type="hidden" name="id_dc_menu" value="<?=$id_dc_menu?>">
		<div class="formInputSubmit"><input type="button" name="Submit" value="Submit" class="btn btn-success" onclick="SaveMenu()">&nbsp;<input type="reset" value="Batal" class="btn btn-danger" onclick="javascript:window.close();return false;"></div>
		</form>

	</div>
</div>
<script>
function SaveMenu(){
	var x = confirm("Simpan Menu?");
	if(x){
		var dataFormMenu=$("#formDataMenu").serialize();
		$.ajax({
			  type: "POST",
			  url: '/00_admin/menu_act.php?act=<?= $aksi?>',
			  data: dataFormMenu,
			  success: function (res){
				  if(res.code=='200'){
					  $("#BuatModal").modal('hide');
					  Swal.fire("Sukses ","Berhasil Menyimpan Menu","success");						 
					  $("#kt_datatable1").bootstrapTable('refresh');
				  }else{
					  Swal.fire('Gagal Menyimpan Menu');
				  }
			  },
			  dataType: "json"
			});
	}
}
</script>
	<!-- ========================================================================================= -->
