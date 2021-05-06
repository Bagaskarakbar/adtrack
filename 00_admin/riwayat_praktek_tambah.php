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
	
	if($id_mt_dokter_detail !=""){
		$sqlDetail=read_tabel("mt_dokter_detail","*","where id_mt_dokter_detail='$id_mt_dokter_detail'");
		while ($tplDokDet=$sqlDetail->FetchRow()) {
			$id_mt_dokter_detail	= $tplDokDet["id_mt_dokter_detail"];
			$no_izin_praktek		= $tplDokDet["no_izin_praktek"];
			$id_dc_propinsi			= $tplDokDet["id_dc_propinsi"];
			$id_dc_kota				= $tplDokDet["id_dc_kota"];
			$status_dr			= $tplDokDet["status_dokter"];
			$kode_bagian			= $tplDokDet["kode_bagian"];
			
		}
	}
	
			

?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Riwayat Praktek</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormDokDet" method="POST" action="#"  enctype="multipart/form-data">
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Bagian </label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="kode_bagian" id="kode_bagian">
							<option value="0">---Pilih Bagian---</option>
							<?
							$sqlBagian = "select * from mt_bagian";
							pilihan_list($sqlBagian, "nama_bagian", "kode_bagian", "kode_bagian",$kode_bagian);
							?>
						</select>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nomer Izin Praktek</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="no_izin_praktek" value="<?=$no_izin_praktek?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Provinsi</label>
					</div>
					<div class="col-lg-8">
						<!-- <input class="form-control" type="text" name="propinsi" value="" tabindex="7" /> -->
						<select class="form-control" name="id_dc_propinsi"  id="id_dc_propinsi" tabindex="7" onchange="ambilPropinsi()" required>
							<option value="0">-- pilih Provinsi --</option>
							<?
							$getPropinsi="SELECT * FROM dc_propinsi";
							pilihan_list($getPropinsi,"nama_propinsi","id_dc_propinsi","id_dc_propinsi",$id_dc_propinsi);
							?>
						</select>
					</div>
			</div>
			<script>
			function ambilPropinsi(){
				var id_dc_propinsi=$('#id_dc_propinsi').val();
				$('#id_dc_kota').load('../01_registrasi/ajax_cari_kota.php',{id_dc_propinsi:id_dc_propinsi});
			}
			</script>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kota </label>
					</div>
					<div class="col-lg-8" id="id_dc_kota">
						<!-- <input class="form-control" type="text" name="kota" value="" tabindex="8" /> -->
						<select class="form-control" tabindex="8" name="kota" id="kota" required>
							<option value="0">-- pilih Kota --</option>
							<?
							$getKota="SELECT * FROM dc_kota where id_dc_propinsi='$id_dc_propinsi'";
							pilihan_list($getKota,"nama_kota","id_dc_kota","id_dc_kota",$id_dc_kota);
							?>
						</select>
					</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-4 text-right">
					<label for="exampleSelect1">Status</label>
				</div>
				<div class="col-lg-8">
					<select class="form-control" name="status_dr">
						<option value="">-- Pilih Status --</option>
						<option value="3" <?=$status_dr=="3" ? "selected" : ""?>>Spesialis</option>
						<option value="4" <?=$status_dr=="4" ? "selected" : ""?>>Sub Spesialis</option>
						<option value="5" <?=$status_dr=="5" ? "selected" : ""?>>Umum</option>
						<option value="2" <?=$status_dr=="2" ? "selected" : ""?>>Professor</option>
						<option value="6" <?=$status_dr=="6" ? "selected" : ""?>>Terapis</option>
						
					</select> 
				</div>
			</div>
			<br>
		<input type="hidden" class="form-control" name="kode_dokter" value="<?=$kode_dokter?>">
		<input type="hidden" class="form-control" name="id_mt_dokter_detail" value="<?=$id_mt_dokter_detail?>">
		<?if($id_mt_dokter_detail==""){?>
			<input type="hidden" class="form-control" name="act" value="add"> 
		<?}else{?>
			<input type="hidden" class="form-control" name="act" value="edit"> 
		<?}?>
		</form>
		</div>
		 <div class="modal-footer">
			<?if($id_mt_dokter_detail==""){?>
				<button type="button" class="btn btn-success" onclick="AddEditDokDet()">Save</button>
				
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="AddEditDokDet()">Edit</button>
				  
			<?}?>
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	</div>
</div>
<script>
function AddEditDokDet(a){
		Swal.fire({
        title: "Simpan Riwayat Praktek Dokter ?",
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
				var dataform=$("#FormDokDet").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/riwayat_praktek_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiPraktek").modal('hide');
							$('.modal-backdrop').remove();
							$('#idRiwayatPraktek').load("../00_admin/riwayat_praktek.php",{kode_dokter:<?=$kode_dokter?>});
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