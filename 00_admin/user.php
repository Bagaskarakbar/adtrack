<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">User </div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambah('/00_admin/user_addcaripegawai.php')">Tambah User</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/user_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="username">User ID</th>
						<th width="150" data-field="nama_pegawai">Nama Pegawai</th>
						<th width="100" data-field="nama_bagian">Bagian</th>
						<th width="150" data-field="nama_group">Group User</th>
						<th width="40" data-field="status">Status</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
	</div>
	
<!--<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>-->


<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
	function ubah_user_view(a){
		$("#idIsiModal").load('/00_admin/user_addedit.php',{id_dd_user:a,act:'edit'},function(){
			$("#BuatModal").modal("show");
		});
	}
	function tambah(link){
		$("#idIsiModal").load(link,{},function(){
			$("#BuatModal").modal("show");
		});
	}
	
	function hapus_user_view(a){
		var x=confirm('Yakin ingin menghapus user ini?');
		if(x){
			$.ajax({
			  type: "POST",
			  url: '/00_admin/user_act.php',
			  data: {id_dd_user:a,act:'delete'},
			  success: function(data){
				  if(data.code='200'){
						$("#TableView").bootstrapTable('refresh');
						$('#BuatModal').modal('hide');				  
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});
		}
	}
	function cari_user(){
		var tipeCari=$("select[name=tipeCari]").val();
		var filter=$("input[name=filter]").val();
		$("#TableView").bootstrapTable('removeAll');		
		var urlnya='/00_admin/user_view_json.php?tipeCari='+tipeCari+'&filter='+filter;
		 $("#TableView").bootstrapTable('refresh', {
			url:urlnya
		});
}
</script>