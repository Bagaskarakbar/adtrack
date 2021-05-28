<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Bundling</div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahBundling()">Tambah Bundling</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
			<table id="TableViewBundling" class="table" data-toggle="table" data-url="/00_admin/bundling_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="nama_bundling">Nama Bundling</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>

function tambahBundling(a){
	$("#idIsiModal").load('/00_admin/bundling_addedit.php',{id_mt_bundling:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahBundling(a){
	$("#idIsiModal").load('/00_admin/bundling_addedit.php',{id_mt_bundling:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusBundling(id_mt_bundling){
var x = confirm('Hapus Bundnling?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/bundling_act.php',	  
		  data:{id_mt_bundling,act},
		  success: function (data){
			  if(data.code=='200'){
				$("#TableViewBundling").bootstrapTable('refresh');
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