<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");;
//$db->debug=true;
$aksi= "edit";
$sql= "select * from mt_perusahaan where id_perusahaan = $id_perusahaan";
$hasil = $db->Execute($sql);
$id_perusahaan =$hasil->Fields("id_perusahaan");
$kode_perusahaan_terakhir = $hasil->Fields("kode_perusahaan");
$nama_perusahaan = $hasil->Fields("nama_perusahaan");
$alamat= $hasil->Fields("alamat");
$telepon1 = $hasil->Fields("telpon1");
$telepon2 = $hasil->Fields("telpon2");
$faksimili = $hasil->Fields("fax");
$contact_person1 = $hasil->Fields("kontakperson");
$contact_person2 = $hasil->Fields("kontakperson2");
$jml_dokter = $hasil->Fields("jml_dokter");
$jml_perawat = $hasil->Fields("jml_perawat");
$no_perjanjian = $hasil->Fields("no_perjanjian");
$nama_perjanjian = $hasil->Fields("nama_perjanjian");
$jenis_kerjasama = $hasil->Fields("jenis_kerjasama");
$provinsi = $hasil->Fields("id_dc_propinsi");
$kota = $hasil->Fields("id_dc_kota");
$kecamatan = $hasil->Fields("id_dc_kecamatan");
$kelurahan = $hasil->Fields("id_dc_kelurahan");
?>
<div id="isiUtama">
	<div class="modal-header register-modal-head" style="background-color:#2ca4d7">
		<h5 class="modal-title" style="color:white">Edit Yankes</h5>
		<button type="button" class="close" style="color:white" data-dismiss="modal" aria-label="Close">
			<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="card-body" id="tab_frame">
		<form id="FormUserAddEdit" method="post" action="data_yankes_act.php">
<!-- 			<p aria-hidden="true" id="required-description">
				<span class="required">*</span>Wajib Diisi
			</p> -->
			<div class="row form-group">
				<label class="col-2 col-form-label">Kode Yankes</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $kode_perusahaan_terakhir ?>" name="kode_perusahaan" tabindex="1" disabled />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Nama Yankes</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $nama_perusahaan ?>" name="nama_perusahaan" tabindex="2" required="required" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Alamat</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $alamat ?>" name="alamat" tabindex="3"/>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Provinsi</label>
				<div class="col-7">
					<select class="form-control" name="id_dc_propinsi"  id="id_dc_propinsi" tabindex="4" onchange="ambilPropinsi()" required>
						<option value="0">-- pilih Provinsi --</option>
						<?
						$getPropinsi="SELECT * FROM dc_propinsi where kd_propinsi != '' ";
						pilihan_list($getPropinsi,"nama_propinsi","id_dc_propinsi","id_dc_propinsi",$provinsi);
						?>
					</select>
				</div>
			</div>
			<div class="row form-group">
<!-- 				<label class="col-2 col-form-label">Kota</label>
				<div class="col-7">
					<select name="kota" value="<?=$kota?>"  class="form-control form-control" tabindex="5" id="kota">
					</select>
				</div> -->
				<label class="col-2 col-form-label text-left">Kota</label>
				<div class="col-7" id="id_dc_kota">
					<!-- <input class="form-control" type="text" name="kota" value="" tabindex="8" /> -->
					<select class="form-control" tabindex="5" required name="kota" id="kota">
						<?if($kota!= ""){
							$getKota="SELECT * FROM dc_kota where id_dc_propinsi = $provinsi";
							pilihan_list($getKota,"nama_kota","id_dc_kota","id_dc_kota",$kota);	
						}
						else{?>
							<option>-- pilih Kota --</option>
							<?}?>
						</select>
					</div>
				</div>
				<div class="row form-group">
<!-- 				<label class="col-2 col-form-label">Kecamatan</label>
				<div class="col-3">
					<select name="kecamatan" value="<?=$kecamatan?>"  class="form-control form-control" tabindex="6" id="kecamatan">
					</select>
				</div> -->
				<label class="col-2 col-form-label text-left">Kecamatan</label>
				<div class="col-7" id="id_dc_kecamatan">
					<select class="form-control" tabindex="6" required name="kecamatan" id="kecamatan" >
						<?if($kecamatan!= ""){
							$getKecamatan="SELECT * FROM dc_kecamatan where id_dc_propinsi = $provinsi";
							pilihan_list($getKecamatan,"nama_kecamatan","id_dc_kecamatan","id_dc_kecamatan",$kecamatan);	
						}
						else{?>
							<option>-- pilih Kecamatan --</option>
							<?}?>
						</select>
					</div>
				</div>
				<div class="row form-group">
