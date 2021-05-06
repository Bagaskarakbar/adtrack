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

	
	if ($id_dc_suku) {

		$sql = "SELECT * FROM dc_suku where id_dc_suku=$id_dc_suku";

		$hasil =& $db->Execute($sql);

		$suku = $hasil->Fields('suku');

	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Suku</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormSuku" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Suku</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_suku" id="suku" value="<?=$suku?>"> 
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_dc_suku" value="<?=$id_dc_suku?>"> 

			<?if($id_dc_suku==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_dc_suku==""){?>
				<button type="button" class="btn btn-success" onclick="CekSuku()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekSuku()">Edit</button>
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
	function CekSuku(){
		Swal.fire({
        title: "Simpan Data Suku ?",
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
				var dataform=$("#FormSuku").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/suku_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiSuku").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/suku.php");
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