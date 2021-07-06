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
$id_dd_user=$_SESSION['logininfo']['id_dd_user'];
$username=$_SESSION['logininfo']['username'];

$id = $_POST['id'];
$act="tambah";

?>

<div id="Form">

	<form id="idTambahDelivery" method="POST" action="#"  enctype="multipart/form-data">

		<div id="content">
			<div class="modal-header register-modal-head" style="background-color:#d92550">
				<h5 class="modal-title" style="color:white"><b>Form Delivery</b></h5>
				<button type="button" class="close" style="color:white" aria-label="Close" onclick="Close(<?=$id?>)">
					<i class="fa fa-times" aria-hidden="true"></i>
				</button>
			</div>

			<div class="col-sm-12">
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label > User</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" value="<?= $username ?>" readonly>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label > Nama PM <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_pm"value="<?= $nama_pm ?>">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label > Mitra/Vendor <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="mitra_vendor" value="<?= $mitra_vendor ?>">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label > Link Domain <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="link_domain" value="<?= $link_domain ?>">
					</div>
				</div>
				<br>

				<div class="row">
					<div class="col-lg-4">
						<label >Keterangan</label>
					</div>
					<div class="col-lg-8">
						<textarea class="form-control"  name="keterangan"> <?= $keterangan ?></textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label >Tanggal <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="date" class="form-control"  name="tgl_input" value="<?= $tgl_input ?>">
					</div>
				</div>
				<br>
				<!--
				<div class="row">
					<div class="col-lg-4">
						<label >Upload Dokumen PO ke Mitra <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="file" class="form-control"  id="dokumen" name="dokumen" value="<?=$dokumen?>">
					</div>
				</div> <br>
				<div class="row">
					<div class="col-lg-4">

					</div>	
					<div class="col-lg-8" id="loadImage">

					</div>
				</div>-->

				<input type="hidden" name="id_dd_user" value="<?=$id_dd_user?>">
				<input type="hidden" name="id_tc_transaksi" value="<?=$idt?>">
				<input type="hidden" name="id_tc_pengajuan" value="<?=$id?>">
				<input type="hidden" name="act" value="<?=$act?>">
				<br>
				<div class="row">
					<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="AddDelivery()">Submit</button>
							<button type="button" class="btn btn-danger font-weight-bolder font-size-sm" onclick="Close(<?=$id?>)">Close</button>
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
				$("#loadImage").append("<input type='hidden' value='"+e.target.result+"' name='dokumen'>");
			}); 

			FR.readAsDataURL( this.files[0] );
		}

	}
	
	$("#idTambahDelivery input[name=dokumen]").change(readFile); 
</script>

<script>
	function AddDelivery(){
		var dataform=$("#idTambahDelivery").serialize();
		$.ajax({
			type: "POST",
			url: '/04_delivery/delivery_projek_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
					//Swal.fire("Success!","Data Berhasil ditambah!","success");
					 //Swal.fire({icon: 'success',title: 'Yayy...',text: 'Data berhasil dimasukan!!'});
					Close(<?=$id?>)
					$('#BuatModal').modal('hide');
				}else{
					//Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
					//Swal.fire({icon: 'error',title: 'Oops...',text: 'Data gagal dimasukan!!',footer: 'Note: Terjadi kesalahan saat memasukan data!!'});
				}
			},
			dataType: "json"
		});
	}
</script>
