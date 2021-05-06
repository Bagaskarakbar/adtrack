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
		$sql=read_tabel("mt_jabatan_dokter","*","where id_mt_jabatan_dokter='$id'");
		while ($tampil=$sql->FetchRow()) {
			$id_mt_jabatan_dokter 		= $tampil["id_mt_jabatan_dokter"];
			$instansi	 				= $tampil["instansi"];
			$tahun	 					= $tampil["tahun_jabatan"];
			$status_keluarga 			= $tampil["status_keluarga"];
			$kode_dokter 				= $tampil["kode_dokter"];
			$kode_spesialisasi 			= $tampil["kode_spesialisasi"];
			
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
		<form id="FormJabatan" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Instansi</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="instansi" id="nama_keluarga" value="<?=$instansi?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Spesialisasi</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="kode_spesialisasi" id="kode_spesialisasi" >
							<option value="0">-- pilih spesialisasi --</option>
								<?
								$getSpesialisasi="SELECT * FROM mt_spesialisasi_dokter";
								pilihan_list($getSpesialisasi,"nama_spesialisasi","kode_spesialisasi","kode_spesialisasi",$kode_spesialisasi);
								?>
							</select>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Tahun Jabatan</label>
					</div>
					<div class="col-lg-4">
						<div class="input-group">
						<input class="form-control py-2 border-right-0 border" name="tahun_jabatan" placeholder="yyyy" value="<?=$tahun?>" id="example-year-input" onChange="pilihPencarian()">
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
			
			<input type="hidden" class="form-control" name="id_mt_jabatan_dokter" value="<?=$id?>"> 
			
			<?if($id==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id==""){?>
				<button type="button" class="btn btn-success" onclick="CekJabatan()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekJabatan()">Edit</button>
			<?}?>
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	</form>
</div>
<script type="text/javascript">
	
	function CekJabatan(a){
		Swal.fire({
        title: "Simpan Data Jabatan Dokter ?",
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
				var dataform=$("#FormJabatan").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/riwayat_jabatan_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiJabatan").modal('hide');
							$('.modal-backdrop').hide();
							$('#kt_tab_pane').load("../00_admin/riwayat_jabatan.php",{kode_dokter:<?=$kode_dokter?>});
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