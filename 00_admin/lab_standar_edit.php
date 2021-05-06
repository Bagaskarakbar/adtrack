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
	
?>
<div id="">
		
			<form id="FormLabEdit" method="POST" action="#"  enctype="multipart/form-data">
			
			<div id="content">
					<div class="modal-header register-modal-head" style="background-color:#2b345f">
						<h5 class="modal-title" style="color:white"><b>Edit Labolatorium</b></h5>
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
						
								<input type="text" class="form-control" name="nama_tarif" size='30' id="idAutoTindakanPM" style=" background-color: #e0e0d1;" value="<?=$nama_tindakan?>" readonly>
								<input type="hidden" name="kode_tarif" id="idKodeTarif" value="<?=$kode_tarif?>">
								
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
								<label for="exampleSelect1">Detail Item(1)</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="detail_item_1" value="<?= $detail_item_1 ?>">
							</div>
					</div>
					<br>	

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Detail Item(2)</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="detail_item_2" value="<?= $detail_item_2 ?>" >
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Wanita</label>
							</div>
							<div class="col-lg-8">
								
								<TEXTAREA class="form-control" NAME="standar_hasil_wanita"  ROWS="4" COLS="70"><?=$standar_hasil_wanita?></TEXTAREA>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Wanita Minimal</label>
							</div>
							<div class="col-lg-8">
								
								<input type="text" name="standar_hasil_wanita_min" class="form-control" value="<?= $standar_hasil_wanita_min ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Wanita Maximal</label>
							</div>
							<div class="col-lg-8">
								
								<input type="text" class="form-control" name="standar_hasil_wanita_max" value="<?= $standar_hasil_wanita_max ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Pria</label>
							</div>
							<div class="col-lg-8">
								<TEXTAREA type="text" class="form-control" NAME="standar_hasil_pria"  ><?=$standar_hasil_pria?></TEXTAREA>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Pria Minimal</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="standar_hasil_pria_min" value="<?= $standar_hasil_pria_min ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Pria Maximal</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="standar_hasil_pria_max" value="<?= $standar_hasil_pria_max ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Satuan</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="satuan" value="<?= $satuan ?>"/>
							</div>
					</div>
					<br>


					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Satuan Umur</label>
							</div>
							<div class="col-lg-8">
										<select name="satuan_umur_mulai" class="form-control">
											<?
												$sql_umur="SELECT * FROM dd_mktime WHERE id_dd_mktime <= 4";
												pilihan_list($sql_umur,"satuan","id_dd_mktime","id_dd_mktime",$satuan_umur_mulai);
											?>
											</select>
							</div>
					</div>
					<br>	


					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Umur mulai</label>
							</div>
							<div class="col-lg-8">
										<input type="text" class="form-control" name="umur_mulai" value="<?= $umur_mulai ?>" />
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Umur akhir</label>
							</div>
							<div class="col-lg-8">
										<input type="text" class="form-control" name="umur_akhir" value="<?= $umur_akhir ?>" />
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Keterangan</label>
							</div>
							<div class="col-lg-8">
											<TEXTAREA  class="form-control" NAME="keterangan" ><?=$keterangan?></TEXTAREA>
							</div>
					</div>
					<br>
			
					
					<!--------------------------------------------------------------------------------------------------->

					<!--------------------------------------------------------------------------------------------------->
					
					
					
					<br>
						<input type="hidden" class="form-control"  name="kode_mt_hasilpm" value="<?=$kode_mt_hasilpm?>">
						<input type="hidden" class="form-control"  name="kode_bagnya" value="050101">
						<input type="hidden" class="form-control"  name="validasi" value="2">
						
					<div class="row">
						<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="CekEditLab()">Submit</button>
						</div>
						</div>
					</div>

			</div>
				
			</div>
			</form>	
			<br>
</div>

<!--END------------------------------------------------------------------------->

		<script language="JavaScript" type="text/javascript">
		
		</script>
		<script>
		function CekEditLab(){
			Swal.fire({
			title: "Simpan Data Labolatorium ?",
			text: "apakah data yang di pilih sudah benar ?",
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
					var dataform=$("#FormLabEdit").serialize();
					$.ajax({
						type: "POST",
						url: '/00_admin/standar_lab_act.php',
						data: dataform,
						success: function(data){
							if(data.code=='200'){
								$("#ModalEditLab").modal('hide');
								$('.modal-backdrop').remove();
								$('#idLab').load("../00_admin/lab_standar.php");
								Swal.fire("Sukses ","Berhasil Menyimpan data","success");
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
	</body>
</html>
