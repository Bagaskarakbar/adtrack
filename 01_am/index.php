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
<div class="card-header">List Projek
		<div class="btn-actions-pane-right" style="padding-right:10px;">
			<!-- <div role="group" class="btn-group-sm btn-group">
						<button class="active btn btn-focus">Last Week</button>
						<button class="btn btn-focus">All Month</button>
				</div> -->
				<button class="btn-wide btn btn-info" onclick="am_form()"><i class="fa fa-plus"></i>  Proyek Baru</button>
		</div>
</div>
		<div class="table-responsive">
				<!-- <table class="align-middle mb-0 table table-borderless table-striped table-hover">
						<thead>
								<tr>
										<th class="text-center">No</th>
										<th>Nama Projek</th>
										<th class="text-center">Jenis Pelanggan</th>
										<th class="text-center">Layanan</th>
										<th class="text-center">Paket Layanan</th>
										<th class="text-center">Tanggal Input</th>
										<th class="text-center">Aksi</th>
								</tr>
						</thead>
						<tbody>
								<tr>
										<td class="text-center">1.</td>
										<td>
												<div class="widget-content p-0">
														<div class="widget-content-wrapper">
																<div class="widget-content-left flex2">
																		<div class="widget-heading" style="color:#495057">Rs. Hermina</div>
																</div>
														</div>
												</div>
										</td>
										<td class="text-center">RS</td>
										<td class="text-center">HiSys</td>
										<td class="text-center">Rs Basic</td>
										<td class="text-center">10-05-2021</td>
										<td class="text-center">
												<button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm"><a href="projek_detail.html" style="color: white; text-decoration: none;">Detail</a></button>
										</td>
								</tr>
								<tr>
										<td class="text-center">2.</td>
										<td>
												<div class="widget-content p-0">
														<div class="widget-content-wrapper">
																<div class="widget-content-left flex2">
																		<div class="widget-heading" style="color:#495057">Klinik Pelita</div>
																</div>
														</div>
												</div>
										</td>
										<td class="text-center">Klinik</td>
										<td class="text-center">DigiClinic</td>
										<td class="text-center">Klinik Light</td>
										<td class="text-center">10-05-2021</td>
										<td class="text-center">
												<button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm"><a href="projek_detail.html" style="color: white; text-decoration: none;">Detail</a></button>
										</td>
								</tr>
								<tr>
										<td class="text-center">3.</td>
										<td>
												<div class="widget-content p-0">
														<div class="widget-content-wrapper">
																<div class="widget-content-left flex2">
																		<div class="widget-heading" style="color:#495057">Rs. Kebayoran</div>
																</div>
														</div>
												</div>
										</td>
										<td class="text-center">RS</td>
										<td class="text-center">HiSys</td>
										<td class="text-center">Rs Enterprise</td>
										<td class="text-center">10-05-2021</td>
										<td class="text-center">
												<button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm"><a href="projek_detail.html" style="color: white; text-decoration: none;">Detail</a></button>
										</td>
								</tr>
								<tr>
										<td class="text-center">4.</td>
										<td>
												<div class="widget-content p-0">
														<div class="widget-content-wrapper">
																<div class="widget-content-left flex2">
																		<div class="widget-heading" style="color:#495057">Puskesmas Cikini</div>
																</div>
														</div>
												</div>
										</td>
										<td class="text-center">Puskesmas</td>
										<td class="text-center">ePuskesmas</td>
										<td class="text-center">Puskesmas Standard</td>
										<td class="text-center">10-05-2021</td>
										<td class="text-center">
												<button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm"><a href="projek_detail.html" style="color: white; text-decoration: none;">Detail</a></button>
										</td>
								</tr>
						</tbody>
				</table> -->
				<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/01_am/get_index_view.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
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
<div class="d-block text-center card-footer">
<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
			<button class="btn-wide btn btn-success">Save</button> -->
