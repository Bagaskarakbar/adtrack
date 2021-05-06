<?

session_start();
require_once("../_lib/function/db.php");

?>
<div class="container mb-8">
	<div class="card card-custom p-6">
		<div class="card-body" id="tab_frame">
			<div id="topLayer" class="loading"></div>
			<!-- ========================================================================================= -->
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title" style='font-weight:bold'>Perusahaan</div>
				<div class="mb-7">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-8">

						</div>
						<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
							<a href="#" class="btn btn-primary font-weight-bolder rm-5" onClick="tambah('/00_admin/perusahaan_tambah.php')">Tambah Perusahaan</a>
						</div>

					</div>
				</div>
				<!-- ========================================================================================= -->

				<!-- ========================================================================================= -->
				<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
					<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_perusahaan_json.php" data-pagination="true" data-trim-on-search="true" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
						<thead>
							<tr>
								<th class="thno" data-field="no">No.</th>
								<th class="thicons" data-field="action_hapus">&nbsp;</th>
								<th class="thicons" data-field="action_edit">&nbsp;</th>
								<th width="100" data-field="nama_perusahaan">Perusahaan</th>
								<th width="100" data-field="alamat">Alamat</th>
								<th width="150" data-field="telpon">Telpon</th>
								<th width="150" data-field="kontakperson">Kontak person</th>
								<th width="40" data-field="status">Aktif/Non Aktif</th>

							</tr>
						</thead>
						<tbody>
							<!-- ========================================================================================= -->



							<!-- ========================================================================================= -->
						</tbody>
					</table>
				</div>
				<!-- ========================================================================================= -->

			</div>
		</div>
		<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="idIsiModal"></div>
			</div>
		</div>

	</div>
	<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
	<script>
		function ubah_perusahaan(a){
			$("#idIsiModal").load('/00_admin/perusahaan_edit.php',{id_perusahaan:a,act:'edit'},function(){
				$("#BuatModal").modal("show");
			});
		}
		function tambah(link){
			$("#idIsiModal").load(link,{},function(){
				$("#BuatModal").modal("show");
			});
		}

		function hapus_perusahaan(a){
			var x=confirm('Yakin ingin menghapus user ini?');
			if(x){
				$.ajax({
					type: "POST",
					url: '/00_admin/perusahaan_act.php',
					data: {id_perusahaan:a,act:'delete'},
					success: function(data){
						if(data.code='200'){
							Swal.fire("Success!","Data Berhasil dihapus!","success");
							$("#TableView").bootstrapTable('refresh');
							$('#BuatModal').modal('hide');

						}else{
							Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
						}
					},
					dataType: "json"
				});
			}
		}
		function cari_user(){
			var tipeCari=$("select[name=tipeCari]").val();
			var filter=$("input[name=filter]").val();
			$("#TableView").bootstrapTable('removeAll');		
			var urlnya='/00_admin/user_view_json.php?tipeCari='+tipeCari+'&filter='+filter;
			$("#TableView").bootstrapTable('refresh', {
				url:urlnya
			});
		}
		function ambilPropinsi(){
			var id_dc_propinsi=$('#id_dc_propinsi').val();
			$('#id_dc_kota').load('../01_registrasi/ajax_cari_kota.php',{id_dc_propinsi:id_dc_propinsi});
			$('#id_dc_kecamatan').load('../00_admin/ajax_cari_kecamatan_reset.php');
			$('#id_dc_kelurahan').load('../00_admin/ajax_cari_kelurahan_reset.php');
		}
		function ambilKota(){
			var id_dc_propinsi=$('#id_dc_propinsi').val();
			var kota=$('#kota').val();
			$('#id_dc_kecamatan').load('../01_registrasi/ajax_cari_kecamatan.php',{id_dc_kota:kota,id_dc_propinsi:id_dc_propinsi});
			$('#id_dc_kelurahan').load('../00_admin/ajax_cari_kelurahan_reset.php');
		}
		function ambilKecamatan(){
			var id_dc_propinsi=$('#id_dc_propinsi').val();
			var kota=$('#kota').val();
			var kecamatan=$('#kecamatan').val();
			$('#id_dc_kelurahan').load('../00_admin/ajax_cari_kelurahan.php',{id_dc_kecamatan:kecamatan,id_dc_kota:kota,id_dc_propinsi:id_dc_propinsi});
		}
	</script>