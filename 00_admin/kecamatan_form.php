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

	
	if ($id_dc_kecamatan) {

		$sql = "SELECT * FROM dc_kecamatan where id_dc_kecamatan=$id_dc_kecamatan";

		$hasil =& $db->Execute($sql);

		$id_dc_kecamatan = $hasil->Fields('id_dc_kecamatan');
		$id_dc_kota = $hasil->Fields('id_dc_kota');
		$nama_kecamatan = $hasil->Fields('nama_kecamatan');
		$inisial_kecamatan = $hasil->Fields('inisial_kecamatan');

	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Kecamatan</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormKecamatan" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kota</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="id_dc_kota" id="id_dc_kota">
						<option value="0">-- pilih kota --</option>
									<?  
										$sql_kota = "select * from dc_kota";
											pilihan_list($sql_kota,"nama_kota","id_dc_kota","id_dc_kota",$id_dc_kota);
								?>
						</select>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Kecamatan</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_kecamatan" id="nama_kecamatan" value="<?=$nama_kecamatan?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Inisial Kecamatan</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="inisial_kecamatan" id="inisial_kecamatan" value="<?=$inisial_kecamatan?>"> 
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_dc_kecamatan" value="<?=$id_dc_kecamatan?>"> 

			<?if($id_dc_kecamatan==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_dc_kecamatan==""){?>
				<button type="button" class="btn btn-success" onclick="CekKecamatan()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekKecamatan()">Edit</button>
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
	function CekKecamatan(){
		Swal.fire({
        title: "Simpan Data kecamatan ?",
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
				var dataform=$("#FormKecamatan").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/kecamatan_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiKecamatan").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/kecamatan.php");
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