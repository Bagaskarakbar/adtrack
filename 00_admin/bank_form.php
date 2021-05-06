<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","function.pilihan_list");
	loadlib("function","function.olah_tabel");
	loadlib("function","variabel");
	
	//$db->debug=true;
	//$kode_dokter=$loginInfo["kode_dokter"];


	$dNow=date("d");
	$mNow=date("m");
	$yNow=date("Y");

	
	if ($id_dd_bank) {

		$judul="Edit";
		$aksi="edit";
		$sql = "SELECT * FROM dd_bank where id_dd_bank=$id_dd_bank";

		$hasil =& $db->Execute($sql);

		$nama_bank = $hasil->Fields('nama_bank');
		$nama_bank_sink = $hasil->Fields('nama_bank_sink');
		$no_rekening = $hasil->Fields('no_rekening');
		$alamat = $hasil->Fields('alamat');
		$kota = $hasil->Fields('kota');

	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Bank</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormBank" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Bank</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_bank" id="nama_bank" value="<?=$nama_bank?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Bank Singkatan</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_bank_sink" id="nama_bank_sink" value="<?=$nama_bank_sink?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>No Rekening</label>
					</div>
					<div class="col-lg-6">
						<input type="text" class="form-control" name="no_rekening" id="no_rekening" value="<?=$no_rekening?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Alamat</label>
					</div>
					<div class="col-lg-8">
						<textarea type="text" class="form-control" name="alamat" id="alamat"><?=$alamat?></textarea>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kota</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="kota" id="kota" value="<?=$kota?>"> 
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_dd_bank" value="<?=$id_dd_bank?>"> 

			<?if($id_dd_bank==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_dd_bank==""){?>
				<button type="button" class="btn btn-success" onclick="CekBank()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekBank()">Edit</button>
			<?}?>
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	</form>
<script>

function cekAlert(){
	alert("test");
}

</script>
</div>
<script>
	function CekBank(){
		Swal.fire({
        title: "Simpan Data Bank ?",
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
				var dataform=$("#FormBank").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/bank_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiBank").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/bank.php");
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