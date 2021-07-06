<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");

$id_dd_user=$_SESSION['logininfo']['id_dd_user'];
$username=$_SESSION['logininfo']['username'];

$sql="SELECT a.*, b.jenis_project, c.nama_bundling, d.nama_layanan, e.nama_paket, f.jenis_pelanggan FROM tc_pengajuan AS a JOIN mt_jenis_project AS b ON a.id_mt_jenis_project = b.id_mt_jenis_project JOIN mt_bundling AS c ON a.id_mt_bundling = c.id_mt_bundling JOIN mt_layanan AS d ON a.id_mt_layanan = d.id_mt_layanan JOIN mt_paket AS e ON a.id_mt_paket = e.id_mt_paket JOIN mt_jenis_pelanggan AS f ON a.id_mt_jenis_pelanggan = f.id_mt_jenis_pelanggan where a.id_tc_pengajuan=$id";
$hasil =& $db->Execute($sql);
$id_tc_pengajuan = $hasil->Fields('id_tc_pengajuan');
$id_tc_transaksi = $hasil->Fields('id_tc_transaksi');
$nama_pelanggan = $hasil->Fields('nama_pelanggan');
$jenis_pelanggan = $hasil->Fields('jenis_pelanggan');
$nama_layanan = $hasil->Fields('nama_layanan');
$nama_paket = $hasil->Fields('nama_paket');
$tgl_input = $hasil->Fields('tgl_input');
$tgl_spk = $hasil->Fields('tgl_spk');

$nomer = $hasil->Fields('nomor');
$perihal = $hasil->Fields('perihal');
$lama_kontrak = $hasil->Fields('lama_kontrak');

$otc = $hasil->Fields('otc');
$term1 = $hasil->Fields('term1');
$term2 = $hasil->Fields('term2');
$term3 = $hasil->Fields('term3');
$term4 = $hasil->Fields('term4');
$term5 = $hasil->Fields('term5');
$term6 = $hasil->Fields('term6');

?>
<div class="tab-content">
	<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">

		<div class="row">
		  <div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Data Pelanggan
						<div class="btn-actions-pane-right">
						  <button class="mb-2 mr-2 btn btn-danger" onclick="BackDelivery()">Back</button>
						</div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="row">
								<div class="col-md-6">
								<!--begin::Table-->
									<div class="table-responsive" id="idAntrian">
										<table class="table" >
											<tr>
												<td class="text-left text-uppercase">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Tanggal
													</span>
												</td>
												<td>:</td>
												<td><?=date("d-m-Y", strtotime($tgl_input))?></td>
											</tr>
											<tr>
												<td class="text-left text-uppercase">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Nama Pelanggan
													</span>
												</td>
												<td>:</td>
												<td><?=$nama_pelanggan?></td>
											</tr>
											<tr>
												<td class="text-left text-uppercase">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Jenis Pelanggan
													</span>
												</td>
												<td>:</td>
												<td><?=$jenis_pelanggan?></td>
											</tr>
											<tr>
												<td class="text-left text-uppercase">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Nama Layanan
													</span>
												</td>
												<td>:</td>
												<td><?=$nama_layanan?></td>
											</tr>
											<tr>
												<td class="text-left text-uppercase">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Paket Layanan
													</span>
												</td>
												<td>:</td>
												<td><?=$nama_paket?></td>
											</tr>
										</table>
									</div>
									<!--end::Table-->
								</div>
								<div class="col-md-6">
								<!--begin::Table-->
								<div class="table-responsive" id="idAntrian">
									<table class="table" >
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													Tanggal SPK
												</span>
											</td>
											<td>:</td>
											<td><?=date("d-m-Y", strtotime($tgl_spk))?></td>
										</tr>
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													Nomer
												</span>
											</td>
											<td>:</td>
											<td><?=$nomer?></td>
										</tr>
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													Perihal
												</span>
											</td>
											<td>:</td>
											<td><?=$perihal?></td>
										</tr>
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													lama_kontrak
												</span>
											</td>
											<td>:</td>
											<td><?=$lama_kontrak?></td>
										</tr>

										<tr>
											<td class="text-left text-uppercase">
												&nbsp;
											</td>
											<td>	&nbsp;</td>
											<td class="text-center"> </td>
										</tr>

									</table>
								</div>
								<!--end::Table-->
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Monitoring Delivery</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="row">
								<div class="col-md-12">
									<!--begin::Table-->
									<div class="table-responsive" id="idDokDat">
									<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_monitoring_delivery.php?id=<?=$id_tc_transaksi?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
									<thead>
									<tr>
										<th data-align="center" data-field="no">No.</th>
										<th data-align="left" data-field="nama">Nama Monitoring</th>
										<th data-align="center" data-field="tgl_mulai">Tanggal Mulai</th>
										<th data-align="center" data-field="tgl_selesai">Tanggal Selesai</th>
										<th data-align="center" data-field="progres">Progres %</th>
										<th data-align="center" data-field="status">Status</th>
										<th data-align="center" data-field="action">Action</th>
									</tr>
									</thead>
									</table>
									</div>
									<!--end::Table-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Progres Dokument</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="row">
								<div class="col-md-12">
									<!--begin::Table-->
									<div class="table-responsive" id="idDokDat">
									<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_dokumen_data_delivery.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
									<thead>
									<tr>
										<th data-align="center" data-field="no">No.</th>
										<th data-align="left" data-field="nama_bagian">Bagian</th>
										<th data-align="left" data-field="tipe_dokumen">Jenis Dokumen</th>
										<th data-align="center" data-field="tgl">Tanggal</th>
										<th data-align="center" data-field="download">Download</th>
									</tr>
									</thead>
									</table>
									</div>
									<!--end::Table-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</div>

<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>

function BackDetail(){
	$("#idContent").load('../06_monitoring_delivery/projek_detail.php',{id:<?=$id?>});
}

function BackDelivery(){
	$("#idContent").load('../06_monitoring_delivery/index.php');
}

function DokDownload(a,b){
	$("#idIsiModalLarge").load("/06_monitoring_delivery/download_dokumen.php",{id:a},function(){
		$("#BuatModalLarge").modal('show');
	});
}

function AddMon(a,b){
	$("#idIsiModalLarge").load("/06_monitoring_delivery/add_monitoring.php",{id:a,idt:b},function(){
		$("#BuatModalLarge").modal('show');
	});
}



function Close(a){
		$('#BuatModal').modal('hide');
		$("#idContent").load('../06_monitoring_delivery/projek_detail.php',{id:a});
	}
function load(a){
		$("#idContent").load('../06_monitoring_delivery/projek_detail.php',{id:a});
	}

function detailV(){
		Swal.fire({
			icon: 'error',
			title: 'Dokumen...',
			text: 'Something went wrong!',
			footer: '<a href>Why do I have this issue?</a>'
	})
}
</script>
