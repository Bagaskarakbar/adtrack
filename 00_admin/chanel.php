<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Chanel</div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahChanel()">Tambah Chanel</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
			<table id="TableViewChanel" class="table" data-toggle="table" data-url="/00_admin/chanel_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="nama_channel">Nama Chanel</th>
						
					</tr>
				</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahChanel(a){
	$("#idIsiModal").load('/00_admin/chanel_addedit.php',{id_mt_channel:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahChanel(a){
	$("#idIsiModal").load('/00_admin/chanel_addedit.php',{id_mt_channel:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusChanel(id_mt_channel){
var x = confirm('Hapus Channel?');
	if(x){
	var act='delete';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/chanel_act.php',	  
		  data:{id_mt_channel,act},
		  success: function (data){
			  if(data.code=='200'){
				$("#TableViewChanel").bootstrapTable('refresh');
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