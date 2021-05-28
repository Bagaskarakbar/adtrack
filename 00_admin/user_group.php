<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">User Group</div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahGroup()">Tambah User Group</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_groupuser_json.php" data-pagination="true" data-trim-on-search="true" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th data-field="nama_group">Nama Group</th>
						<th data-field="keterangan">Keterangan</th>
					</tr>
				</thead>
			</table>
		</div>
			
	</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahGroup(){
	$("#idIsiModal").load("../00_admin/group_user_add.php",function(){
	$("#BuatModal").modal("show");
	});
}
function ubahGroupuser(a){
	$("#idIsiModal").load("../00_admin/group_user_edit.php",{id:a},function(){
	$("#BuatModal").modal("show");
	});
	
}

function hapusGroupuser(a){
	var x=confirm('Yakin ingin menghapus user ini?');
		if(x){
			$.ajax({
			  type: "POST",
			  url: '/00_admin/group_user_del_act.php',
			  data: {id_dd_user_group:a},
			  success: function(data){
				  if(data.code=='1'){
					  alert('Sukses');
					  $("#TableView").bootstrapTable('refresh');
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});
		}
}

</script>