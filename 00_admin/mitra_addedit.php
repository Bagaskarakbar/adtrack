<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
//$db->debug=true;

if ($id_mt_mitra!=""){
	$sql= "select * from mt_mitra where id_mt_mitra = $id_mt_mitra";
	$hasil = $db->Execute($sql);
	$id_mt_mitra =$hasil->Fields("id_mt_mitra");
	$no_pelanggan =$hasil->Fields("no_pelanggan");
	$nama_pelanggan =$hasil->Fields("nama_pelanggan");
	$id_mt_jenis_pelanggan =$hasil->Fields("id_mt_jenis_pelanggan");
	
	//$cek="edit";
}
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Mitra</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form id="idForm" method="POST" action="#"  enctype="multipart/form-data">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-4">
					<label >Jenis Pelanggan</label>
				</div>
				<div class="col-lg-8">
					<select class="form-control" name="id_mt_jenis_pelanggan">
						<?  
						$sql_jenis_pelanggan = "select * from mt_jenis_pelanggan";
						pilihan_list($sql_jenis_pelanggan,"jenis_pelanggan","id_mt_jenis_pelanggan","id_mt_jenis_pelanggan",$id_mt_jenis_pelanggan);
						?>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-4">
					<label >No Pelanggan</label>
				</div>
				<div class="col-lg-8">
					<input type="text" class="form-control"  name="no_pelanggan" value="<?=$no_pelanggan?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-4">
					<label >Nama Pelanggan</label>
				</div>
				<div class="col-lg-8">
					<input type="text" class="form-control"  name="nama_pelanggan" value="<?=$nama_pelanggan?>">
				</div>
			</div>
		</div>
		<?if ($id_mt_mitra!=""){?>
			<input type="hidden" class="form-control" name="act" value="edit">
			<input type="hidden" class="form-control" name="id_mt_mitra" value="<?=$id_mt_mitra?>">
		<?}else{?>
			<input type="hidden" class="form-control" name="act" value="add">
		<?}?>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		<?if ($id_mt_mitra!=""){?>
			<button type="button" class="btn btn-success" onclick="SubmitMitra()">Edit</button>
			
		<?}else{?>
			<button type="button" class="btn btn-success" onclick="SubmitMitra()">Add</button>
			
		<?}?>
		
	</div>
	</form>
</div>

<script>
function SubmitMitra(){
	var dataform=$("#idForm").serialize();
	$.ajax({
		type: "POST",
		url: '/00_admin/mitra_act.php',
		data: dataform,
		success: function(data){
			if(data.code=='200'){
				$("#TableViewMitra").bootstrapTable('refresh');
				$('#BuatModal').modal('hide');
			}else{
				alert('Gagal');
			}
		},
		dataType: "json"
	});
}
</script>