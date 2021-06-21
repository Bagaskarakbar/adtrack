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
<div class="card-header">List Project Di Proses PISS
</div>
<div class="main-card mb-3 card">
	<div class="card-body">
		<div class="tab-content">
		<div class="table-responsive">
				<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_am_proses.php" data-pagination="true" data-trim-on-search="false"  data-search="true" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
				<thead>
				<tr>
					<th data-field="no" >No.</th>
					<th data-field="nama_pelanggan" style="text-align:center;">Nama Pelanggan</th>
					<th data-field="jenis_pelanggan">Jenis Pelanggan</th>
					<th data-field="nama_layanan">Nama Layanan</th>
					<th data-field="paket_layanan">Paket Layanan</th>
					<th data-field="tgl_input">Tanggal Input</th>
					<th data-field="details" align="center">Aksi</th>
				</tr>
				</thead>

				</table>
		</div>
		</div>
	</div>
</div>
</div>
<!--<div class="d-block text-center card-footer">
 <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
			<button class="btn-wide btn btn-success">Save</button>
</div>-->
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
<script type="text/javascript" src="./assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript" src="./assets/scripts/jquery-3.6.0.min.js"></script>
<script>
	function DetailProjek(a){
		$("#idContent").load('../01_am/projek_detail.php',{id:a});
	}
</script>
