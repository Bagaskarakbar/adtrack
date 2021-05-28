<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Project</div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahProject()">Tambah Project
</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
			<table id="TableViewProject" class="table" data-toggle="table" data-url="/00_admin/project_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="jenis_project">Nama Project</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>

function tambahProject(a){
	$("#idIsiModal").load('/00_admin/project_addedit.php',{id_mt_jenis_project:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahProject(a){
	$("#idIsiModal").load('/00_admin/project_addedit.php',{id_mt_jenis_project:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusProject(id_mt_jenis_project){
var x = confirm('Hapus Project?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/project_act.php',	  
		  data:{id_mt_jenis_project,act},
		  success: function (data){
			  if(data.code=='200'){
				$("#TableViewProject").bootstrapTable('refresh');
				$('#BuatModal').modal('hide');
			  }else{
				   alert('Gagal');
			  }
		  },
		  dataType: "json"
		});
	}

}
</script>