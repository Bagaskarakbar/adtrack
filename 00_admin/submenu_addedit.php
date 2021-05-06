<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
//loadlib("function","function.olah_tabel");

if ($id_dc_sub_menu) {

	$judul="Edit";
	$aksi="edit";
	$sql = "SELECT * FROM dc_sub_menu where id_dc_sub_menu=$id_dc_sub_menu";

	$hasil =& $db->Execute($sql);

	$id_dc_sub_menu = $hasil->Fields('id_dc_sub_menu');
	$id_dc_menu = $hasil->Fields('id_dc_menu');
	$nama_sub_menu = $hasil->Fields('nama_sub_menu');
	$url_sub_menu = $hasil->Fields('url_sub_menu');
	$no_urut = $hasil->Fields('no_urut');
	$input_id = $hasil->Fields('input_id');
	$input_tgl = $hasil->Fields('input_tgl');

}else{

	$judul="Tambah";
	$aksi="add";
	$inputDisabled = "disabled";

}
//var_dump($_SESSION);
//$loginInfo["username"]

?>

<div class="card-body">
	<!-- ========================================================================================= -->
	<div class="card-title">
		<h3 class="card-label"><?= $judul?> Sub Menu</h3>
	</div>	
	<!-- ========================================================================================= -->

	<!-- ========================================================================================= -->
	<div id="isiUtama">

		<form name="xxx" method="post" action="#" id="formSubMenu">
		<input type='hidden' name='act' value='<?= $aksi?>'>
		<table cellpadding="0" cellspacing="0" class="formInput">
		<tr>
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kiri">

				<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="field">Modul</td>
					<td class="input">
						<select class="form-control"name="id_dc_modul" onchange="rubahMenu()" style="width:200px">
							<option value="">-- Pilih Modul --</option>
							<?
							$sql_kategori="SELECT id_dc_modul,nama_modul FROM dc_modul ";
							pilihan_list($sql_kategori,"nama_modul","id_dc_modul","id_dc_modul",$id_dc_modul);
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field">Menu</td>
					<td class="input" id="menu">
						<select class="form-control" name="id_dc_menu" style="width:200px" >
							<option value="">-- Pilih Menu --</option>
							<?
							if (is_numeric($id_dc_modul)){
								$sql_kelompok = "select * from dc_menu where id_dc_modul=$id_dc_modul";
								pilihan_list($sql_kelompok,"nama_menu","id_dc_menu","id_dc_menu",$id_dc_menu);
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field">Nama Sub Menu</td>
					<td class="input"><input type="text" class="form-control" name="nama_sub_menu" value="<?= $nama_sub_menu ?>" style="width:300px" <?= $inputDisabled?> ></td>
				</tr>
				<tr>
					<td class="field">URL</td>
					<td class="input"><input type="text" class="form-control" name="url_sub_menu" value="<?= $url_sub_menu ?>" style="width:300px" <?= $inputDisabled?> ></td>
				</tr>
				<tr>
					<td class="field">No Urut</td>
					<td class="input"><input type="text" class="form-control" name="no_urut" value="<?= $no_urut ?>" style="width:300px" <?= $inputDisabled?> ></td>
				</tr>

				</table>

			</td>
			<!-- --------------------------------------------------------------------------------- -->
		</tr>
		</table>
		<input type="hidden" name="id_dc_sub_menu" value="<?=$id_dc_sub_menu?>">
		<div class="formInputSubmit"><input type="button" name="Submit" value="Submit" class="btn btn-success" onclick="SaveSubMenu()" <?= $inputDisabled?> >&nbsp;<input type="reset" value="Batal" class="btn btn-danger" onclick="javascript:window.close();return false;" <?= $inputDisabled?> ></div>
		</form>

	</div>
</div>
	<!-- ========================================================================================= -->
<script language="JavaScript" type="text/javascript">
function rubahMenu() {
	var id_dc_modul=$("select[name=id_dc_modul]").val();
	$("select[name=id_dc_menu]").load("/00_admin/getMenu.php",{id_dc_modul},function (){
		$('input').prop("disabled", false);
	});
}
function SaveSubMenu(){
		var x = confirm("Simpan Sub Menu?");
		if(x){
			var dataFormSubMenu=$("#formSubMenu").serialize();
			$.ajax({
				  type: "POST",
				  url: '/00_admin/submenu_act.php',
				  data: dataFormSubMenu,
				  success: function (res){
					  if(res.code=='200'){
						  $("#BuatModal").modal('hide');
						  Swal.fire("Sukses ","Berhasil Menyimpan Sub Menu","success");						 
						  $("#kt_datatable1").bootstrapTable('refresh');
					  }else{
						  Swal.fire('Gagal Menyimpan Sub Menu');
					  }
				  },
				  dataType: "json"
				});
		}
	}
</script>