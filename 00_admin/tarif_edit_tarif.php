<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
loadlib("function","uang");
loadlib("function","function.input_uang");
loadlib("function","function.submit_uang");
//$db->debug=true;

if ($kode_tarif) {
	$sql = "SELECT * FROM mt_master_tarif join mt_bagian on mt_master_tarif.kode_bagian = mt_bagian.kode_bagian WHERE kode_tarif = $kode_tarif";
	$hasil = $db->execute($sql);
	$kode_tarif = $hasil->Fields('kode_tarif');
	$nama_tarif = $hasil->Fields('nama_tarif');
	$bagian = $hasil->Fields('nama_bagian');
	$klinik = $hasil->Fields('pendapatan_rs');
	$dokter = $hasil->Fields('bill_dr1');
	$aksi = "edit";
}

?>

<div id="isiUtama">
	<div class="modal-header register-modal-head" style="background-color:#2ca4d7">
		<h5 class="modal-title" style="color:white">Edit Tarif</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="card-body" id="tab_frame">
		<form name="xxx" id="FormUserAddEdit" method="post" action="tarif_act.php?act=<?= $aksi?>">
			<table cellpadding="0" cellspacing="0" class="formInput" <? if(!$id_dd_user){ ?>style="width:400px; height:250px;"<? } ?>>
				<tr>
					<!-- --------------------------------------------------------------------------------- -->
					<td class="kiri">
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Bagian</label>
							<div class="col-lg-9 col-xl-9"><label><?=$bagian?></label></div>
						</div>
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Tarif</label>
							<div class="col-lg-9 col-xl-9"><input type="text"  class="form-control form-control-solid form-control-lg"  name="nama_tarif" value="<?= $nama_tarif ?>"></div>
						</div>
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Klinik</label>
							<div class="col-lg-9 col-xl-9">
								<input type="text"  class="form-control form-control-solid form-control-lg"  name="pendapatan_rs" value="<?= uang($klinik, true) ?>" <? input_uang("1") ?>>
							</div>
						</div>
						<div class="form-group row fv-plugins-icon-container">
							<label class="col-xl-3 col-lg-3 col-form-label">Dokter</label>
							<div class="col-lg-9 col-xl-9">
								<input type="text"  class="form-control form-control-solid form-control-lg"  name="dokter" value="<?= uang($dokter, true) ?>" <? input_uang("1") ?>>
							</div>
						</div>
						<input type="hidden" name="kode_tarif" value="<?=$kode_tarif?>">
						<input type="hidden" name="act" value="<?=$aksi?>">
					</td>
					<!-- --------------------------------------------------------------------------------- -->
				</tr>
			</table>
			<div class="formInputSubmitMulti">
				<div class="modal-footer">
					<? if($id_dd_user){ ?>
						<div class="formInputSubmit">
							<input type="button" value="Edit" name="submit" onclick="tambah_user_add_edit()" class="btn btn-primary font-weight-bold">
							<input type="reset" value="Batal" class="btn btn-warning font-weight-bold" data-dismiss="modal">
						</div>
					<? }else{ ?>
						<div class="formInputSubmitMulti">

							<input type="button" value="Selesai" name="submit" onclick="tambah_user_add_edit()" class="btn btn-primary font-weight-bold">&nbsp;
							<input type="reset" value="Batal" class="btn btn-warning font-weight-bold" data-dismiss="modal">
						</div>
					<? } ?>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	function tambah_user_add_edit(){
		var dataform=$("#FormUserAddEdit").serialize();
		$.ajax({
			type: "POST",
			url: '/00_admin/tarif_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
					Swal.fire("Success !", "Data Berhasil diubah!", "success");
					$("#TableView").bootstrapTable('refresh');
					$('#BuatModal').modal('hide');
				}else{
					Swal.fire("Gagal !", "Terjadi Kesalahan!", "warning");
				}
			},
			dataType: "json"
		});

	}
</script>
