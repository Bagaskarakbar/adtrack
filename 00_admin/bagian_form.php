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

	
	if ($id_mt_bagian) {

		$sql = "SELECT * FROM mt_bagian where id_mt_bagian=$id_mt_bagian";

		$hasil =& $db->Execute($sql);

		$id_mt_bagian	= $hasil->Fields('id_mt_bagian');
		$nama_bagian	= $hasil->Fields('nama_bagian');
		$kode_bagian	= $hasil->Fields('kode_bagian');
		$group_bag		= $hasil->Fields('group_bag');
		$nama_validasi	= $hasil->Fields('validasi');
		$status_aktif	= $hasil->Fields('status_aktif');
		$kode_rs		= $hasil->Fields('kode_rs');
		$pelayanan		= $hasil->Fields('pelayanan');
	}
?>
<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title">Form Bagian Hi Sehat</h3>
		<button type="button" class="close" style="color:black" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="col-sm-12">
		<form id="FormBagian" method="POST" action="#"  enctype="multipart/form-data">
			
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Nama Bagian</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="nama_bagian" id="nama_bagian" value="<?=$nama_bagian?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kode Bagian</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" name="kode_bagian" id="kode_bagian" value="<?=$kode_bagian?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Validasi</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="nama_validasi" id="nama_validasi" value="<?=$nama_validasi?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Kode RS</label>
					</div>
					<div class="col-lg-5">
						<input type="text" class="form-control" name="kode_rs" id="kode_rs" value="<?=$kode_rs?>"> 
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Group Bagian</label>
					</div>
					<div class="col-lg-8">
						<div class="radio-unline">
						<label class="radio radio-outline radio-outline-2x radio-primary">
						<input type="radio" name="group_bag" value="Group" <? if($group_bag=="Group") echo("checked"); ?>/>Group
						<span></span></label>
						<label class="radio radio-outline radio-outline-2x radio-primary">
						<input type="radio" name="group_bag" value="Detail" <? if($group_bag=="Detail") echo("checked"); ?>/>Detail
						<span></span></label>
						
						
						</div>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Status Aktif</label>
					</div>
					<div class="col-lg-8">
						<div class="radio-unline">
						<label class="radio radio-outline radio-outline-2x radio-primary">
						<input type="radio" name="status_aktif" value="1" <? if($status_aktif=="1") echo("checked"); ?>/>Aktif
						<span></span></label>
						<label class="radio radio-outline radio-outline-2x radio-primary">
						<input type="radio" name="status_aktif" value="0"<? if($status_aktif=="0") echo("checked"); ?>>Non Aktif
						<span></span></label>
						</div>
					</div>
			</div>
			<br>
			<div class="row">
					<div class="col-lg-4 text-right">
					<label>Bagian Pelayanan</label>
					</div>
					<div class="col-lg-8">
						<div class="radio-unline">
						<label class="radio radio-outline radio-outline-2x radio-primary">
						<input type="radio" name="pelayanan" value="1" <? if($pelayanan=="1") echo("checked"); ?>>Ya
						<span></span></label>
						<label class="radio radio-outline radio-outline-2x radio-primary">
						<input type="radio" name="pelayanan" value="0" <? if($pelayanan=="0") echo("checked"); ?>>Tidak
						<span></span></label>
						</div>
					</div>
			</div>
			<br>
			
			<input type="hidden" class="form-control" name="id_mt_bagian" value="<?=$id_mt_bagian?>"> 

			<?if($id_mt_bagian==""){?>
			<input type="hidden" class="form-control" name="validasi" value="1"> 
			<?}else{?>
			<input type="hidden" class="form-control" name="validasi" value="2"> 
			<?}?>
			
		</div>
	</div>
	
	 <div class="modal-footer">
			<?if($id_mt_bagian==""){?>
				<button type="button" class="btn btn-success" onclick="CekBagian()">Save</button>
			<?}else{?>
				  <button type="button" class="btn btn-primary" onclick="CekBagian()">Edit</button>
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
	function CekBagian(){
		Swal.fire({
        title: "Simpan Data Bagian ?",
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
				var dataform=$("#FormBagian").serialize();
				$.ajax({
					type: "POST",
					url: '/00_admin/bagian_form_act.php',
					data: dataform,
					success: function(data){
						if(data.code=='200'){
							$("#ModalIsiBagian").modal('hide');
							$('.modal-backdrop').remove();
							$('#idBagian').load("../00_admin/rs_tab.php");
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