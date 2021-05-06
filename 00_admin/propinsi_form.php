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

	
	if ($id_dc_propinsi) {

		$sql = "SELECT * FROM dc_propinsi where id_dc_propinsi=$id_dc_propinsi";

		$hasil =& $db->Execute($sql);

		$nama_propinsi = $hasil->Fields('nama_propinsi');
		$inisial_propinsi = $hasil->Fields('inisial_propinsi');

	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Propinsi</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormPropinsi" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Propinsi</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_propinsi" id="nama_propinsi" value="<?=$nama_propinsi?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Inisial Propinsi</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="inisial_propinsi" id="inisial_propinsi" value="<?=$inisial_propinsi?>"> 
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_dc_propinsi" value="<?=$id_dc_propinsi?>"> 

			<?if($id_dc_propinsi==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_dc_propinsi==""){?>
				<button type="button" class="btn btn-success" onclick="CekPropinsi()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekPropinsi()">Edit</button>
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
	function CekPropinsi(){
		Swal.fire({
        title: "Simpan Data Propinsi ?",
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
				var dataform=$("#FormPropinsi").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/propinsi_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiPropinsi").modal('hide');
							$('.modal-backdrop').remove();
							$('#kt_tab_pokok').load("../00_admin/propinsi.php");
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