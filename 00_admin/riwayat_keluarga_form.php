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

	if($kode_dokter !=""){
		$sql=read_tabel("mt_karyawan","*","where kode_dokter='$kode_dokter'");
		while ($tampil=$sql->FetchRow()) {
			$nama_pegawai		= $tampil["nama_pegawai"];
			$kode_spesialisasi	= $tampil["kode_spesialisasi"];
			$url_foto_karyawan	= $tampil["url_foto_karyawan"];
			
		}
				
		$nama_spesialisasi=baca_tabel("mt_spesialisasi_dokter","nama_spesialisasi"," where kode_spesialisasi=$kode_spesialisasi");

	}else{
				$nama_pegawai="Administrator";
				$nama_spesialisasi="-";
		
	}
	
	if($id!=""){
		$sql=read_tabel("mt_riwayat_dokter","*","where id_mt_riwayat_dokter='$id'");
		while ($tampil=$sql->FetchRow()) {
			$id_mt_riwayat_dokter 		= $tampil["id_mt_riwayat_dokter"];
			$nama_keluarga 				= $tampil["nama_keluarga"];
			$tgl_lahir 					= $tampil["tgl_lahir"];
			$status_keluarga 			= $tampil["status_keluarga"];
			$kode_dokter 				= $tampil["kode_dokter"];
			
		}
	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Riwayat Keluarga</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormKeluarga" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Keluarga</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_keluarga" id="nama_keluarga" value="<?=$nama_keluarga?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Tanggal Lahir</label>
					</div>
					<div class="col-lg-6">
						<input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?=$tgl_lahir?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Status Keluarga</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="status_keluarga" id="status_keluarga" value="<?=$status_keluarga?>"> 
					</div>
			</div>
			<input type="hidden" class="form-control" name="kode" value="<?=$kode_dokter?>"> 
			
			<input type="hidden" class="form-control" name="id_mt_riwayat_dokter" value="<?=$id?>"> 
			
			<?if($id==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id==""){?>
				<button type="button" class="btn btn-success" onclick="CekKeluarga()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekKeluarga()">Edit</button>
			<?}?>
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	</form>
</div>
<script type="text/javascript">
	
	function CekKeluarga(a){
		Swal.fire({
        title: "Simpan Data Keluarga Dokter ?",
        text: "<?=$nama_pegawai?>, apakah data yang di pilih sudah benar ?",
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
				var dataform=$("#FormKeluarga").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/riwayat_keluarga_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiKeluarga").modal('hide');
							$('.modal-backdrop').hide();
							$('#kt_tab_pane').load("../00_admin/riwayat_keluarga.php",{kode_dokter:<?=$kode_dokter?>});
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