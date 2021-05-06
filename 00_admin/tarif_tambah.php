<?
session_start();
require_once("../_lib/function/db.php");

loadlib("function","variabel");
loadlib("function","function.olah_tabel");
loadlib("class","Paging");
loadlib("function","function.pilihan_list");
loadlib("function","uang");
loadlib("function","function.input_uang");
loadlib("function","function.submit_uang");


$aksi = "add";
$sql = "select nama_bagian,kode_bagian from mt_bagian";
$run_list_bagian = $db->Execute($sql);
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
		<h5 class="modal-title" style="color:white">Tambah Tarif Baru</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="card-body" id="tab_frame">
		<form id="FormUserAddEdit" method="post">
			<p aria-hidden="true" id="required-description">
				<span class="required">*</span>Wajib Diisi
			</p>
			
				<div class="row">
					<div class="col-lg-4 text-right">
					<label>Bagian <span class="required-icon">*</span></label>
					</div>
					<div class="col-lg-8">
						<select name="kode_bagian" class="form-control form-control-solid form-control-lg" onchange="cek_bagian()">
						<? 
							$getBagian="select nama_bagian,kode_bagian from mt_bagian";
							pilihan_list($getBagian,"nama_bagian","kode_bagian","kode_bagian");
						?>
						</select>
					</div>
				</div>
				<br>
				<script>
					function cek_bagian(){
						var pilih=$("select[name=kode_bagian]").val();
						$("#IdKodeTarif").load("/00_admin/get_kode_tarif.php",{kode_bagian:pilih});
					}
				</script>
				<?
				
				?>
				<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kode Tarif <span class="required-icon">*</span></label>
					</div>
					<div class="col-lg-8" id="IdKodeTarif">
						<input class="form-control" type="text" value="<?= $kode_tarif ?>" name="kode_tarif" tabindex="2" required="required" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Tarif <span class="required-icon">*</span></label>
					</div>
					<div class="col-lg-8">
						<input class="form-control" type="text" value="<?= $nama_tarif ?>" name="nama_tarif" tabindex="2" required="required" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4 text-right">
					<label>Pendapatan E-Klinik <span class="required-icon">*</span></label>
					</div>
					<div class="col-lg-8">
						<input class="form-control" type="text" name="pendapatan_rs" value="<?= uang($pendapatan_rs, true) ?>" <? input_uang("1") ?> tabindex="2" required="required" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4 text-right">
					<label>Bill Dokter <span class="required-icon">*</span></label>
					</div>
					<div class="col-lg-8">
						<input class="form-control" type="text" value="<?= uang($bill_dr1, true) ?>" <? input_uang("1") ?> name="bill_dr1" tabindex="2" required="required" />
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4 text-right">
					<label>Jenis Tindakan <span class="required-icon">*</span></label>
					</div>
					<div class="col-lg-8">
						<select name="jenis_tindakan" class="form-control form-control-solid form-control-lg">
						<? 
							$getTindakan="select * from mt_jenis_tindakan";
							pilihan_list($getTindakan,"nama_jenis_tindakan","jenis_tindakan","jenis_tindakan");
						?>
						</select>
					</div>
				</div>
				<br>
				
				<input type="hidden" name="act" value="<?=$aksi ?>">
				<div class="card-footer" style="float: right;">
					<button type="reset" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
					<input type="button" class="btn btn-success mr-2" value="Submit" onclick="tambah_tarif()"></button>
				</div>
			</form>
			<!-- <input type="reset" value="Batal" class="btn btn-warning font-weight-bold" data-dismiss="modal"> -->

		</div>
	</div>
	<!-- ========================================================================================= -->
	<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
	<script language="JavaScript" type="text/javascript">	
		function tambah_tarif(){
			var dataform=$("#FormUserAddEdit").serialize();
			$.ajax({
				type: "POST",
				url: '/00_admin/tarif_act.php',
				data: dataform,
				success: function(data){
					if(data.code=='200'){
						Swal.fire("Success !", "Data Berhasil Ditambah!", "success");
						$("#TableView").bootstrapTable('refresh');
						$('#BuatModal').modal('hide');
					}else{
						alert('Gagal');
					}
				},
				dataType: "json"
			});
		}
	</script>