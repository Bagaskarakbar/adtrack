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
		$sql=read_tabel("mt_perjanjian_dokter","*","where id_mt_perjanjian_dokter='$id'");
		while ($tampil=$sql->FetchRow()) {
			$id_mt_perjanjian_dokter 	= $tampil["id_mt_perjanjian_dokter"];
			$nomer_str	 				= $tampil["nomer_str"];
			$nomer_kontrak	 			= $tampil["nomer_kontrak"];
			$massa_berlaku 				= $tampil["massa_berlaku"];
			$kode_dokter 				= $tampil["kode_dokter"];
			
		}
	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Riwayat Jabatan</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormPerjanjian" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nomer STR</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nomer_str" id="nomer_str" value="<?=$nomer_str?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nomer Kontrak</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nomer_kontrak" id="nomer_kontrak" value="<?=$nomer_kontrak?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Massa Berlaku</label>
					</div>
					<div class="col-lg-4">
						<div class="input-group">
						<input class="form-control py-2 border-right-0 border" name="massa_berlaku" placeholder="yyyy" value="<?=$massa_berlaku?>" id="example-year-input" onChange="pilihPencarian()">
							<span class="input-group-append">
							  <button class="btn btn-outline-secondary border-left-0 border" type="button" >
									<i class="fa fa-calendar "></i>
							  </button>
							</span>
						</div>
					</div>
			</div>
			<script>
			$("#example-year-input").datepicker( {
					format: "yyyy",
					viewMode: "years", 
					minViewMode: "years"
				});
			</script>
			
			<input type="hidden" class="form-control" name="kode" value="<?=$kode_dokter?>"> 
			
			<input type="hidden" class="form-control" name="id_mt_perjanjian_dokter" value="<?=$id?>"> 
			
			<?if($id==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id==""){?>
				<button type="button" class="btn btn-success" onclick="CekPerjanjian()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekPerjanjian()">Edit</button>
			<?}?>
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	</form>
</div>
<script type="text/javascript">
	
	function CekPerjanjian(a){
		Swal.fire({
        title: "Simpan Data Perjanjian Dokter ?",
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
				var dataform=$("#FormPerjanjian").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/perjanjian_dokter_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiPerjanjian").modal('hide');
							$('.modal-backdrop').hide();
							$('#kt_tab_pane').load("../00_admin/perjanjian_dokter.php",{kode_dokter:<?=$kode_dokter?>});
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