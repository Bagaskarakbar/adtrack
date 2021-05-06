<?
session_start();
require_once("../_lib/function/db.php");

loadlib("function","variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.max_kode_number");
loadlib("function","function.pilihan_list");
loadlib("class","Paging");


$aksi = "add";
$kode_terakhir = max_kode_number("mt_perusahaan","kode_perusahaan");
?>
<style type="text/css">
	.required {
		color : red;
	}
	.required-icon{
		color:red;
	}
</style>
<!-- ========================================================================================= -->

<!-- ========================================================================================= -->
<div id="isiUtama">
	<div class="modal-header register-modal-head" style="background-color:#2ca4d7">
		<h5 class="modal-title" style="color:white">Tambah Yankes Baru</h5>
		<button type="button" class="close" style="color:white" data-dismiss="modal" aria-label="Close">
			<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="card-body" id="tab_frame">
		<form id="FormUserAddEdit" method="post" action="data_yankes_act.php?act=<?= $aksi?>">
<!-- 			<p aria-hidden="true" id="required-description">
				<span class="required">*</span>Wajib Diisi
			</p> -->
			<div class="row form-group">
				<label class="col-2 col-form-label">Kode Yankes</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $kode_terakhir ?>" name="kode_terakhir" tabindex="1" disabled />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Nama Yankes</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<? $nama_yankes ?>" name="nama_perusahaan" tabindex="2" required="required" />
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
				<label class="col-2 col-form-label text-left">Kota</label>
				<div class="col-7" id="id_dc_kota">
					<!-- <input class="form-control" type="text" name="kota" value="" tabindex="8" /> -->
					<select class="form-control" tabindex="8" required>
						<option value="0">-- pilih Kota --</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label text-left">Kecamatan</label>
				<div class="col-7" id="id_dc_kecamatan">
					<select class="form-control" tabindex="9" required >
						<option value="0">-- pilih Kecamatan --</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label text-left">Kelurahan</label>
				<div class="col-7" id="id_dc_kelurahan">
					<select class="form-control" tabindex="10" required >
						<option value="0">-- pilih Kelurahan --</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Telepon #1 </label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $telepon1 ?>" name="telepon1" tabindex="11" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Telepon #2 </label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $telepon2 ?>" name="telepon2" tabindex="12" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Faksimili </label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $faksimili ?>" name="faksimili" tabindex="13" required="required" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Contact Person #1 </label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $contact_person1 ?>" name="contact_person1" tabindex="14" required="required" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Contact Person #2</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $contact_person2?>" name="contact_person2" tabindex="15" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Jumlah Dokter </label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $jml_dokter ?>" name="jml_dokter" tabindex="16" required="required" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Jumlah Perawat</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $jml_perawat ?>" name="jml_perawat" tabindex="17" required="required" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Nomor Perjanjian </label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $no_perjanjian ?>" name="no_perjanjian" tabindex="18" required="required" />
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Nama Perjanjian</label>
				<div class="col-7">
					<input class="form-control" type="text" value="<?= $nama_perjanjian ?>" name="nama_perjanjian" tabindex="19"/>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label text-left">Logo</label>
				<div class="col-4">
					<input class="form-control" type="file" value="<?=$foto?>" name="foto" id="foto" tabindex="20">
				</div>
			</div>
			<div class=" row form-group">
				<label class="col-2 col-form-label">Status</label>
				<div class="radio-inline">
					<label class="radio">
						<input type="radio" name="status" value="1"/>
						<span></span>
						Aktif
					</label>
					<label class="radio">
						<input type="radio" name="status" value="0"/>
						<span></span>
						Non Aktif
					</label>
				</div>
			</div>
			<input type="hidden" name="act" value="<?=$aksi ?>">
			<div class="card-footer" style="float: right;">
				<button type="reset" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
				<input type="button" value="Submit" class="btn btn-success mr-2" onclick="tambah_yankes()"></button>
			</div>
		</form>
		<!-- <input type="reset" value="Batal" class="btn btn-warning font-weight-bold" data-dismiss="modal"> -->

	</div>
</div>
<!-- ========================================================================================= -->
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script language="JavaScript" type="text/javascript">	
	function tambah_yankes(){
		var dataform=$("#FormUserAddEdit").serialize();
		$.ajax({
			type: "POST",
			url: '/00_admin/data_yankes_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
					Swal.fire("Success!","Data Berhasil ditambah!","success");
					$("#TableView").bootstrapTable('refresh');
					$('#BuatModal').modal('hide');
				}else{
					Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
				}
			},
			dataType: "json"
		});
	}
</script>