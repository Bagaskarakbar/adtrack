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

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white"><?= $judul?> Sub Menu</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
<div class="modal-body">
	<!-- ========================================================================================= -->
	<div id="isiUtama">

		<form name="xxx" method="post" action="#" id="formSubMenu">
		<input type='hidden' name='act' value='<?= $aksi?>'>
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-5">
					<label >Modul</label>
				</div>
				<div class="col-lg-7">
					<select class="form-control"name="id_dc_modul" onchange="rubahMenu()">
						<?  
						$sql_kelompok = "select * from dc_modul";
						pilihan_list($sql_kelompok,"nama_modul","id_dc_modul","id_dc_modul",$id_dc_modul);
						?>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5">
					<label >Menu</label>
				</div>
				<div class="col-lg-7">
					<select class="form-control" name="id_dc_menu" >
							<option value="">-- Pilih Menu --</option>
							<?
							if (is_numeric($id_dc_modul)){
								$sql_kelompok = "select * from dc_menu where id_dc_modul=$id_dc_modul";
								pilihan_list($sql_kelompok,"nama_menu","id_dc_menu","id_dc_menu",$id_dc_menu);
							}
							?>
						</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5">
					<label >Nama Sub Menu</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control" name="nama_sub_menu" value="<?= $nama_sub_menu ?>" <?= $inputDisabled?> >
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5">
					<label >URL</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control" name="url_sub_menu" value="<?= $url_sub_menu ?>"<?= $inputDisabled?> >
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5">
					<label >No Urut</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control" name="no_urut" value="<?= $no_urut ?>"<?= $inputDisabled?> >
				</div>
			</div>
			<br>
		</div>
		
		
		
		<input type="hidden" name="id_dc_sub_menu" value="<?=$id_dc_sub_menu?>">
		
		<div class="modal-footer">
		
		<input type="button" name="Submit" value="Submit" class="btn btn-success" onclick="SaveSubMenu()" <?= $inputDisabled?> >&nbsp;
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		
		</div>
		</form>

	</div>
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
						  alert('Sukses');
						  $("#BuatModal").modal('hide');
						 // Swal.fire("Sukses ","Berhasil Menyimpan Sub Menu","success");						 
						  $("#kt_datatable1").bootstrapTable('refresh');
					  }else{
						 // Swal.fire('Gagal Menyimpan Sub Menu');
						  alert('Gagal');
					  }
				  },
				  dataType: "json"
				});
		}
	}
</script>