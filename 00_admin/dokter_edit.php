<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.max_kode_text");
	loadlib("function","function.mandatory");

 //$db->debug=true;

	$sql =" select * from mt_karyawan where id_mt_karyawan=$kode_dokter";

	$hasil =& $db->Execute($sql);

	$no_induk = $hasil->Fields('no_induk');
	$nama_pegawai = $hasil->Fields('nama_pegawai');
	$kode_spesialisasi = $hasil->Fields('kode_spesialisasi');
	$flag_tenaga_medis = $hasil->Fields('flag_tenaga_medis');
	$telp = $hasil->Fields('telp');
	$email = $hasil->Fields('email');
	$alamat = $hasil->Fields('alamat');
	$url_foto_karyawan = $hasil->Fields('url_foto_karyawan');

	




?>

<div id="FormEditVitalSign">
		
			<form id="EditVS" method="POST" action="#"  enctype="multipart/form-data">
			
			<div id="content">
					<div class="modal-header register-modal-head" style="background-color:#2b345f">
						<h5 class="modal-title" style="color:white"><b>Edit Pegawai</b></h5>
						<button type="button" class="btn btn-danger" style="color:white" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-times" aria-hidden="true"></i>
					</button>
					</div>
		
			<div class="col-sm-12">
				<br>
					<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Nama Pegawai;<?=mandatory();?></label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control"  name="nama_pegawai" value="<?= $nama_pegawai ?>">
							</div>
					</div>
						
						
						<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Upload Foto <?=mandatory();?></label>
							</div>
							<div class="col-lg-8">
								<input type="file" class="form-control"  name="upload_foto_dokter" value="<?=$upload_foto_dokter?>">
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col-lg-4">
								
							</div>	
							<div class="col-lg-8" id="loadImage">
									<img src="<?=$url_foto_karyawan?>" width="150" height="100"/>	
							</div>
							
						</div>
						
						
						<input type="hidden" class="form-control"  name="kode_dokter" value="<?=$kode_dokter ?>">
						
					<div class="row">
						<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="EditDokter()">Submit</button>
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
	
	$("#EditVS input[name=upload_foto_dokter]").change(readFile);
  </script>

<script>

	
	function EditDokter()
				{
					var nama_pegawai;
					var upload_foto_dokter;
				
					

					
					nama_pegawai				=$("input[name=nama_pegawai]").val();
					upload_foto_dokter			=$("input[name=upload_foto_dokter]").val();


					if(nama_pegawai=="")
					{
						alert("Nama Dokter Belum di Isi!");
						$("input[name=nama_pegawai]").focus();
					}
					else{
						var x=confirm("Yakin data yang anda isi sudah benar?");
						if(x)
						{
							var datastring = $("#EditVS").serialize();
							$.ajax({
								type: "POST",
								url: "../00_admin/dokter_edit_act.php",
								data: datastring,
								success: function(data) {
									if(data.code=='200')
									{
										alert("Edit Dokter Berhasil !");
										$("#ModalEdit").modal('hide');
										$(".modal-backdrop").remove();
										$("#iddetailDokter").load("../00_admin/data_dasar_dr.php");
									}else{
										alert("Gagal Mengedit, Coba Lagi!");
									}
								},
								dataType:"json"
							});
						}

					}
				}	
	
	
	
</script>
