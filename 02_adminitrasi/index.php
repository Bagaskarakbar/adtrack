<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
// $db->debug=true;
?>
<style media="screen">
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
	}
	input[type=number] {
			-moz-appearance:textfield;
	}
</style>
<div id="idContent">
	<div class="card-header">List Projek
			<!-- <div class="btn-actions-pane-right" style="padding-right:10px;">
					<button class="btn-wide btn btn-info" onclick="list_docs()"><i class="fa fa-plus"></i>  test</button>
			</div> -->
	</div>
	<div class="main-card mb-3 card">
		<div class="card-body">
			<div class="tab-content">
			<div class="table-responsive">
					<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/02_adminitrasi/get_index_view.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
						<thead>
							<tr>
								<th class="thno" data-field="no">No.</th>
								<th style="text-align:left;" width="150" data-field="nama_pelanggan">Nama Pelanggan</th>
								<th style="text-align:left;" width="150" data-field="jenis_pelanggan">Jenis Pelanggan</th>
								<th style="text-align:left;" width="150" data-field="nama_layanan">Nama Layanan</th>
								<th style="text-align:left;" width="150" data-field="paket_layanan">Paket Layanan</th>
								<th style="text-align:left;" width="150" data-field="tgl_input">Tanggal Input</th>
								<th class="thicons" data-field="details">Aksi</th>
							</tr>
						</thead>
					</table>
			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
<script type="text/javascript" src="./assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript" src="./assets/scripts/jquery-3.6.0.min.js"></script>
<script>
	function list_docs_modal(id){
		$("#idIsiModal").load('../02_adminitrasi/load_list_documents.php',{id:id},function(){
			$("#BuatModal").modal("show");
		});
	}

	// function list_docs(){
	// 	Swal.fire({
	// 		title: 'Daftar Dokumen',
	// 		html: `<table class="mb-0 table table-hover">
	// 				<thead>
	// 					<tr>
	// 							<th>No</th>
	// 							<th>Tipe Dokumen</th>
	// 							<th>Status</th>
	// 							<th>Aksi</th>
	// 					</tr>
	// 				</thead>
	// 				<tbody>
	// 					<tr>
	// 							<th scope="row">1</th>
	// 							<td>NPWP</td>
	// 							<td><button class="mb-2 mr-2 btn btn-info"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
	// 							<td>-</td>
	// 					</tr>
	// 					<tr>
	// 							<th scope="row">2</th>
	// 							<td>Surat Ijin</td>
	// 							<td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
	// 							<td></td>
	// 					</tr>
	// 					<tr>
	// 							<th scope="row">3</th>
	// 							<td>TDP</td>
	// 							<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
	// 							<td>-</td>
	// 					</tr>
	// 					<tr>
	// 							<th scope="row">4</th>
	// 							<td>SK Direktur</td>
	// 							<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
	// 							<td>-</td>
	// 					</tr>
	// 					<tr>
	// 							<th scope="row">5</th>
	// 							<td>SPK/WO</td>
	// 							<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
	// 							<td>-</td>
	// 					</tr>
	// 					<tr>
	// 							<th scope="row">6</th>
	// 							<td>Form Pengajuan</td>
	// 							<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
	// 							<td>-</td>
	// 					</tr>
	// 				</tbody>
	// 		</table>`,
	// 		showConfirmButton: false
	// 	})
	// }
</script>