<!-- 				<label class="col-2 col-form-label">Kelurahan</label>
				<div class="col-7" id="kelurahan">
					<select name="kelurahan" value="<?=$kelurahan?>"  class="form-control form-control" tabindex="7" id="kelurahan">
					</select>
				</div> -->
				<label class="col-2 col-form-label text-left">Kelurahan</label>
				<div class="col-7" id="id_dc_kelurahan">
					<!-- <input class="form-control" type="text" name="kelurahan" value="" tabindex="10" /> -->
					<select class="form-control" tabindex="7" required name="kelurahan" id="kelurahan">
						<?if($kelurahan!= ""){
							$getKelurahan="SELECT * FROM dc_kelurahan where id_dc_propinsi = $provinsi";
							pilihan_list($getKelurahan,"nama_kelurahan","id_dc_kelurahan","id_dc_kelurahan",$kelurahan);	
						}
						else{?>
							<option>-- pilih Kelurahan --</option>
							<?}?>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Telepon #1</label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $telepon1 ?>" name="telepon1" tabindex="8" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Contact Person #1</label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $contact_person1 ?>" name="contact_person1" tabindex="9" required="required" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Telepon #2 </label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $telepon2 ?>" name="telepon2" tabindex="10" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Contact Person #2 </label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $contact_person2?>" name="contact_person2" tabindex="11" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Faksimili </label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $faksimili ?>" name="faksimili" tabindex="12" required="required" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Jumlah Dokter</label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $jml_dokter ?>" name="jml_dokter" tabindex="13" required="required" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Jumlah Perawat</label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $jml_perawat ?>" name="jml_perawat" tabindex="14" required="required" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Nomor Perjanjian</label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $no_perjanjian ?>" name="no_perjanjian" tabindex="15" required="required" />
					</div>
				</div>
				<div class="row form-group">
					<label class="col-2 col-form-label">Nama Perjanjian</label>
					<div class="col-7">
						<input class="form-control" type="text" value="<?= $nama_perjanjian ?>" name="nama_perjanjian" tabindex="16" required="required" />
					</div>
				</div>
				<input type="hidden" name="act" value="<?=$aksi ?>">
				<input type="hidden" name="id_perusahaan" value="<?=$id_perusahaan ?>">
				<div class="card-footer" style="float: right;">
					<button type="reset" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
					<input type="button" value="Submit" class="btn btn-success mr-2" onclick="edit_yankes()"></button>
				</div>
			</form>
		</div>
	</div>
	<script>
		function edit_yankes(){
			var dataform=$("#FormUserAddEdit").serialize();
			$.ajax({
				type: "POST",
				url: '/00_admin/data_yankes_act.php',
				data: dataform,
				success: function(data){
					if(data.code=='200'){
						Swal.fire("Success!","Data Berhasil diubah!","success");
						$("#TableView").bootstrapTable('refresh');
						$('#BuatModal').modal('hide');
					}else{
						Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
					}
				},
				dataType: "json"
			});

		}
	// function ambilPropinsi(){
	// 	var id_dc_propinsi=$('#provinsi').val();
	// 	$('#kota').load('../00_admin/ajax_cari_kota.php',{id_dc_propinsi:id_dc_propinsi});
	// }
	// function ambilKota(){
	// 	var id_dc_propinsi=$('#provinsi').val();
	// 	var kota=$('#kota').val();
	// 	$('#kecamatan').load('../00_admin/ajax_cari_kecamatan.php',{id_dc_kota:kota,id_dc_propinsi:id_dc_propinsi});
	// }
	// function ambilKecamatan(){
	// 	var id_dc_propinsi=$('#provinsi').val();
	// 	var kota=$('#kota').val();
	// 	var kecamatan=$('#kecamatan').val();
	// 	$('#kelurahan').load('../00_admin/ajax_cari_kelurahan.php',{id_dc_kecamatan:kecamatan,id_dc_kota:kota,id_dc_propinsi:id_dc_propinsi});
	// }
</script>


