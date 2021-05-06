<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_number");
// $db->debug= true;


?>
<div class="tab-pane fade show active" id="kt_tab_pane_1_1" role="tabpanel" aria-labelledby="kt_tab_pane_1_1">
<div class="card-header border-0 py-3">
	<h3 class="card-title align-items-start flex-column">
		<span class="card-label font-weight-bolder text-dark">Propinsi</span>
	</h3>
	<button type="button" class="btn btn-primary btn-sm" onclick="addPropinsi()"><i class="las la-plus"></i>Tambah</button>
	<br/>
	<div class="table-responsive" id="idBank">
		<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
		<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_propinsi_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
			<thead>
				<tr>
					<th class="thno" data-field="no">No.</th>
					<th class="thicons" data-field="action_hapus">&nbsp;</th>
					<th class="thicons" data-field="action_edit">&nbsp;</th>
					<th data-field="nama_propinsi">Propinsi</th>
					<th data-field="inisial_propinsi">Inisial Propinsi</th>
				</tr>
			</thead>
			<tbody>
	<!-- ========================================================================================= -->
<!-- ========================================================================================= -->
			</tbody>
		</table>
	</div>

</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>	
<div id="ModalIsiPropinsi" class="modal fade bd-modal-packing-md" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content" id="idIsiModalPropinsi"></div>
	</div>
</div>
</div>	
<script>
function Test(){
	alert("test");
}

function addPropinsi(a){
	$("#idIsiModalPropinsi").load("../00_admin/propinsi_form.php",{id_dc_propinsi:a},function(){
	$("#ModalIsiPropinsi").modal("show");
	});
}

function hapusPropinsi(a){
		Swal.fire({
        title: "Hapus Propinsi ?",
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
					url: '/00_admin/propinsi_form_act.php',
					data: {id_dc_propinsi:a,validasi:3},
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiPropinsi").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/propinsi.php");
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
