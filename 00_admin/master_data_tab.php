<?

?>
<div class="tab-content">
	<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
		<div class="row">
			<div class="col-md-12">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>
						<div class="btn-actions-pane-right">
							<div class="nav">
								<a data-toggle="tab" href="#" onclick="Pegawai()" class="btn-pill btn-wide active btn btn-outline-danger btn-sm">Data Pegawai</a>
								<a data-toggle="tab" href="#"  class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Data Departement/Unit</a>
								<a data-toggle="tab" href="#" onclick="Mitra()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Data Mitra</a>
								<a data-toggle="tab" href="#" onclick="Layanan()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Data Layanan</a>
								<a data-toggle="tab" href="#" onclick="PaketLayanan()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Paket Layanan</a>
								<a data-toggle="tab" href="#" onclick="JnsPelangan()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Jenis Pelanggan</a>
								<a data-toggle="tab" href="#" onclick="Bunldling()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Bundling</a>
								<a data-toggle="tab" href="#" onclick="Chanel()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Chanel</a>
								<a data-toggle="tab" href="#" onclick="Project()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Jenis Project</a>
							</div>
						</div>
					</div>
					<script>
						Pegawai();
						function Pegawai(){
							$('#id_tab_content').load("../00_admin/karyawan_tab.php");
						}
						function Departement(){
							$('#id_tab_content').load("../00_admin/pegawai.php");
						}
					</script>
					<div class="card-body" id="id_tab_content">
						
					</div>
		</div>
	</div>
</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>