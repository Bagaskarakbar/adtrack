<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");

$sqlGroupuser=read_tabel("dd_user_group","*"," where id_dd_user_group=$id");
$nama_group=$sqlGroupuser->fields("nama_group");
$keterangan=$sqlGroupuser->fields("keterangan");
?>

	<div id="isiUtama">
		<div class="modal-header register-modal-head" style="background-color:#d92550">
			<h5 class="modal-title" style="color:white">Edit User Group</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card-body" id="tab_frame">
		<form name="xxx" id="FormUserAddEdit" method="post" action="user_act.php?act=<?= $aksi?>">
		<div class="formInputSubmitMulti">
			
			<div class="form-group row">
			<label  class="col-sm-4 col-form-label">Nama Group User</label>
			<div class="col-sm-8">
			  <input type="text" name="nama_group" class="form-control" value="<?=$nama_group?>">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label  class="col-sm-4 col-form-label">Keterangan</label>
			<div class="col-sm-8">
			  <textarea name="keterangan" rows="3" cols="50" class="form-control"><?=$keterangan?></textarea>
			</div>
		  </div>
		  
		<div class="modal-footer">
			<div class="formInputSubmitMulti">
				<input type="button" value="Selesai" name="submit" onclick="tambah_user_add_edit()" class="btn btn-success">&nbsp;
				<input type="reset" value="Close" class="btn btn-danger" data-dismiss="modal">
			</div>
		
		</div>
		</div>
		<input type="hidden" name="id_dd_user_group" value="<?=$id?>">
		</form>
		</div>
	</div>
	<script>
		function tambah_user_add_edit(){
			var dataform=$("#FormUserAddEdit").serialize();
			$.ajax({
			  type: "POST",
			  url: '/00_admin/group_useredit_act.php',
			  data: dataform,
			  success: function(data){
				  if(data.code=='1'){
					 alert('Sukses');
					  $("#TableView").bootstrapTable('refresh');
					  $('#BuatModal').modal('hide');
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});

		}
	</script>
