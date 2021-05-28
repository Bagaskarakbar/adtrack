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

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white"><?= $judul?> Menu</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form name="xxx" method="post" action="#" id="formDataMenu">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-5">
					<label >Modul</label>
				</div>
				<div class="col-lg-7">
					<select class="form-control"name="id_dc_modul">
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
					<label >Nama Menu</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control" name="nama_menu" value="<?= $nama_menu ?>" style="width:200px">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5">
					<label >No Urut</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control" name="no_urut" value="<?= $no_urut ?>" style="width:200px">
				</div>
			</div>
		</div>
		<input type="hidden" name="id_dc_menu" value="<?=$id_dc_menu?>">
	</div>
	<div class="modal-footer">
		
		<input type="button" name="Submit" value="Submit" class="btn btn-success" onclick="SaveMenu()">&nbsp;<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		
	</div>
	</form>
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
					  alert('Sukses');
					  $("#BuatModal").modal('hide');
					  //Swal.fire("Sukses ","Berhasil Menyimpan Menu","success");						 
					  $("#kt_datatable1").bootstrapTable('refresh');
				  }else{
					  //Swal.fire('Gagal Menyimpan Menu');
					   alert('Gagal');
					  
				  }
			  },
			  dataType: "json"
			});
	}
}
</script>
	<!-- ========================================================================================= -->
