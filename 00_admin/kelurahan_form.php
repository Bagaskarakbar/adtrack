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

	
	if ($id_dc_kelurahan) {

		$sql = "SELECT * FROM dc_kelurahan where id_dc_kelurahan=$id_dc_kelurahan";

		$hasil =& $db->Execute($sql);

		$id_dc_kecamatan = $hasil->Fields('id_dc_kecamatan');
		$nama_kelurahan = $hasil->Fields('nama_kelurahan');
		$inisial_kelurahan = $hasil->Fields('inisial_kelurahan');
		$kode_pos = $hasil->Fields('kode_pos');

	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Kelurahan</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormKelurahan" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kecamatan</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="id_dc_kecamatan" id="id_dc_kecamatan">
						<option value="0">-- pilih kecamatan --</option>
									<?  
										$sql_kec = "select * from dc_kecamatan";
											pilihan_list($sql_kec,"nama_kecamatan","id_dc_kecamatan","id_dc_kecamatan",$id_dc_kecamatan);
								?>
						</select>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Kelurahan</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_kelurahan" id="nama_kelurahan" value="<?=$nama_kelurahan?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Inisial Kelurahan</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="inisial_kelurahan" id="inisial_kelurahan" value="<?=$inisial_kelurahan?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kode Pos</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="kode_pos" id="kode_pos" value="<?=$kode_pos?>"> 
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_dc_kelurahan" value="<?=$id_dc_kelurahan?>"> 

			<?if($id_dc_kelurahan==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_dc_kelurahan==""){?>
				<button type="button" class="btn btn-success" onclick="CekKelurahan()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekKelurahan()">Edit</button>
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
	function CekKelurahan(){
		Swal.fire({
        title: "Simpan Data Kelurahan ?",
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
				var dataform=$("#FormKelurahan").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/kelurahan_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiKelurahan").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/kelurahan.php");
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