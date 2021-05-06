<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_text");

$act="edit";

$sql= "select * from mt_karyawan where no_induk = $no_induk";
$hasil = $db->Execute($sql);
$nama_karyawan =$hasil->Fields("nama_pegawai");
$kode_spesialisasi = $hasil->Fields("kode_bagian");
$jabatan = $hasil->Fields("kode_jabatan");
$pajak = $hasil->Fields("id_dd_ptkp_pajak");
$foto_dokter = $hasil->Fields("url_foto_karyawan");
$status = $hasil->Fields("flag_tenaga_medis");

?>

<div id="FormEditVitalSign">

	<form id="idTambahDokter" method="POST" action="#"  enctype="multipart/form-data">

		<div id="content">
			<div class="modal-header register-modal-head" style="background-color:#2b345f">
				<h5 class="modal-title" style="color:white"><b>Edit Karyawan</b></h5>
				<button type="button" class="close" style="color:white" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times" aria-hidden="true"></i>
				</button>
			</div>

			<div class="col-sm-12">
				<br>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">No. Induk</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control"  name="no_induk" value="<?=$no_induk?>" readonly>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">Nama Karyawan <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control"  name="nama_pegawai" value="<?= $nama_karyawan ?>">
					</div>
				</div>
				<br>

				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">Bagian<?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="kode_spesialisasi">
							<?  
							$sql_kelompok = "select * from mt_bagian";
							pilihan_list($sql_kelompok,"nama_bagian","kode_bagian","kode_bagian",$kode_spesialisasi);
							?>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">Jabatan<?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="jabatan">
							<?  
							$sql_jabatan = "select * from mt_jabatan";
							pilihan_list($sql_jabatan,"nama_jabatan","kode_jabatan","kode_jabatan",$jabatan);
							?>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">PTKP<?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="pajak">
							<?  
							$sql_pajak = "select * from dd_ptkp_pajak";
							pilihan_list($sql_pajak,"uraian","id_dd_ptkp_pajak","id_dd_ptkp_pajak",$pajak);
							?>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">Status</div>
					<div class="col-lg-8">
						<select class="form-control" name="status" id="status">
							<? if($status == "0"){?>
								<option value="0" selected>Non Kesehatan</option>
								<?}else{?>
									<option value="0">Non Kesehatan </option>
									<?}?>
							<? if($status == "1"){?>
								<option value="1" selected>Perawat </option>
								<?}else{?>
									<option value="1">Perawat </option>
								<?}?>
						<? if($status == "2"){?>
								<option value="2" selected>Bidan</option>
								<?}else{?>
									<option value="2">Bidan</option>
								<?}?>
						<? if($status == "3"){?>
								<option value="3" selected>Farmasi</option>
								<?}else{?>
									<option value="3">Farmasi</option>
								<?}?>
						<? if($status == "4"){?>
								<option value="4" selected>Tenaga Kesehatan Lainnya</option>
								<?}else{?>
									<option value="4">Tenaga Kesehatan Lainnya</option>
								<?}?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Upload Foto <?=mandatory();?></label>
							</div>
							<div class="col-lg-8">
								<input type="file" class="form-control"  id="upload_foto_dokter" name="upload_foto_dokter" value="<?=$upload_foto_dokter?>">
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4">

							</div>	
							<div class="col-lg-8" id="loadImage">
								<img src="<?=$foto_dokter?>" width="150" height="100">
							</div>
						</div>

						<input type="hidden" name="act" value="<?=$act?>">
						<input type="hidden" name="foto" value="<?=$upload_foto_dokter?>">
						<br>
						<div class="row">
							<div class="col-lg-12">
								<div class="card-footer" align="right">
									<button type="button" class="btn btn-danger font-weight-bolder font-size-sm" data-dismiss="modal">Kembali</button>
									<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="TambahDokter()">Submit</button>
								</div>
							</div>
						</div>




					</div>

				</div>
			</form>	
			<br>
		</div>



		<!-- ############################################################################################# -->
		<script type="text/javascript">
			function readFile() {

				if (this.files && this.files[0]) {

					var FR= new FileReader();

					FR.addEventListener("load", function(e) {
						$("#loadImage").html("<img src='"+e.target.result+"' width='150' height='100'>");
						$("#loadImage").append("<input type='hidden' value='"+e.target.result+"' name='upload_foto_dokter'>");
					}); 

					FR.readAsDataURL( this.files[0] );
				}

			}

			$("#idTambahDokter input[name=upload_foto_dokter]").change(readFile);

		</script>

		<script>
			function back(){
				$("#FormEditVitalSign").load("/00_admin/user_addcaripegawai.php");
			}
			function TambahDokter(){
				var dataform=$("#idTambahDokter").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/karyawan_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							Swal.fire("Success!","Data Berhasil ditambah!","success");
							$("#TableViewUserAdd").bootstrapTable('refresh');
							$('#BuatModal').modal('hide');
						}else{
							Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
						}
					},
					dataType: "json"
				});
			}
		</script>
