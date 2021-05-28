<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
//$db->debug=true;

if ($id_mt_channel!=""){
	$sql= "select * from mt_channel where id_mt_channel = $id_mt_channel";
	$hasil = $db->Execute($sql);
	$nama_channel =$hasil->Fields("nama_channel");
	
	//$cek="edit";
}
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Channel</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form id="idForm" method="POST" action="#"  enctype="multipart/form-data">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-5">
					<label >Nama Channel</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control"  name="nama_channel" value="<?=$nama_channel?>">
				</div>
			</div>
		</div>
		<?if ($id_mt_channel!=""){?>
			<input type="hidden" class="form-control" name="act" value="edit">
			<input type="hidden" class="form-control" name="id_mt_channel" value="<?=$id_mt_channel?>">
		<?}else{?>
			<input type="hidden" class="form-control" name="act" value="add">
		<?}?>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		<?if ($id_mt_channel!=""){?>
			<button type="button" class="btn btn-success" onclick="SubmitChannel()">Edit</button>
			
		<?}else{?>
			<button type="button" class="btn btn-success" onclick="SubmitChannel()">Add</button>
			
		<?}?>
		
	</div>
	</form>
</div>

<script>
function SubmitChannel(){
	var dataform=$("#idForm").serialize();
	$.ajax({
		type: "POST",
		url: '/00_admin/chanel_act.php',
		data: dataform,
		success: function(data){
			if(data.code=='200'){
				$("#TableViewChanel").bootstrapTable('refresh');
				$('#BuatModal').modal('hide');
			}else{
				alert('Gagal');
			}
		},
		dataType: "json"
	});
}
</script>