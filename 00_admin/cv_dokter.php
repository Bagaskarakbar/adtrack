<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_number");
// $db->debug= true;
$nama_pegawai=baca_tabel("mt_karyawan","nama_pegawai"," where kode_dokter=$kode_dokter");
$kode_bagian_dokter = baca_tabel("mt_karyawan","kode_bagian","where kode_dokter = $kode_dokter");

		$sql=read_tabel("mt_karyawan","*","where kode_dokter='$kode_dokter'");
		while ($tampil=$sql->FetchRow()) {
			$nama_pegawai		= $tampil["nama_pegawai"];
			$telp				= $tampil["telp"];
			$email				= $tampil["email"];
			$alamat				= $tampil["alamat"];
			$kode_spesialisasi	= $tampil["kode_spesialisasi"];
			$url_foto_karyawan	= $tampil["url_foto_karyawan"];

		}

		$nama_spesialisasi=baca_tabel("mt_spesialisasi_dokter","nama_spesialisasi"," where kode_spesialisasi=$kode_spesialisasi");

?>
<div class="tab-pane fade show active" id="idRiwayatPendidikan" role="tabpanel" aria-labelledby="kt_tab_pane_1_1">
<div class="card-header border-0 py-3">
	<h3 class="card-title align-items-start flex-column">
		<span class="card-label font-weight-bolder text-dark">CV Dokter</span>
	</h3>
		<div class="row">
			<div class="col-lg-4">

				<div class="card card-custom card-stretch gutter-b">
					<div class="card-header border-0 pt-5">
						<h3 class="card-title font-weight-bolder ">Profil Dokter</h3>
						<div class="card-toolbar">
							
						</div>
					</div>
					<div class="card-body d-flex flex-column">
						<div class="flex-grow-1 align-center">
							<?if($url_foto_karyawan!=""){?>
							<img src="<?=$url_foto_karyawan?>" style="border-radius: 200px; -moz-border-radius:100px" width="150" height="150">
							<?}else{?>
								
									<img src="assets/media/svg/avatars/<?=$icon?>" style="border-radius: 200px; -moz-border-radius:100px" width="200" class="center" alt="" />
									
								<?}?>
						</div>
						<div class="pt-5">
							
							<p class="text-center font-weight-normal font-size pb-3"  style="font-size: 12px">
								 <?=$nama_pasien?> <br /><a class="text-primary"><?//=$no_mr?><a/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8">


				<div class="card card-custom card-stretch gutter-b">

					<!--begin::Header-->
					<div class="card-header border-0 py-5">
							<h3 class="card-title font-weight-bolder ">Profil Dokter Hisehat</h3>
						</div>
						<div class="card-body pt-0 pb-3">
							<div class="tab-content">

								<!--begin::Table-->
								<div class="table-responsive" id="idAntrian">

									<table class="table table-separate table-head-custom table-checkable" >			
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													Nama Lengkap
												</span>
											</td>
											<td>:</td>
											<td><?=$nama_pegawai?></td>
										</tr>
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													Email
												</span>
											</td>
											<td>:</td>
											<td><?=$email?></td>
										</tr>
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													HP
												</span>
											</td>
											<td>:</td>
											<td><?=$telp?></td>
										</tr>
										<tr>
											<td class="text-left text-uppercase">
												<span class="text-dark-75 font-weight-bolder d-block font-size-sm">
													Alamat
												</span>
											</td>
											<td>:</td>
											<td><?=$alamat?></td>
										</tr>



									</table>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">					
					<div class="card-header border-0 py-5">						
							<h3 class="card-title font-weight-bolder ">Riwayat Praktek</h3>
						</div>
						<div class="card-body pt-0 pb-3">
							<div class="tab-content">
								<div class="table-responsive" id="idAntrian">
									<div class="table-responsive" id="idPraktek">
									<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
									<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_riwayat_praktek.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
										<thead>
											<tr>
												<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
												<th data-field="nomer"><span class="text-dark-75 text-center">Nomer Izin Praktek</span></th>
												<th data-field="propinsi" class="text-center"><span class="text-dark-75 text-center">Propinsi</span></th>
												<th data-field="kota" class="text-center"><span class="text-dark-75 text-center">Kota </span></th>
												<th data-field="status" ><span class="text-dark-75 text-center">Status</span></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">					
					<div class="card-header border-0 py-5">						
							<h3 class="card-title font-weight-bolder ">Perjanjian Dokter</h3>
						</div>
						<div class="card-body pt-0 pb-3">
							<div class="tab-content">
								<div class="table-responsive" id="idAntrian">
									<div class="table-responsive" id="idPraktek">
									<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
									<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_perjanjian_dokter.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
										<thead>
											<tr>
												<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
												<th data-field="nomer_str"><span class="text-dark-75 text-center">Nomer STR</span></th>
												<th data-field="nomer_kontrak"><span class="text-dark-75 text-center">Nomer Kontrak</span></th>
												<th data-field="massa_berlaku" class="text-center"><span class="text-dark-75 text-center">Massa Berlaku</span></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">					
					<div class="card-header border-0 py-5">						
							<h3 class="card-title font-weight-bolder ">Riwayat Pendidikan</h3>
						</div>
						<div class="card-body pt-0 pb-3">
							<div class="tab-content">
								<div class="table-responsive" id="idPendidikan">
								<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
								<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_riwayat_pendidikan.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
									<thead>
										<tr>
											<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
											<th data-field="nama_instansi_pendidikan"><span class="text-dark-75 text-center">Nama Instansi Pendidikan</span></th>
											<th data-field="tahun_mulai" class="text-center"><span class="text-dark-75 text-center">Tahun Mulai</span></th>
											<th data-field="tahun_lulus" class="text-center"><span class="text-dark-75 text-center">Tahun Lulus </span></th>
											<th data-field="jurusan" ><span class="text-dark-75 text-center">Jurusan</span></th>
											<th data-field="gelar" ><span class="text-dark-75 text-center">Gelar</span></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">					
					<div class="card-header border-0 py-5">						
							<h3 class="card-title font-weight-bolder ">Riwayat Jabatan</h3>
						</div>
						<div class="card-body pt-0 pb-3">
							<div class="tab-content">
								<div class="table-responsive" id="idJabatan">
								<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
								<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_riwayat_jabatan_dokter.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
									<thead>
										<tr>
											<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
											<th data-field="instansi"><span class="text-dark-75 text-center">Instasi</span></th>
											<th data-field="nama_spesialisasi"><span class="text-dark-75 text-center">Spesialisasi</span></th>
											<th data-field="tahun_jabatan" class="text-center"><span class="text-dark-75 text-center">Tahun Jabatan</span></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">					
					<div class="card-header border-0 py-5">						
							<h3 class="card-title font-weight-bolder ">Riwayat Keluarga</h3>
						</div>
						<div class="card-body pt-0 pb-3">
							<div class="tab-content">
								<div class="table-responsive" id="idJabatan">
								<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
								<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_riwayat_keluarga.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
									<thead>
										<tr>
											<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
											<th data-field="nama_keluarga"><span class="text-dark-75 text-center">Nama Keluarga</span></th>
											<th data-field="status_keluarga"><span class="text-dark-75 text-center">Status Keluarga</span></th>
											<th data-field="tgl_lahir" class="text-center"><span class="text-dark-75 text-center">Tanggal Lahir</span></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>	
<div id="ModalIsiPerjanjian" class="modal fade bd-modal-packing-md" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content" id="idIsiModalPerjanjian"></div>
	</div>
</div>
<script>
function AddPerjanjian(a){
	$("#idIsiModalPerjanjian").load("../00_admin/perjanjian_dokter_form.php",{kode_dokter:<?=$kode_dokter?>,id:a},function(){
	$("#ModalIsiPerjanjian").modal("show");
	});
}

function hapusPerjanjian(a){
		Swal.fire({
        title: "Hapus Perjanjian Dokter ?",
        text: "apakah data yang di pilih sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		customClass: {
		   confirmButton: "btn btn-danger",
		   cancelButton: "btn btn-warning"
		  }
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: '/00_admin/perjanjian_dokter_form_act.php',
					data: {id_mt_perjanjian_dokter:a,validasi:3},
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiPerjanjian").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pane').load("../00_admin/perjanjian_dokter.php",{kode_dokter:<?=$kode_dokter?>});
							Swal.fire("Sukses ","Berhasil Menghapus data","success");
						}else{
							alert('Gagal');
						}
					},
					dataType: "json"
				});
			}
		});
		

	}
</script>