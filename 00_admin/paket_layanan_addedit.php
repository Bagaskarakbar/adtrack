<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
//$db->debug=true;

if ($id_mt_paket!=""){
	$sql= "select * from mt_paket where id_mt_paket = $id_mt_paket";
	$hasil = $db->Execute($sql);
	$nama_paket =$hasil->Fields("nama_paket");
	$id_mt_layanan =$hasil->Fields("id_mt_layanan");
	
	//$cek="edit";
}
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Paket Layanan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form id="idForm" method="POST" action="#"  enctype="multipart/form-data">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-lg-5">
					<label >Nama Paket Layanan</label>
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control"  name="nama_paket" value="<?=$nama_paket?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5">
					<label >Nama Layanan</label>
				</div>
				<div class="col-lg-7">
					<select class="form-control" name="id_mt_layanan">
						<?  
						$sql_layanan = "select * from mt_layanan";
						pilihan_list($sql_layanan,"nama_layanan","id_mt_layanan","id_mt_layanan",$id_mt_layanan);
						?>
					</select>
				</div>
			</div>
		</div>
		<?if ($id_mt_paket!=""){?>
			<input type="hidden" class="form-control" name="act" value="edit">
			<input type="hidden" class="form-control" name="id_mt_paket" value="<?=$id_mt_paket?>">
		<?}else{?>
			<input type="hidden" class="form-control" name="act" value="add">
		<?}?>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		<?if ($id_mt_paket!=""){?>
			<button type="button" class="btn btn-success" onclick="SubmitPaketLayanan()">Edit</button>
			
		<?}else{?>
			<button type="button" class="btn btn-success" onclick="SubmitPaketLayanan()">Add</button>
			
		<?}?>
		
	</div>
	</form>
</div>

<script>
function SubmitPaketLayanan(){
	var dataform=$("#idForm").serialize();
	$.ajax({
		type: "POST",
		url: '/00_admin/paket_layanan_act.php',
		data: dataform,
		success: function(data){
			if(data.code=='200'){
				$("#TableViewPaketLayanan").bootstrapTable('refresh');
				$('#BuatModal').modal('hide');
			}else{
				alert('Gagal');
			}
		},
		dataType: "json"
	});
}
</script>