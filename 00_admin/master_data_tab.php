<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
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
								<a data-toggle="tab" href="#" onclick="Departement()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Data Departement/Unit</a>
								<a data-toggle="tab" href="#" onclick="Mitra()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Data Mitra</a>
								<a data-toggle="tab" href="#" onclick="Layanan()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Data Layanan</a>
								<a data-toggle="tab" href="#" onclick="PaketLayanan()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Paket Layanan</a>
								<a data-toggle="tab" href="#" onclick="JnsPelangan()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Jenis Pelanggan</a>
								<a data-toggle="tab" href="#" onclick="Bundling()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Bundling</a>
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
							$('#id_tab_content').load("../00_admin/departement.php");
						}
						function Mitra(){
							$('#id_tab_content').load("../00_admin/mitra.php");
						}
						function Layanan(){
							$('#id_tab_content').load("../00_admin/layanan.php");
						}
						function PaketLayanan(){
							$('#id_tab_content').load("../00_admin/paket_layanan.php");
						}
						function JnsPelangan(){
							$('#id_tab_content').load("../00_admin/jenis_pelanggan.php");
						}
						function Bundling(){
							$('#id_tab_content').load("../00_admin/bundling.php");
						}
						function Chanel(){
							$('#id_tab_content').load("../00_admin/chanel.php");
						}
						function Project(){
							$('#id_tab_content').load("../00_admin/project.php");
						}
					</script>
					<div class="card-body" id="id_tab_content">
						
					</div>
		</div>
	</div>
</div>
</div>

