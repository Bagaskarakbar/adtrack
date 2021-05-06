<?

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_number");
// $db->debug= true;
$nama_pegawai=baca_tabel("mt_karyawan","nama_pegawai"," where kode_dokter=$kode_dokter");
$kode_bagian_dokter = baca_tabel("mt_karyawan","kode_bagian","where kode_dokter = $kode_dokter");
$sql = "SELECT * FROM mt_jadwal_dokter WHERE kode_dokter= '$kode_dokter' ";

$hasil =$db->Execute($sql);
$id_mt_jadwal_dokter = $hasil->Fields('id_mt_jadwal_dokter');
$kode_dokter = $kode_dokter;
$kode_bagian = $kode_bagian_dokter;
$range_hari = $hasil->Fields('range_hari');
$jam_mulai = $hasil->Fields('jam_mulai');
$jam_akhir = $hasil->Fields('jam_akhir');
$keterangan = $hasil->Fields('keterangan');
$senin = $hasil->Fields('senin');
$selasa = $hasil->Fields('selasa');
$rabu = $hasil->Fields('rabu');
$kamis = $hasil->Fields('kamis');
$jumat = $hasil->Fields('jumat');
$sabtu = $hasil->Fields('sabtu');
$minggu = $hasil->Fields('minggu');
$tgl_input = $hasil->Fields('tgl_input');
$waktu_periksa = $hasil->Fields('waktu_periksa');
if($hasil->Fields('id_mt_jadwal_dokter') != NULL){
	$aksi = "edit";
}
else{
	$aksi = "add";
	$id_mt_jadwal_dokter = max_kode_number("mt_jadwal_dokter","id_mt_jadwal_dokter");
}

$jam=substr($jam_mulai,11,2);
$menit=substr($jam_mulai,13,2);

$jam_akhirX=substr($jam_akhir,11,2);
$menit_akhir=substr($jam_akhir,13,2);

?>
<div class="tab-pane fade show active" id="kt_tab_pane_1_1" role="tabpanel" aria-labelledby="kt_tab_pane_1_1">
<div class="card-header border-0 py-3">
	<h3 class="card-title align-items-start flex-column">
		<span class="card-label font-weight-bolder text-dark">Jadwal Dokter</span>
	</h3>
</div>


		<form id="FormUserAddEdit" method="post" action="#" enctype="multipart/form-data">
			<div class="row form-group">
				<label class="col-2 col-form-label">Interval</label>
				<div class="col-2">
					<input class="form-control" type="text" value="<?= $waktu_periksa?>" name="waktu_periksa" tabindex="1"/>
				</div>
				<label class="col-2 col-form-label">Menit</label>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Jam Mulai</label>
				<div class="col-7">
					<select name="jam_awal">
						<?

						$jam_awalx=$jam;
						for ($i = 0 ; $i <= 24 ; $i++) {
							if ($i == $jam_awalx) {
								$sSelected = " selected ";
							} else {
								$sSelected = " ";
							}

							echo "<option value=" . $i . $sSelected . ">" . $i . "</option>";
						}
						?>
					</select>
					<B>&nbsp;:&nbsp;
						<select name="menit_awal">
							<option value="00" <?if($menit=="00") echo "selected"?>> 00</option>
							<option value="15" <?if($menit=="15") echo "selected"?>> 15</option>
							<option value="30" <?if($menit=="30") echo "selected"?>> 30</option>
							<option value="45" <?if($menit=="45") echo "selected"?>> 45</option>

						</select>
					</B>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-2 col-form-label">Jam Akhir</label>
				<div class="col-7"> 
					<select name="jam_akhir">
						<?

						$jamX=$jam_akhirX;
						for ($i = 0 ; $i <= 24 ; $i++) {
							if ($i == $jamX) {
								$sSelected = " selected ";
							} else {
								$sSelected = " ";
							}

							echo "<option value=" . $i . $sSelected . ">" . $i . "</option>";
						}
						?>
					</select>
					<B>&nbsp;:&nbsp;
						<select name="menit_akhir">
							<option value="00" <?if($menitX=="00") echo "selected"?>> 00</option>
							<option value="15" <?if($menitX=="15") echo "selected"?>> 15</option>
							<option value="30" <?if($menitX=="30") echo "selected"?>> 30</option>
							<option value="45" <?if($menitX=="45") echo "selected"?>> 45</option>

						</select>
					</B>
				</div>
			</div>
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label font-weight-bolder text-dark">Hari Dokter Masuk</span>
			</h3>
			<div class="row form-group">
				<div class="col-1">
					<label class="col-form-label">Senin</label>
					<input class="form-control" type="checkbox" value="1;Senin" name="senin" tabindex="3" <?if($senin==1) echo "checked"?>/>
				</div>
				<div class="col-1">
					<label class="col-form-label">Selasa</label>
					<input class="form-control" type="checkbox" value="1;Selasa" name="selasa" tabindex="4" <?if($selasa==1) echo "checked"?>/>
				</div>
				<div class="col-1">
					<label class="col-form-label">Rabu</label>
					<input class="form-control" type="checkbox" value="1;Rabu" name="rabu" tabindex="5" <?if($rabu==1) echo "checked"?>/>
				</div>
				<div class="col-1">
					<label class="col-form-label">Kamis</label>
					<input class="form-control" type="checkbox" value="1;Kamis" name="kamis" tabindex="6" <?if($kamis==1) echo "checked"?>/>
				</div>
				<div class="col-1">
					<label class="col-form-label">Jumat</label>
					<input class="form-control" type="checkbox" value="1;Jumat" name="jumat" tabindex="7" <?if($jumat==1) echo "checked"?>/>
				</div>
				<div class="col-1">
					<label class="col-form-label">Sabtu</label>
					<input class="form-control" type="checkbox" value="1;Sabtu" name="sabtu" tabindex="8" <?if($sabtu==1) echo "checked"?>/>
				</div>
				<div class="col-1">
					<label class="col-form-label">Minggu</label>
					<input class="form-control" type="checkbox" value="1;Minggu" name="minggu" tabindex="9" <?if($minggu==1) echo "checked"?>/>
				</div>
			</div>
			<input type="hidden" name="act" value="<?=$aksi ?>">
			<input type="hidden" name="id_mt_jadwal_dokter" value="<?=$id_mt_jadwal_dokter?>">
			<input type="hidden" name="kode_dokter" value="<?=$kode_dokter?>">
			<input type="hidden" name="kode_bagian" value="<?=$kode_bagian?>">
			<div class="card-footer">
				<input type="button" value="Edit Jadwal" class="btn btn-success mr-2" onclick="edit_jadwal(<?=$kode_dokter?>)"></button>
			</div>
		</form>			
</div>

<script type="text/javascript">
	function edit_jadwal(a){
		Swal.fire({
        title: "Simpan Jadwal Dokter ?",
        text: "<?=$nama_pegawai?>, apakah data yang di pilih sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Simpan",
		cancelButtonText: "Batal",
		customClass: {
		   confirmButton: "btn btn-success",
		   cancelButton: "btn btn-warning"
		  }
		}).then(function(result) {
			if (result.value) {
				var dataform=$("#FormUserAddEdit").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/jadwal_dokter_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							Swal.fire("Sukses ","Berhasil Menyimpan data","success");
							$('#kt_tab_pane').load("../00_admin/jadwal_dokter.php",{kode_dokter:<?=$kode_dokter?>});
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