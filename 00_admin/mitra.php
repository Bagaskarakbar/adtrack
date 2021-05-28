<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Data Mitra </div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahMitra()">Tambah Mitra</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableViewMitra" class="table" data-toggle="table" data-url="/00_admin/mitra_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="150" data-field="jenis_pelanggan">Jenis Pelanggan</th>
						<th width="100" data-field="no_pelanggan">No Pelanggan</th>
						<th width="100" data-field="nama_pelanggan">Nama Pelanggan</th>					
					</tr>
				</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahMitra(a){
	$("#idIsiModal").load('/00_admin/mitra_addedit.php',{id_mt_mitra:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahMitra(a){
	$("#idIsiModal").load('/00_admin/mitra_addedit.php',{id_mt_mitra:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusMitra(id_mt_mitra){
var x = confirm('Hapus Mitra ?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/mitra_act.php',	  
		  data:{id_mt_mitra,act},
		  success: function (data){
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

}

</script>