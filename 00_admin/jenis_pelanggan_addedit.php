<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
//$db->debug=true;

if ($id_mt_jenis_pelanggan!=""){
	$sql= "select * from mt_jenis_pelanggan where id_mt_jenis_pelanggan = $id_mt_jenis_pelanggan";
	$hasil = $db->Execute($sql);
	$jenis_pelanggan =$hasil->Fields("jenis_pelanggan");
	
	//$cek="edit";
}
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Jenis Pelanggan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form id="idForm" method="POST" action="#"  enctype="multipart/form-data">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-5">
					<label >Jenis Pelanggan</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control"  name="jenis_pelanggan" value="<?=$jenis_pelanggan?>">
				</div>
			</div>
		</div>
		<?if ($id_mt_jenis_pelanggan!=""){?>
			<input type="hidden" class="form-control" name="act" value="edit">
			<input type="hidden" class="form-control" name="id_mt_jenis_pelanggan" value="<?=$id_mt_jenis_pelanggan?>">
		<?}else{?>
			<input type="hidden" class="form-control" name="act" value="add">
		<?}?>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		<?if ($id_mt_jenis_pelanggan!=""){?>
			<button type="button" class="btn btn-success" onclick="SubmitPelanggan()">Edit</button>
			
		<?}else{?>
			<button type="button" class="btn btn-success" onclick="SubmitPelanggan()">Add</button>
			
		<?}?>
		
	</div>
	</form>
</div>

<script>
function SubmitPelanggan(){
	var dataform=$("#idForm").serialize();
	$.ajax({
		type: "POST",
		url: '/00_admin/jenis_pelanggan_act.php',
		data: dataform,
		success: function(data){
			if(data.code=='200'){
				$("#TableViewPelanggan").bootstrapTable('refresh');
				$('#BuatModal').modal('hide');
			}else{
				alert('Gagal');
			}
		},
		dataType: "json"
	});
}
</script>