</div>
<script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
<script type="text/javascript" src="./assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript" src="./assets/scripts/jquery-3.6.0.js"></script>
<script>
	function detail_form(){
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Something went wrong!',
				footer: '<a href>Why do I have this issue?</a>'
		})
	}

	function am_form(){
		Swal.fire({
			title: 'Tambah Proyek',
			html: `<input type="text" id="nama_pelanggan" class="swal2-input" placeholder="Nama Pelanggan">
			<input type="text" id="nama_am" class="swal2-input" placeholder="Nama AM">
			<input type="text" id="unit" class="swal2-input" placeholder="Departmen/Unit">
			<select name="jenis_pelanggan" id="jenis_pelanggan" class="swal2-input">
				<option value="" disabled selected>Jenis Pelanggan</option>
				<?
				$getJenisPelanggan="SELECT * FROM mt_jenis_pelanggan ORDER BY id_mt_jenis_pelanggan ASC";
				pilihan_list($getJenisPelanggan,"jenis_pelanggan","id_mt_jenis_pelanggan","id_mt_jenis_pelanggan");
				?>
			</select>
			<select name="layanan" id="layanan" class="swal2-input" onchange="get_jenis_layanan()">
				<option value="" disabled selected>Jenis Layanan</option>
				<?
				$getJenisLayanan="SELECT * FROM mt_layanan ORDER BY id_mt_layanan ASC";
				pilihan_list($getJenisLayanan,"nama_layanan","id_mt_layanan","id_mt_layanan");
				?>
			</select>
			<select name="bundling" id="bundling" class="swal2-input">
				<option value="" disabled selected>Jenis Bundling</option>
				<?
				$getJenisLayanan="SELECT * FROM mt_bundling ORDER BY id_mt_bundling ASC";
				pilihan_list($getJenisLayanan,"nama_bundling","id_mt_bundling","id_mt_bundling");
				?>
			</select>
			<select name="paket_layanan" id="paket_layanan" class="swal2-input">
  			<option value="" disabled selected>Paket Layanan</option>
				<option value="" disabled>Pilih Jenis Layanan dahulu!!!</option>
			</select>
			<select name="jenis_projek" id="jenis_projek" class="swal2-input">
				<option value="" disabled selected>Jenis Projek</option>
				<?
				$getJenisLayanan="SELECT * FROM mt_jenis_project ORDER BY id_mt_jenis_project ASC";
				pilihan_list($getJenisLayanan,"jenis_project","id_mt_jenis_project","id_mt_jenis_project");
				?>
			</select>
			<input type="text" id="tgl_spk" class="swal2-input" placeholder="Tanggal SPK" onfocus="(this.type='date')">
			<input type="number" id="nomor" class="swal2-input" placeholder="Nomor" style="max-width:none !important;">
			<textarea rows="4" cols="50" placeholder="Perihal" class="swal2-textarea" id="perihal"></textarea>
			<input type="number" id="lama_kontrak" class="swal2-input" placeholder="Lama Kontrak" style="max-width:none !important;">`,
			confirmButtonText: 'Masuk',
			confirmButtonColor: '#007bff',
			cancelButtonText:	'Batal',
			cancelButtonColor:	'#dc3545',
			showCancelButton:	true,
			reverseButtons:	true,
			focusConfirm: false,
			showCloseButton: true,
			preConfirm: () => {
					const nama_pelanggan = Swal.getPopup().querySelector('#nama_pelanggan').value
					const nama_am = Swal.getPopup().querySelector('#nama_am').value
					const unit = Swal.getPopup().querySelector('#unit').value
					const jenis_pelanggan = Swal.getPopup().querySelector('#jenis_pelanggan').value
					const layanan = Swal.getPopup().querySelector('#layanan').value
					const bundling = Swal.getPopup().querySelector('#bundling').value
					const paket_layanan = Swal.getPopup().querySelector('#paket_layanan').value
					const jenis_projek = Swal.getPopup().querySelector('#jenis_projek').value
					const tgl_spk = Swal.getPopup().querySelector('#tgl_spk').value
					const nomor = Swal.getPopup().querySelector('#nomor').value
					const perihal = Swal.getPopup().querySelector('#perihal').value
					const lama_kontrak = Swal.getPopup().querySelector('#lama_kontrak').value
					if (!nama_pelanggan) {
						Swal.showValidationMessage(`Nama Pelanggan harus dimasukan!!`)
					}
					if(!nama_am){
						Swal.showValidationMessage(`Nama AM harus dimasukan!!`)
					}
					if(!unit){
						Swal.showValidationMessage(`Departmen/Unit harus dimasukan!!`)
					}
					if(!jenis_pelanggan){
						Swal.showValidationMessage(`Jenis Pelanggan harus dipilih!!`)
					}
					if (!layanan) {
						Swal.showValidationMessage(`Jenis Layanan harus dipilih!!`)
					}
					if(!bundling){
						Swal.showValidationMessage(`Jenis Bundling harus dipilih!!`)
					}
					if(!paket_layanan){
						Swal.showValidationMessage(`Paket Layanan harus dipilih!!`)
					}
					if(!jenis_projek){
						Swal.showValidationMessage(`Jenis Projek harus dipilih!!`)
					}
					if (!tgl_spk) {
						Swal.showValidationMessage(`Tanggal SPK harus dimasukan!!`)
					}
					if(!nomor){
						Swal.showValidationMessage(`Nomor harus dimasukan!!`)
					}
					if(!perihal){
						Swal.showValidationMessage(`Perihal harus dimasukan!!`)
					}
					if(!lama_kontrak){
						Swal.showValidationMessage(`Lama Kontrak harus dimasukan!!`)
					}
					// return {
					// 	nama_pelanggan: nama_pelanggan,
					// 	nama_am: nama_am,
					// 	unit: unit,
					// 	jenis_pelanggan: jenis_pelanggan,
					// 	layanan: layanan,
					// 	bundling: bundling,
					// 	paket_layanan: paket_layanan,
					// 	jenis_projek: jenis_projek,
					// 	tgl_spk: tgl_spk,
					// 	nomor: nomor,
					// 	perihal: perihal,
					// 	lama_kontrak: lama_kontrak
					// }
				}
		}).then(function(result){
			if(result.value){
				console.log("masuk if");
  			$.ajax({
  				method:"POST",
					dataType:"json",
  				url:'/01_am/am_form_act.php',
  				data:{
						'nama_pelanggan': nama_pelanggan,
						'nama_am': nama_am,
						'unit': unit,
						'jenis_pelanggan': jenis_pelanggan,
						'layanan': layanan,
						'bundling': bundling,
						'paket_layanan': paket_layanan,
						'jenis_projek': jenis_projek,
						'tgl_spk': tgl_spk,
						'nomor': nomor,
						'perihal': perihal,
						'lama_kontrak': lama_kontrak
	        },
  				success:function(data){
						console.log("masuk if ajax");
						console.log(data);
  					if(data.code != "500" ){
							Swal.fire({
								icon: 'success',
								title: 'Yayy...',
								text: 'Data berhasil dimasukan!!'
							})
  					}else{
							Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Data gagal dimasukan!!',
							footer: 'Note: Terjadi kesalahan saat memasukan data!'
							})
  					}
  				},
					error:function(xhr,ajaxOptions,thrownError){
						alert("ERROR:" + xhr.responseText+" - "+thrownError);
					}
  			})
			}else{
				console.log("masuk else");
				Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Data gagal dimasukan!!',
				footer: 'Note: Proses Dibatalkan oleh user!'
				})
			}
		})
	}

	function get_jenis_layanan(){
		var id_mt_layanan=$('#layanan').val();
		$('#paket_layanan').load('../01_am/get_jenis_layanan.php',{id_mt_layanan:id_mt_layanan});
	}
</script>
