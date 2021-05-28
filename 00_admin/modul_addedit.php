<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
//loadlib("function","function.olah_tabel");

if ($id_dc_modul) {

	$judul="Edit";
	$aksi="edit";
	$sql = "SELECT * FROM dc_modul where id_dc_modul=$id_dc_modul";

	$hasil =& $db->Execute($sql);

	$id_dc_modul = $hasil->Fields('id_dc_modul');
	$id_dc_modular = $hasil->Fields('id_dc_modular');
	$nama_modul = $hasil->Fields('nama_modul');
	$logo = $hasil->Fields('logo');
	$folder = $hasil->Fields('folder');
	$no_urut = $hasil->Fields('no_urut');
	$kode_bagian = $hasil->Fields('kode_bagian');
	$folder = $hasil->Fields('folder');

}else{

	$judul="Tambah";
	$aksi="add";
}
//var_dump($_SESSION);
//$loginInfo["username"]

?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white"><?= $judul?> Modul</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<div id="isiUtama">

		<form name="xxx" method="post" action="#" id="formDataModul">
		<table cellpadding="0" cellspacing="0" class="table">
		<tr>
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kiri">

				<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="field">Kelompok Modul</td>
					<td class="input">
						<select class="form-control" name="id_dc_modular">
						<?  
						$sql_kelompok = "select * from dc_modular";
						pilihan_list($sql_kelompok,"nama_modular","id_dc_modular","id_dc_modular",$id_dc_modular);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field">Nama Modul</td>
					<td class="input"><input type="text" class="form-control" name="nama_modul" value="<?= $nama_modul ?>" style="width:200px"></td>
				</tr>
				<tr>
					<td class="field">Kode Bagian</td>
					<td class="input"><input type="text" class="form-control" name="kode_bagian" value="<?= $kode_bagian ?>" style="width:200px"></td>
				</tr>
				<tr>
					<td class="field">No Urut</td>
					<td class="input"><input type="text" class="form-control" name="no_urut" value="<?= $no_urut ?>" style="width:200px"></td>
				</tr>
				<tr>
					<td class="field">Icon</td>
					<td class="input"><input type="text" class="form-control" name="logo" value="<?= $logo ?>" style="width:200px"></td>
				</tr>
				<tr>
					<td class="field">Folder</td>
					<td class="input"><input type="text" class="form-control" name="folder" value="<?= $folder ?>" style="width:200px"></td>
				</tr>

				</table>

			</td>
			<!-- --------------------------------------------------------------------------------- -->
		</tr>
		</table>
		<input type="hidden" name="id_dc_modul" value="<?=$id_dc_modul?>">
		
		<div class="modal-footer">
			<input type="button" name="Submit" value="Submit" class="btn btn-success" onclick="SaveModul()">
			<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		</div>
		</form>

	</div>
</div>
</div>
<script>
function SaveModul(){
		var x = confirm("Simpan Modul?");
		if(x){
			var dataFormModul=$("#formDataModul").serialize();
			$.ajax({
				  type: "POST",
				  url: '/00_admin/modul_act.php?act=<?= $aksi?>',
				  data: dataFormModul,
				  success: function (res){
					  if(res.code=='200'){
						  $("#BuatModal").modal('hide');
						  //Swal.fire("Sukses ","Berhasil Menyimpan Modul","success");						 
						  $("#kt_datatable1").bootstrapTable('refresh');
					  }else{
						  Swal.fire('Gagal Menyimpan Modul');
					  }
				  },
				  dataType: "json"
				});
		}
	}
</script>
	<!-- ========================================================================================= -->
