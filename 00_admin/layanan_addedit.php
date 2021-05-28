<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
//$db->debug=true;

if ($id_mt_layanan!=""){
	$sql= "select * from mt_layanan where id_mt_layanan = $id_mt_layanan";
	$hasil = $db->Execute($sql);
	$nama_layanan =$hasil->Fields("nama_layanan");
	
	//$cek="edit";
}
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Layanan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form id="idForm" method="POST" action="#"  enctype="multipart/form-data">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-4">
					<label >Nama Layanan</label>
				</div>
				<div class="col-lg-8">
					<input type="text" class="form-control"  name="nama_layanan" value="<?=$nama_layanan?>">
				</div>
			</div>
		</div>
		<?if ($id_mt_layanan!=""){?>
			<input type="hidden" class="form-control" name="act" value="edit">
			<input type="hidden" class="form-control" name="id_mt_layanan" value="<?=$id_mt_layanan?>">
		<?}else{?>
			<input type="hidden" class="form-control" name="act" value="add">
		<?}?>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		<?if ($id_mt_layanan!=""){?>
			<button type="button" class="btn btn-success" onclick="SubmitLayanan()">Edit</button>
			
		<?}else{?>
			<button type="button" class="btn btn-success" onclick="SubmitLayanan()">Add</button>
			
		<?}?>
		
	</div>
	</form>
</div>

<script>
function SubmitLayanan(){
	var dataform=$("#idForm").serialize();
	$.ajax({
		type: "POST",
		url: '/00_admin/layanan_act.php',
		data: dataform,
		success: function(data){
			if(data.code=='200'){
				$("#TableViewLayanan").bootstrapTable('refresh');
				$('#BuatModal').modal('hide');
			}else{
				alert('Gagal');
			}
		},
		dataType: "json"
	});
}
</script>