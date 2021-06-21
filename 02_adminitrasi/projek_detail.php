<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");

$sql="select * from tc_pengajuan where id_tc_pengajuan=$id";
$hasil =& $db->Execute($sql);
$nama_pelanggan = $hasil->Fields('nama_pelanggan');
?>
<div class="tab-content">
	<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
		<div class="row">
		  <div class="col-md-12">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Data Pelanggan
						<div class="btn-actions-pane-right">
						  <button class="mb-2 mr-2 btn btn-danger" onclick="Back()">Back</button>
						</div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							 <div class="row">
								<div class="col-md-12">No Pelanggan : <b><?=$nama_pelanggan?></b></div>
							</div>
							 <div class="row">
								<div class="col-md-12">Nama Pelanggan : <b><?=$nama_pelanggan?></b></div>
							</div>
							 <div class="row">
								<div class="col-md-12">Jenis Mitra : <b><?=$nama_pelanggan?></b></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-6">
			  <div class="card mb-3 widget-content">
				  <div class="widget-content-wrapper">
					  <div class="widget-content-left">
						  <div class="widget-heading">Dokumen Kontrak</div>
						  <div class="widget-subheading">Total jumlah dokumen kontrak</div>
					  </div>
					  <div class="widget-content-right">
						  <div class="widget-numbers text-success"><span>8</span>
							<button class="mb-2 mr-2 btn btn-success" onclick="dokumen_view('<?=$id?>')">Detail Dokumen</button>
						  </div>
					  </div>
				  </div>
			  </div>
			  <div class="main-card mb-3 card">
				  <div class="card-body"><h5 class="card-title">Progress animated</h5>
					  <div class="mb-3 progress">
						  <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
					  </div>
					  <button class="mb-2 mr-2 btn btn-primary" onclick="detail_pengguna()">Detail Progress</button>
				  </div>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="card mb-3 widget-content">
				  <div class="widget-content-wrapper">
					  <div class="widget-content-left">
						  <div class="widget-heading">Dokumen Kontrak</div>
						  <div class="widget-subheading">Total jumlah dokumen kontrak</div>
					  </div>
					  <div class="widget-content-right">
						  <div class="widget-numbers text-success"><span>8</span>
							<button class="mb-2 mr-2 btn btn-success" onclick="detail_pengguna()">Detail Dokumen</button>
						  </div>
					  </div>
				  </div>
			  </div>
			</div>
		</div>
	</div>
</div>
<script>
function Back(){
	$("#idContent").load('../02_adminitrasi/index.php');
}

function dokumen_view(a){
		$("#idIsiModal").load('/02_adminitrasi/dokumen_view.php',{id_dd_user:a,act:'edit'},function(){
			$("#BuatModal").modal("show");
		});
	}
</script>
