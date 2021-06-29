<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");

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
											<td class="text-center"> <button class="mb-2 mr-2 btn btn-success" style='cursor: pointer' onclick="AddLogistik(<?=$id_tc_transaksi?>,<?=$id_tc_pengajuan?>)"><i class='fa fa-angle-double-right' ></i> Proses Logistik</button></td>
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
			<div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Progres Dokument

					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="row">
								<div class="col-md-12">
								<!--begin::Table-->
									<div class="table-responsive" id="idAntrian">
									<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_dokumen_data.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
									<thead>
									<tr>
										<th data-field="no" >No.</th>
										<th data-field="tipe_dokumen" style="text-align:center;">Jenis Dokumen</th>
										<th data-field="tgl" style="text-align:center;">Tanggal</th>
										<th data-field="download">Download</th>
										<th data-field="">#</th>
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
			<div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Nilai Kontrak
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="row">
								<div class="col-md-12">
								<!--begin::Table-->
									<div class="table-responsive" id="idAntrian">
									<label>Nilai OTC : <b> Rp. <?=$otc?></b> </label>
										<table class="table" >
											<tr>
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Term 1
													</span>
												</td>
												<td class="text-center">:</td>
												<td class="text-left">Rp. <?=$term1?></td>
											</tr>
											<tr>
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Term 2
													</span>
												</td>
												<td class="text-center">:</td>
												<td class="text-left">Rp. <?=$term2?></td>
											</tr>
											<tr>
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Term 3
													</span>
												</td>
												<td class="text-center">:</td>
												<td class="text-left">Rp. <?=$term3?></td>
											</tr>
											<tr>
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Term 4
													</span>
												</td>
												<td class="text-center">:</td>
												<td class="text-left">Rp. <?=$term4?></td>
											</tr>
											<tr>
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Term 5
													</span>
												</td>
												<td class="text-center">:</td>
												<td class="text-left">Rp. <?=$term5?></td>
											</tr>
											<tr>
												<td class="text-left">
													<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
														Term 6
													</span>
												</td>
												<td class="text-center">:</td>
												<td class="text-left">Rp. <?=$term6?></td>
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



	</div>
</div>

<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function Back(){
	$("#idContent").load('../03_logistik/index.php');
}

function DokView(a){
	$("#idIsiModalLarge").load("/03_logistik/dokumen_view.php",{id:a},function(){
		$("#BuatModalLarge").modal('show');
	});
}

function DokDownload(a){
	$("#idIsiModalLarge").load("/03_logistik/download_dokumen.php",{id:a},function(){
		$("#BuatModalLarge").modal('show');
	});
}

function AddLogistik(a,b){
	$("#idIsiModal").load("/03_logistik/add_logistik_projek.php",{idt:a,id:b},function(){
		$("#BuatModal").modal('show');
	});
}

function Close(a){
		$('#BuatModal').modal('hide');
		$("#idContent").load('../03_logistik/projek_detail.php',{id:a});
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
