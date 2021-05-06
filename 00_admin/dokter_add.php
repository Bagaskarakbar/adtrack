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


?>

<div id="FormEditVitalSign">
		
			<form id="idTambahDokter" method="POST" action="#"  enctype="multipart/form-data">
			
			<div id="content">
					<div class="modal-header register-modal-head" style="background-color:#2b345f">
						<h5 class="modal-title" style="color:white"><b>Tambah Pegawai</b></h5>
						<button type="button" class="close" style="color:white" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-times" aria-hidden="true"></i>
					</button>
					</div>
		
			<div class="col-sm-12">
				<br>
					<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Nama Pegawai <?=mandatory();?></label>
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
								<input type="file" class="form-control"  id="upload_foto_dokter" name="upload_foto_dokter" value="<?=$upload_foto_dokter?>">
							</div>
						</div> <br>
						<div class="row">
							<div class="col-lg-4">
								
							</div>	
							<div class="col-lg-8" id="loadImage">
											
							</div>
						</div>
						
						
						
						
						<br>
					<div class="row">
						<div class="col-lg-12">
						<div class="card-footer" align="right">
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
	function ambilPropinsi(){
		var id_dc_propinsi=$('select[name=IdPropinsi]').val();
		$('#id_kota').load('../01_registrasi/ajax_cari_kota.php',{id_dc_propinsi:id_dc_propinsi});
	}
	
	function TambahDokter()
				{
					var nama_pegawai;
					var spesialisasi;
					var jenis_dokter;
					var status_dokter;
					var no_izin_praktek;	
					var id_dc_propinsi;
					var id_dc_kota;
					var telp;
					var email;
					var alamat;
					var upload_foto_dokter;
				
					

					
					nama_pegawai				=$("input[name=nama_pegawai]").val();
					spesialisasi				=$("select[name=spesialisasi]").val();
					jenis_dokter				=$("select[name=jenis_dokter]").val();
					status_dokter				=$("select[name=status_dokter]").val();
					no_izin_praktek				=$("input[name=no_izin_praktek]").val();
					id_dc_propinsi				=$("select[name=id_dc_propinsi]").val();
					id_dc_kota					=$("select[name=id_dc_kota]").val();
					telp						=$("input[name=telp]").val();
					email						=$("input[name=email]").val();
					alamat						=$("textarea[name=alamat]").val();
					upload_foto_dokter			=$("input[name=upload_foto_dokter]").val();


					if(nama_pegawai=="")
					{
						alert("Nama Dokter Belum di Isi!");
						$("input[name=nama_pegawai]").focus();
					}else{
						var x=confirm("Yakin data yang anda isi sudah benar?");
						if(x)
						{
							var datastring = $("#idTambahDokter").serialize();
							$.ajax({
								type: "POST",
								url: "../00_admin/dokter_add_act.php",
								data: datastring,
								success: function(data) {
									if(data.code=='200')
									{
										alert("Tambah Dokter Berhasil !");
										$("#ModalAdd").modal('hide');
										$("body").removeClass("modal-open");
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
