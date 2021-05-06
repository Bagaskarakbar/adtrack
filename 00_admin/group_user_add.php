<?
session_start();
require_once("../_lib/function/db.php");

?>

	<div id="isiUtama">
		<div class="modal-header register-modal-head" style="background-color:#2ca4d7">
			<h5 class="modal-title" style="color:white">Tambah User Group</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card-body" id="tab_frame">
		<form name="xxx" id="FormUserAddEdit" method="post" action="user_act.php?act=<?= $aksi?>">
		<div class="formInputSubmitMulti">
			
			<div class="form-group row">
			<label  class="col-sm-2 col-form-label">Nama Group User</label>
			<div class="col-sm-10">
			  <input type="text" name="nama_group" class="form-control">
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label  class="col-sm-2 col-form-label">Keterangan</label>
			<div class="col-sm-10">
			  <textarea name="keterangan" rows="3" cols="50" class="form-control"></textarea>
			</div>
		  </div>
		  
		<div class="modal-footer">
			<div class="formInputSubmitMulti">
				<input type="button" value="Selesai" name="submit" onclick="tambah_user_add_edit()" class="btn btn-primary font-weight-bold">&nbsp;
				<input type="reset" value="Batal" class="btn btn-warning font-weight-bold" data-dismiss="modal">
			</div>
		
		</div>
		</div>
		</form>
		</div>
	</div>
	<script>
		function tambah_user_add_edit(){
			var dataform=$("#FormUserAddEdit").serialize();
			$.ajax({
			  type: "POST",
			  url: '/00_admin/group_user_act.php',
			  data: dataform,
			  success: function(data){
				  if(data.code=='1'){
					  alert('Sukses');
					  $("#TableView").bootstrapTable('refresh');
					  $('#ModalTambahgroup').modal('hide');
					  $('#idGroup').load("../00_admin/group_add.php");
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});

		}
	</script>