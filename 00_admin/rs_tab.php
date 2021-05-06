<div class="container mb-8" id="idBagian">
	<div class="card card-custom p-6">
		<div class="card-body" id="tab_frame">
		<div id="topLayer" class="loading"></div>
		<!-- ========================================================================================= -->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label font-weight-bolder text-dark">Bagian E-Clinic</span>
		</h3>
		<button type="button" class="btn btn-primary btn-sm" onclick="addBagian()"><i class="las la-plus"></i>Tambah</button>
		<br/>
		<!-- ========================================================================================= -->
				<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_bagian_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
					<thead>
						<tr>
							<th class="thno" data-field="no">No.</th>
							<th class="thicons" data-field="action_hapus">&nbsp;</th>
							<th class="thicons" data-field="action_edit">&nbsp;</th>
							<th data-field="kode_bagian">Kode Bagian</th>
							<th data-field="nama_bagian">Nama Bagian</th>
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
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<div id="ModalIsiBagian" class="modal fade bd-modal-packing-md" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content" id="idIsiModalBagian"></div>
	</div>
</div>
<script>
function Test(){
	alert("test");
}

function addBagian(a){
	$("#idIsiModalBagian").load("../00_admin/bagian_form.php",{id_mt_bagian:a},function(){
	$("#ModalIsiBagian").modal("show");
	});
}

function hapusBagian(a){
		Swal.fire({
        title: "Hapus Bagian ?",
        text: "apakah data yang di pilih sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		customClass: {
		   confirmButton: "btn btn-danger",
		   cancelButton: "btn btn-warning"
		  }
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: '/00_admin/bagian_form_act.php',
					data: {id_mt_bagian:a,validasi:3},
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiBagian").modal('hide');
							$('.modal-backdrop').remove();
							$('#idBagian').load("../00_admin/rs_tab.php");
							Swal.fire("Sukses ","Berhasil Menghapus data","success");
						}else{
							alert('Gagal');
						}
					},
					dataType: "json"
				});
			}
		});
		

	}
</script>