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
//$db->debug=true;
$no_induk = max_kode_text("mt_karyawan","no_induk");
$act="tambah";

?>

<div id="FormEditVitalSign">

	<form id="idTambahKaryawan" method="POST" action="#"  enctype="multipart/form-data">

		<div id="content">
			<div class="modal-header register-modal-head" style="background-color:#d92550">
				<h5 class="modal-title" style="color:white"><b>Tambah Karyawan</b></h5>
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
						<input type="text" class="form-control"  name="nama_pegawai" value="<?= $nama_pegawai ?>">
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
							pilihan_list($sql_kelompok,"nama_bagian","kode_bagian","kode_bagian");
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
							pilihan_list($sql_jabatan,"nama_jabatan","kode_jabatan","kode_jabatan");
							?>
						</select>
					</div>
				</div>
				<br>
				<!--
				<div class="row">
					<div class="col-lg-4">Status</div>
					<div class="col-lg-8">
						<select class="form-control" name="status" id="status">
							<option value="0">Non Kesehatan </option>
							<option value="1">Perawat </option>
							<option value="2">Bidan</option>
							<option value="3">Farmasi</option>
							<option value="4">Tenaga Kesehatan Lainnya</option>
						</select>
					</div>
				</div>
				-->

				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">Upload Foto <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="file" class="form-control"  id="foto_karyawan" name="foto_karyawan" value="<?=$foto_karyawan?>">
					</div>
				</div> <br>
				<div class="row">
					<div class="col-lg-4">

					</div>	
					<div class="col-lg-8" id="loadImage">

					</div>
				</div>

				<input type="hidden" name="act" value="<?=$act?>">
				<br>
				<div class="row">
					<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="TambahDokter()">Submit</button>
							<button type="button" class="btn btn-danger font-weight-bolder font-size-sm" data-dismiss="modal">Close</button>
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
				$("#loadImage").append("<input type='hidden' value='"+e.target.result+"' name='foto_karyawan'>");
			}); 

			FR.readAsDataURL( this.files[0] );
		}

	}
	
	$("#idTambahKaryawan input[name=foto_karyawan]").change(readFile); 
</script>

<script>
	function TambahDokter(){
		var dataform=$("#idTambahKaryawan").serialize();
		$.ajax({
			type: "POST",
			url: '/00_admin/karyawan_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
					//Swal.fire("Success!","Data Berhasil ditambah!","success");
					$("#TableViewUserAdd").bootstrapTable('refresh');
					$('#BuatModal').modal('hide');
				}else{
					//Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
				}
			},
			dataType: "json"
		});
	}
</script>
