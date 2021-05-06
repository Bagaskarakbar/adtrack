<?
	session_start();
	/**
	 *
	 * Mendeklarasikan librari-librari dasar
	 *
	 */	 
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.pilihan_list");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.uang");
	loadlib("function", "function.input_uang");
	//$db->debug=true;

	$sql = "SELECT * FROM pm_mt_standarhasil WHERE kode_mt_hasilpm='".$kode_mt_hasilpm."'";
	$hasil =& $db->Execute($sql);

	$kode_mt_hasilpm = $hasil->Fields('kode_mt_hasilpm');
	$kode_tarif = $hasil->Fields('kode_tarif');
	$nama_pemeriksaan = $hasil->Fields('nama_pemeriksaan');
	$kode_bagian = $hasil->Fields('kode_bagian');
	$standar_hasil_wanita = $hasil->Fields('standar_hasil_wanita');
	$standar_hasil_pria = $hasil->Fields('standar_hasil_pria');
	$standar_hasil_wanita_min = $hasil->Fields('standar_hasil_wanita_min');
	$standar_hasil_wanita_max = $hasil->Fields('standar_hasil_wanita_max');
	$standar_hasil_pria_min = $hasil->Fields('standar_hasil_pria_min');
	$standar_hasil_pria_max = $hasil->Fields('standar_hasil_pria_max');
	$satuan = $hasil->Fields('satuan');
	$umur_mulai = $hasil->Fields('umur_mulai');
	$satuan_umur_mulai = $hasil->Fields('satuan_umur_mulai');
	$umur_akhir = $hasil->Fields('umur_akhir');
	$satuan_umur_akhir = $hasil->Fields('satuan_umur_akhir');
	$standar_rad = $hasil->Fields('standar_rad');
	$kesan = $hasil->Fields('kesan');
	$anjuran = $hasil->Fields('anjuran');
	$detail_item_1 = $hasil->Fields('detail_item_1');
	$detail_item_2 = $hasil->Fields('detail_item_2');
	$keterangan = $hasil->Fields('keterangan');
	$keterangan_pemeriksaan_perm = $hasil->Fields('keterangan_pemeriksaan_perm');
	$nama_tindakan=baca_tabel("mt_master_tarif","nama_tarif","where kode_tarif='".$kode_tarif."'");


$sqlCari = "SELECT * FROM mt_master_tarif WHERE kode_bagian='050201' AND tingkatan=5";
$hasilCari =& $db->Execute($sqlCari);

		while ($tampil=$hasilCari->FetchRow()) {
			$i++;
			$nama_tarif = $tampil["nama_tarif"]."-".$tampil["kode_tarif"];
			$kode_tarif = $tampil["kode_tarif"];
			
			$arrTarif[]=$nama_tarif." | ".$kode_tarif;

		}


?>
<div id="FormTambahRadiologi">
		
			<form id="EditRadiologi" method="POST" action="#"  enctype="multipart/form-data">
			
			<div id="content">
					<div class="modal-header register-modal-head" style="background-color:#2b345f">
						<h5 class="modal-title" style="color:white"><b>Edit Radiologi</b></h5>
						<button type="button" class="btn btn-danger"  style="color:white" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-times" aria-hidden="true"></i>
					</button>
					</div>
		
			<div class="col-sm-12">
				<br>
					<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Nama Pemeriksaan</label>
							</div>
							<div class="col-lg-8">
						
								<input type="text" class="form-control" name="nama_tarif" size='30' id="generalSearch" style=" background-color: #e0e0d1;" value="<?= $nama_tindakan ?>" readonly>
								<input type="hidden" name="kode_tarif" id="idKodeTarif">
								
							</div>

					</div>
						<br>

						<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Nama Detail Pemeriksaan</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="nama_pemeriksaan"  value="<?= $nama_pemeriksaan ?>">
							</div>
					</div>
					<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Temuan Radiologi   </label>
							</div>
							<div class="col-lg-8">
								<TEXTAREA NAME="standar_rad" class="form-control" value="<?= $standar_rad ?>" ><?= $standar_rad ?></TEXTAREA>
							</div>

					</div>
				<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Kesan </label>
							</div>
							<div class="col-lg-8">
								<TEXTAREA NAME="txt_kesan" class="form-control"><?= $kesan ?></TEXTAREA>
							</div>

					</div>
			
					
					<br>
						<input type="hidden" class="form-control"  name="kode_mt_hasilpm" value="<?=$kode_mt_hasilpm?>">
						<input type="hidden" class="form-control"  name="kode_bagian" value="050201">
						
					<div class="row">
						<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="EditLab()">Submit</button>
						</div>
						</div>
					</div>

			</div>
				
			</div>
			</form>	
			<br>
</div>



<script>
function EditLab()
				{
					var nama_tarif;
					var nama_pemeriksaan;
					var standar_rad;
					var txt_kesan;
	
					
					nama_tarif			=$("input[name=nama_tarif]").val();
					nama_pemeriksaan	=$("input[name=nama_pemeriksaan]").val();

					standar_rad			=$("textarea[name=standar_rad]").val();
					txt_kesan			=$("textarea[name=txt_kesan]").val();


					if(nama_tarif=="")
					{
						
						$("input[name=nama_tarif]").focus();
						Swal.fire("Oops !", "Anda Belum Memilih Nama Tarif!", "warning");
					}else if(nama_pemeriksaan=="")
					{
						$("input[name=nama_pemeriksaan]").focus();
						Swal.fire("Oops !", "Anda Belum Mengisi Nama Pemeriksaan!", "warning");
					}else{
						Swal.fire({
						title: "Edit Radiologi",
						text: "apakah yakin data yang diinput sudah benar ?",
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
								var datastring=$("#EditRadiologi").serialize();
								$.ajax({
								  type: "POST",
								  url: '/00_admin/standar_lab_edit_act.php',
								  data: datastring,
								  success: function (data){
														if(data.code=='200')
													{ 
															 Swal.fire("Sukses ","Berhasil Mengedit Radiologi","success");
															
															$("#ModalEditRad").modal('hide');
																$('.modal-backdrop').hide();
															$("#RadView").load("../00_admin/rad_standar.php");
													}
														else{
														alert("Gagal Mengedit, Coba Lagi!");
													}
								  },
								  dataType: "json"
								});
							}
						});

					}
				}
</script>

