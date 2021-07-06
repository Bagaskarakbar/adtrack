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
		  <div class="col-md-12">
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
			<div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Delivery
					<!--<div class="btn-actions-pane-right">
						  <button class="mb-2 mr-2 btn btn-success" style='cursor: pointer' onclick="AddDelivery(<?=$id_tc_transaksi?>,<?=$id_tc_pengajuan?>)"><i class='fa fa-angle-double-right' ></i> Proses Delivery</button>
						</div>-->
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="row">
								<div class="col-md-12">
								<?
								$sqlDelivery="SELECT * from tc_delivery where id_tc_transaksi=$id_tc_transaksi";
								$hasilDelivery =& $db->Execute($sqlDelivery);
								$id_tc_delivery = $hasilDelivery->Fields('id_tc_delivery');
								$id_tc_transaksi_dev = $hasilDelivery->Fields('id_tc_transaksi');
								$nama_pm = $hasilDelivery->Fields('nama_pm');
								$mitra_vendor = $hasilDelivery->Fields('mitra_vendor');
								$link_domain = $hasilDelivery->Fields('link_domain');
								$keterangan = $hasilDelivery->Fields('keterangan');
								$tglDelivery = date('Y-m-d',strtotime($hasilDelivery->Fields('tgl_input'))) ;
								?>
								<!--begin::Table-->
									<form id="idTambahDelivery" method="POST" action="#"  enctype="multipart/form-data">
										<div class="position-relative row form-group"><label class="col-sm-4 col-form-label">User </label>
											<div class="col-sm-8"><input name="username" id="username" placeholder="User Name" type="text" class="form-control" value="<?=$username?>" readonly></div>
										</div>
										<div class="position-relative row form-group"><label class="col-sm-4 col-form-label"> Nama PM <?=mandatory();?> </label>
											<div class="col-sm-8"><input name="nama_pm"value="<?= $nama_pm ?>" id="username" placeholder="nama pm" type="text" class="form-control"></div>
										</div>
										<div class="position-relative row form-group"><label class="col-sm-4 col-form-label">Mitra/Vendor <?=mandatory();?> </label>
											<div class="col-sm-8"><input name="mitra_vendor" value="<?= $mitra_vendor ?>" id="mitra / vendor" placeholder="User Name" type="text" class="form-control"></div>
										</div>
										<div class="position-relative row form-group"><label class="col-sm-4 col-form-label">Link Domain <?=mandatory();?> </label>
											<div class="col-sm-8"><input name="link_domain" value="<?= $link_domain ?>" placeholder="link domain" type="text" class="form-control"></div>
										</div>
										<div class="position-relative row form-group"><label class="col-sm-4 col-form-label">Keterangan </label>
											<div class="col-sm-8"><textarea name="keterangan" id="keterangan" type="text" class="form-control"><?=$keterangan?></textarea></div>
										</div>
										<div class="position-relative row form-group"><label class="col-sm-4 col-form-label">Tanggal <?=mandatory();?> </label>
											<div class="col-sm-8"><input name="tgl_input" value="<?= $tglDelivery ?>" id="username" placeholder="tanggal" type="date" class="form-control"></div>
										</div>
										<input type="hidden" name="id_dd_user" value="<?=$id_dd_user?>">
										<input type="hidden" name="id_tc_transaksi" value="<?=$id_tc_transaksi?>">
										<input type="hidden" name="id_tc_pengajuan" value="<?=$id?>">
										
										
									   <div class="">
											<div class="col-sm-10 offset-sm-5">
											<?if($id_tc_transaksi_dev==""){ 	?>
												<input type="hidden" name="act" value="tambah">
												<button type="button" class="btn btn-success font-size-sm" onclick="AddDel()">Submit</button>
												
											<?}else{?>
												<input type="hidden" name="act" value="edit">
												<input type="hidden" name="id_tc_delivery" value="<?=$id_tc_delivery?>">
												<button type="button" class="btn btn-success font-size-sm" onclick="AddDel()">Edit</button>
											<?}?>
											</div>
										</div>
                                      </form>
									<!--end::Table-->
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<script>
			function AddDel(){
				var dataform=$("#idTambahDelivery").serialize();
				$.ajax({
					type: "POST",
					url: '/04_delivery/delivery_projek_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							//Swal.fire("Success!","Data Berhasil ditambah!","success");
							 //Swal.fire({icon: 'success',title: 'Yayy...',text: 'Data berhasil dimasukan!!'});
							load(<?=$id?>)
							//$('#BuatModal').modal('hide');
						}else{
							//Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
							//Swal.fire({icon: 'error',title: 'Oops...',text: 'Data gagal dimasukan!!',footer: 'Note: Terjadi kesalahan saat memasukan data!!'});
						}
					},
					dataType: "json"
				});
			}
			</script>
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
function BackDelivery(){
	$("#idContent").load('../04_delivery/index.php');
}

function DokDownload(a){
	$("#idIsiModalLarge").load("/04_delivery/download_dokumen.php",{id:a},function(){
		$("#BuatModalLarge").modal('show');
	});
}

function AddDelivery(a,b){
	$("#idIsiModal").load("/04_delivery/add_delivery_projek.php",{idt:a,id:b},function(){
		$("#BuatModal").modal('show');
	});
}

function Close(a){
		$('#BuatModal').modal('hide');
		$("#idContent").load('../04_delivery/projek_detail.php',{id:a});
	}
function load(a){
		$("#idContent").load('../04_delivery/projek_detail.php',{id:a});
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
