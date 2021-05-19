<?

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
				<table class="align-middle mb-0 table table-borderless table-striped table-hover">
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
																		<!-- <div class="widget-subheading opacity-7">Web Developer</div> -->
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
																		<!-- <div class="widget-subheading opacity-7">Lorem ipsum dolor sic</div> -->
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
																		<!-- <div class="widget-subheading opacity-7">UI Designer</div> -->
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
				</table>
		</div>
<div class="d-block text-center card-footer">
<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
			<button class="btn-wide btn btn-success">Save</button> -->
</div>
<script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
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
  			<option value="klinik">Klinik</option>
  			<option value="rs">Rumah Sakit</option>
  			<option value="puskesmas">Puskesmas</option>
			</select>
			<select name="layanan" id="layanan" class="swal2-input">
				<option value="" disabled selected>Jenis Layanan</option>
				<option value="hysis">HiSys</option>
				<option value="digiclinic">DigiClinic</option>
				<option value="telemedika">Telemedika</option>
				<option value="epuskesmas">ePuskesmas</option>
			</select>
			<select name="bundling" id="bundling" class="swal2-input">
				<option value="" disabled selected>Jenis Bundling</option>
  			<option value="">test</option>
			</select>
			<select name="paket_layanan" id="paket_layanan" class="swal2-input">
  			<option value="" disabled selected>Paket Layanan</option>
  			<option value="standard">RS Standard</option>
  			<option value="klinik_light">Klinik Light</option>
  			<option value="klinik_standard">Klinik Standard</option>
			</select>
			<select name="jenis_projek" id="jenis_projek" class="swal2-input">
				<option value="" disabled selected>Jenis Projek</option>
  			<option value="">test</option>
			</select>
			<input type="text" id="tgl_spk" class="swal2-input" placeholder="Tanggal SPK" onfocus="(this.type='date')">
			<input type="number" id="nomor" class="swal2-input" placeholder="Nomor" style="max-width:none !important;">
			<textarea rows="4" cols="50" placeholder="Perihal" class="swal2-textarea"></textarea>
			<input type="number" id="unit" class="swal2-input" placeholder="Lama Kontrak" style="max-width:none !important;">`,
			confirmButtonText: 'Masuk',
			focusConfirm: false,
			preConfirm: () => {
				const nama = Swal.getPopup().querySelector('#nama_mitra').value
				const jenis = Swal.getPopup().querySelector('#jenis_mitra').value
				if (!nama) {
					Swal.showValidationMessage(`Nama Mitra harus dimasukan!!`)
			}
			if(!jenis){
					Swal.showValidationMessage(`Jenis Mitra harus dimasukan!!`)
			}
			return { nama: nama, jenis: jenis }
	}
}).then(function(result){
	if(result.value){
		Swal.fire({
			icon: 'success',
			title: 'Yayy...',
			text: 'Data berhasil dimasukan!!'
	})
}else{
		Swal.fire({
			icon: 'erorr',
			title: 'Oops...',
			text: 'Data gagal dimasukan!!',
			footer: '<a href>Why do I have this issue?</a>'
	})
}
})
}
</script>
