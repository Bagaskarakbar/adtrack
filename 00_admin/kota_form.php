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

	
	if ($id_dc_kota) {

		$sql = "SELECT * FROM dc_kota where id_dc_kota=$id_dc_kota";

		$hasil =& $db->Execute($sql);

		$id_dc_propinsi = $hasil->Fields('id_dc_propinsi');
		$nama_kota = $hasil->Fields('nama_kota');
		$inisial_kota = $hasil->Fields('inisial_kota');

	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Kota</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormKota" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Propinsi</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="id_dc_propinsi" id="id_dc_propinsi">
						<option value="0">-- pilih propinsi --</option>
									<?  
										$sql_propinsi = "select * from dc_propinsi";
											pilihan_list($sql_propinsi,"nama_propinsi","id_dc_propinsi","id_dc_propinsi",$id_dc_propinsi);
								?>
						</select>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Kota</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_kota" id="nama_kota" value="<?=$nama_kota?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Inisial Kota</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="inisial_kota" id="inisial_kota" value="<?=$inisial_kota?>"> 
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_dc_kota" value="<?=$id_dc_kota?>"> 

			<?if($id_dc_kota==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_dc_kota==""){?>
				<button type="button" class="btn btn-success" onclick="CekKota()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekKota()">Edit</button>
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
	function CekKota(){
		Swal.fire({
        title: "Simpan Data Kota ?",
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
				var dataform=$("#FormKota").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/kota_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiKota").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/kota.php");
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