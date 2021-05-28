<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Paket Layanan </div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahPaketLayanan()">Tambah Paket Layanan</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
			<table id="TableViewPaketLayanan" class="table" data-toggle="table" data-url="/00_admin/paket_layanan_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th data-field="nama_layanan">Nama Layanan</th>
						<th data-field="nama_paket">Nama Paket Layanan</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahPaketLayanan(a){
	$("#idIsiModal").load('/00_admin/paket_layanan_addedit.php',{id_mt_paket:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahPaketLayanan(a){
	$("#idIsiModal").load('/00_admin/paket_layanan_addedit.php',{id_mt_paket:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusPaketLayanan(id_mt_paket){
var x = confirm('Hapus Paket Layanan ?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/paket_layanan_act.php',	  
		  data:{id_mt_paket,act},
		  success: function (data){
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

}
</script>