<div class="container mb-8">
	<div class="card card-custom p-6">
		<div class="card-body" id="tab_frame">
			<div id="topLayer" class="loading"></div>
			<!-- ========================================================================================= -->
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title" style='font-weight:bold'>Master Tarif</div>
				<div class="mb-7">
					<div class="row align-items-center">
						<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
							<a href="#" class="btn btn-primary font-weight-bolder rm-5" onClick="tambah('/00_admin/tarif_tambah.php')">Tambah Tarif</a>
						</div>

					</div>
				</div>
				<!-- ========================================================================================= -->
				<table id="TableView" class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/00_admin/data_tarif_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
					<thead>
						<tr>
							<th class="thno" data-field="no">No.</th>
							<th class="thicons" data-field="action_hapus">&nbsp;</th>
							<th class="thicons" data-field="action_edit">&nbsp;</th>
							<th data-field="nama_bagian">Bagian</th>
							<th data-field="nama_tarif">Tarif</th>
							<th data-field="pendapatan_rs">Klinik</th>
							<th data-field="bill_dr1">Dokter</th>
						</tr>
					</thead>
					<tbody>
						<!-- ========================================================================================= -->
						<!-- ========================================================================================= -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="BuatModal" class="modal fade bd-modal-packing-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript">
	function tambah(link){
		$("#idIsiModal").load(link,{},function(){
			$("#BuatModal").modal("show");
		});
	}

	function edit_tarif(a){
		$("#idIsiModal").load('/00_admin/tarif_edit_tarif.php',{kode_tarif:a,act:'edit'},function(){
			$("#BuatModal").modal("show");
		});
	}

	function hapus_tarif(a){
		var x=confirm('Yakin ingin menghapus user ini?');
		if(x){
			$.ajax({
				type: "POST",
				url: '/00_admin/tarif_act.php',
				data: {kode_tarif:a,act:'delete'},
				success: function(data){
					if(data.code='200'){
						Swal.fire("Success !", "Data Berhasil dihapus!", "success");
						$("#TableView").bootstrapTable('refresh');
						$('#BuatModal').modal('hide');					  
					}else{
						Swal.fire("Gagal !", "Terjadi Kesalahan!", "warning");
					}
				},
				dataType: "json"
			});
		}
	}
</script>