<div class="content d-flex flex-column flex-column-fluid" id="iddetailDokter">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">Pegawai
						<!--<span class="d-block text-muted pt-2 font-size-sm">light head and row separator</span>--></h3>
					</div>
					<div class="card-toolbar">
						<!--begin::Button-->
						<a href="#" class="btn btn-primary font-weight-bolder" onclick="dokter_add()">
						<i class="la la-plus"></i>Tambah Pegawai</a> &nbsp;
						<!--<a href="#" class="btn btn-primary font-weight-bolder" onclick="openPop3('dokter_view_cetak.php')">
						<i class="la la-print"></i>Cetak</a>-->
						<!--end::Button-->
					</div>
				</div>
				<div class="card-body">
				<!--begin::Search Form-->
					<form method="get" action="#">
					<div class="mb-7">
						<div class="row align-items-center">
							<div class="col-lg-9 col-xl-8">
								<div class="row align-items-center">
									<div class="col-md-4 my-2 my-md-0">
										
									</div>
									<div class="col-md-4 my-2 my-md-0">
										<div class="d-flex align-items-center">
											<label class="mr-4 mb-0 d-none d-md-block">Cari:</label>
											<select name="tipeCari" class="form-control" id="kt_datatable_search_status" tabindex="null">
											<option value="nama" <?= ($tipeCari == "nama") ? ("selected") : ("") ?>>Nama</option>
										</select>
										</div>
									</div>
									<div class="col-md-4 my-2 my-md-0">
										<div class="d-flex align-items-center">
											<input type="text" size="20" value="<?= $filter ?>" name="filter" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
								<input type="button" name="cari" value="Cari" onclick="cari_user()" class="btn btn-light-primary px-6 font-weight-bold">
							</div>
						</div>
					</div>
					</form>
					
					<!--end::Search Form-->
					<!--begin: Datatable-->
					<table id="IdTableDok" class="table" data-toggle="table" data-url="/00_admin/data_dasar_jr_json.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="nama_pegawai">Pegawai</th>
						<th data-field="foto">Foto</th>
					</tr>
				</thead>
				
			</table>
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<!-- ======================================== Modal ================================================= -->
	<div id="ModalEdit" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="idIsiModalEdit"></div>
		</div>
	</div>

	<div id="ModalAdd" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="idIsiModalAdd"></div>
		</div>
	</div>
	<!-- ======================================== Modal ================================================= -->
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
// function ubah(a){
		// $("#idIsiModalEdit").load('/00_admin/dokter_addedit.php',{kode_dokter:a},function(){
			// $("#ModalEdit").modal("show");
		// });
	// }
	
	function ubah(a){
		$("#idIsiModalEdit").load('/00_admin/dokter_edit.php',{kode_dokter:a},function(){
			$("#ModalEdit").modal("show");
		});
	}
		
	function dokter_add(a){
		$("#idIsiModalAdd").load('/00_admin/dokter_add.php',{kode_dokter:a},function(){
			$("#ModalAdd").modal("show");
		});
	}



		function HapusDokter(a)
					{
					
						var x=confirm("Yakin Anda Mau Menghapus?");
						if(x)
						{
							var datastring = $("#EditVS").serialize();
							$.ajax({
								type: "POST",
								url: "../00_admin/del_dokter.php",
								data:{"kode_dokter":a},
								success: function(data) {
									if(data.code=='200')
									{
										alert("Hapus Dokter Berhasil !");
										$("#iddetailDokter").load("../00_admin/data_dasar_dr.php");
									}else{
										alert("Gagal Menghapus, Coba Lagi!");
									}
								},
								dataType:"json"
							});
						}

					}
			

	
	function detailDokter(a){
		$("#iddetailDokter").load("../00_admin/detail_dokter.php?kode_dokter="+a);
	}
	function cari_user(){
		var tipeCari=$("select[name=tipeCari]").val();
		var filter=$("input[name=filter]").val();
		$("#IdTableDok").bootstrapTable('removeAll');		
		var urlnya='/00_admin/data_dasar_jr_json.php?tipeCari='+tipeCari+'&filter='+filter;
		 $("#IdTableDok").bootstrapTable('refresh', {
			url:urlnya
		});
}
</script>