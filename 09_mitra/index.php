<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
// loadlib("function","function.uang");

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
			&:placeholder-shown + #btnReset{
		    opacity: 0;
		    pointer-events: none;
		  }
	}
	#btnReset{
    --size: 22px;
    position: absolute;
    border: none;
    display: block;
    width: var(--size);
    height: var(--size);
    line-height: var(--size);
    font-size: calc(var(--size) - 3px);
    border-radius: 50%;
    top: 0;
    bottom: 0;
    right: calc(var(--size)/2);
    margin: auto;
    background-color: salmon;
    color: white;
    padding: 0;
    outline: none;
    cursor: pointer;
    opacity: 0;
    transition: .1s;
  }
	span.idr {
    /* float:left;
    text-align:left; */
    position: relative;
	}

	span.idr::before {
	    position: absolute;
	    content: "Rp."; /* £ */
	    /* padding:3px 4px 3px 3px; */
			padding-left: 10px;
	    left: 0;
	    top:0;
	    bottom:0;
	}

	span.idr input {
    padding-left: 35px;
}
</style>
<div id="idContent">
<div class="card-header">List Mitra
		<div class="btn-actions-pane-right" style="padding-right:10px;">
				<!-- <button class="btn-wide btn btn-info" onclick="list_mitra()"><i class="fa fa-plus"></i> Tambah Mitra</button> -->
		</div>
</div>
<div class="main-card mb-3 card">
	<div class="card-body">
		<div class="tab-content">
		<div class="table-responsive">
				<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/09_mitra/get_index_view.php" data-pagination="true" data-trim-on-search="false"  data-search="true" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
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
<script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
<!-- <script type="text/javascript" src="./assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript" src="./assets/scripts/jquery-3.6.0.min.js"></script> -->
<script>
function list_mitra_modal(id){
	$("#idIsiModal").load('../09_mitra/load_list_documents_mitra.php',{id:id},function(){
		$("#BuatModal").modal("show");
	});
}

function list_mitra(){
	$("#idIsiModal").load('../09_mitra/load_list_documents_mitra.php',function(){
		$("#BuatModal").modal("show");
	});
}
</script>
