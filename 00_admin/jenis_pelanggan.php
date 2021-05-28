<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Jenis Pelanggan </div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahPelanggan()">Tambah Jenis Pelanggan</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableViewPelanggan" class="table" data-toggle="table" data-url="/00_admin/jenis_pelanggan_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="150" data-field="jenis_pelanggan">Jenis Pelanggan</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
</div>

<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahPelanggan(a){
	$("#idIsiModal").load('/00_admin/jenis_pelanggan_addedit.php',{id_mt_jenis_pelanggan:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahPelanggan(a){
	$("#idIsiModal").load('/00_admin/jenis_pelanggan_addedit.php',{id_mt_jenis_pelanggan:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusPelanggan(id_mt_jenis_pelanggan){
var x = confirm('Hapus Jenis Pelanggan ?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/jenis_pelanggan_act.php',	  
		  data:{id_mt_jenis_pelanggan,act},
		  success: function (data){
			  if(data.code=='200'){
				$("#TableViewPelanggan").bootstrapTable('refresh');
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