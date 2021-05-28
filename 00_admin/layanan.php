<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Data Layanan </div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahLayanan()">Tambah Layanan</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableViewLayanan" class="table" data-toggle="table" data-url="/00_admin/layanan_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="nama_layanan">Nama Layanan</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahLayanan(a){
	$("#idIsiModal").load('/00_admin/layanan_addedit.php',{id_mt_layanan:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahLayanan(a){
	$("#idIsiModal").load('/00_admin/layanan_addedit.php',{id_mt_layanan:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusLayanan(id_mt_layanan){
var x = confirm('Hapus Layanan ?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/layanan_act.php',	  
		  data:{id_mt_layanan,act},
		  success: function (data){
			  if(data.code=='200'){
					$("#TableViewLayanan").bootstrapTable('refresh');
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