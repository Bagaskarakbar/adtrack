<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_number");
// $db->debug= true;
$nama_pegawai=baca_tabel("mt_karyawan","nama_pegawai"," where kode_dokter=$kode_dokter");
$kode_bagian_dokter = baca_tabel("mt_karyawan","kode_bagian","where kode_dokter = $kode_dokter");

?>
<div class="tab-pane fade show active" id="idRiwayatPendidikan" role="tabpanel" aria-labelledby="kt_tab_pane_1_1">
<div class="card-header border-0 py-3">
	<h3 class="card-title align-items-start flex-column">
		<span class="card-label font-weight-bolder text-dark">Riwayat Pendidikan</span>
	</h3>
	<button type="button" class="btn btn-success btn-sm" onClick="AddPendidikan()" ><i class="las la-plus"></i>Tambah</button>
	<br/>
	<div class="table-responsive" id="idPraktek">
		<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
		<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_riwayat_pendidikan.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="true" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
			<thead>
				<tr>
					<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
					<th data-field="action" class="text-center"><span class="text-dark-75 text-center"></span></th>
					<th data-field="nama_instansi_pendidikan"><span class="text-dark-75 text-center">Nama Instansi Pendidikan</span></th>
					<th data-field="tahun_mulai" class="text-center"><span class="text-dark-75 text-center">Tahun Mulai</span></th>
					<th data-field="tahun_lulus" class="text-center"><span class="text-dark-75 text-center">Tahun Lulus </span></th>
					<th data-field="jurusan" ><span class="text-dark-75 text-center">Jurusan</span></th>
					<th data-field="gelar" ><span class="text-dark-75 text-center">Gelar</span></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
		
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>	
<div id="ModalIsiPendidikan" class="modal fade bd-modal-packing-md" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content" id="idIsiModalPendidikan"></div>
	</div>
</div>
<script>
function AddPendidikan(a){
	$("#idIsiModalPendidikan").load("../00_admin/riwayat_pendidikan_form.php",{kode_dokter:<?=$kode_dokter?>,id:a},function(){
	$("#ModalIsiPendidikan").modal("show");
	});
}

function hapusPendidikan(a){
		Swal.fire({
        title: "Hapus Pendidikan Dokter ?",
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
					url: '/00_admin/riwayat_pendidikan_form_act.php',
					data: {id_mt_pendidikan:a,validasi:3},
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiPendidikan").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pane').load("../00_admin/riwayat_pendidikan.php",{kode_dokter:<?=$kode_dokter?>});
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

