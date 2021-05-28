<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
?>
<div class="card-header">Departement </div>
<br>
<button class="mb-2 mr-2 btn btn-success" onClick="tambahBagian()">Tambah Bagian</button>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableViewBagian" class="table" data-toggle="table" data-url="/00_admin/data_bagian_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
					<thead>
						<tr>
							<th class="thno" data-field="no">No.</th>
							<th class="thicons" data-field="action_hapus">&nbsp;</th>
							<th class="thicons" data-field="action_edit">&nbsp;</th>
							<th data-field="kode_bagian">Kode Bagian</th>
							<th data-field="nama_bagian">Nama Bagian</th>
						</tr>
					</thead>
			</table>
		</div>
			
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>

function tambahBagian(a){
	$("#idIsiModal").load('/00_admin/bagian_form.php',{id_mt_bagian:a},function(){
		$("#BuatModal").modal("show");
	});
}

function ubahBagian(a){
	$("#idIsiModal").load('/00_admin/bagian_form.php',{id_mt_bagian:a},function(){
		$("#BuatModal").modal("show");
	});
}

function hapusBagian(id_mt_bagian){
var x = confirm('Hapus Bagian?');
	if(x){
	var validasi='3';
		
		$.ajax({				
		  type: "POST",
		  url: '/00_admin/bagian_form_act.php',	  
		  data:{id_mt_bagian,validasi},
		  success: function (data){
			  if(data.code=='200'){
				$("#TableViewBagian").bootstrapTable('refresh');
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