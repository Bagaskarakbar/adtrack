<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
//$db->debug=true;

if ($id_dd_user) {

	$judul="Edit";
	$aksi="edit";
	$rubah="Rubah ";
	$sql = "SELECT * FROM user_karyawan_v WHERE id_dd_user=$id_dd_user";

	$hasil =& $db->Execute($sql);

	$id_dd_user = $hasil->Fields('id_dd_user');
	$no_induk = $hasil->Fields('no_induk');
	$nama_pegawai = $hasil->Fields('nama_pegawai');
	$nama_bagian = $hasil->Fields('nama_bagian');
	$username = $hasil->Fields('username');
	$password = $hasil->Fields('password');
	$id_dd_user_group = $hasil->Fields('id_dd_user_group');
	$status = $hasil->Fields('status');
	$ko_wil = $hasil->Fields('ko_wil');
	$kode_dokter = $hasil->Fields('kode_dokter');
	

}else{

	$judul="Tambah";
	$aksi="add";

	//$sql = "SELECT mt_karyawan.*,mt_bagian.nama_bagian FROM mt_karyawan,mt_bagian WHERE mt_karyawan.no_induk=$no_induk AND mt_karyawan.kode_bagian=mt_bagian.kode_bagian";

	$sql = "SELECT k.*,b.nama_bagian FROM mt_karyawan as k LEFT JOIN mt_bagian as b ON k.kode_bagian=b.kode_bagian WHERE k.no_induk='$no_induk' 	ORDER BY	nama_pegawai";

	$hasil =& $db->Execute($sql);

	$no_induk = $hasil->Fields('no_induk');
	$nama_pegawai = $hasil->Fields('nama_pegawai');
	$nama_bagian = $hasil->Fields('nama_bagian');
	$kode_dokter = $hasil->Fields('kode_dokter');
	$id_mt_karyawan = $hasil->Fields('id_mt_karyawan');
}
if($kode_dokter!="" && $kode_dokter!=" "){

			$kode_spesialisasi=baca_tabel("mt_karyawan","kode_spesialisasi"," where kode_dokter='".$kode_dokter."'" );
			if($kode_spesialisasi!=""){
				$nama_bagian =baca_tabel("mt_spesialisasi_dokter","nama_spesialisasi"," where kode_spesialisasi=".$kode_spesialisasi );
			}
}
?>

	<div id="isiUtama">
		<div class="modal-header register-modal-head" style="background-color:#d82550">
			<h5 class="modal-title" style="color:white">Tambah User</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card-body" id="tab_frame">
		<form name="xxx" id="FormUserAddEdit" method="post" action="user_act.php?act=<?= $aksi?>">
		<table cellpadding="0" cellspacing="0" class="formInput" <? if(!$id_dd_user){ ?>style="width:400px; height:250px;"<? } ?>>
		<tr>
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kiri">
				
				
				<div class="form-group row fv-plugins-icon-container">
				
					<label class="col-xl-4 col-lg-4 col-form-label">Nama Pegawai</label>
					<div class="col-lg-8 col-xl-8"><label ><?= $nama_pegawai ?></label></div>
				</div>
				<div class="form-group row fv-plugins-icon-container">
					<label class="col-xl-4 col-lg-4 col-form-label">Bagian</label>
					<div class="col-lg-8 col-xl-8"><label ><?= $nama_bagian ?></label></div>
				</div>
				<div class="form-group row fv-plugins-icon-container">
					<label class="col-xl-4 col-lg-4 col-form-label">User ID</label>
					<div class="col-lg-8 col-xl-8">
						<input type="text"  class="form-control "  name="username" value="<?= $username ?>">
					</div>
				</div>
				<div class="form-group row fv-plugins-icon-container">
					<label class="col-xl-4 col-lg-4 col-form-label"><?= $rubah ?>Password</label>
					<div class="col-lg-8 col-xl-8">
						<input type="password"  class="form-control"  name="password" value="<?= $password ?>">
					</div>
				</div>
				<div class="form-group row fv-plugins-icon-container">
					<label class="col-xl-4 col-lg-4 col-form-label">Group User</label>
					<div class="col-lg-8 col-xl-8">
						<select name="id_dd_user_group"  class="form-control"  style="width:200px">
							<option value="">-- Pilih Group User --</option>
							<?
							$sql_kategori="SELECT id_dd_user_group,nama_group FROM dd_user_group ";
							pilihan_list($sql_kategori,"nama_group","id_dd_user_group","id_dd_user_group",$id_dd_user_group);
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group row fv-plugins-icon-container">
					<label class="col-xl-4 col-lg-4 col-form-label">Status Aktif</label>
					<div class="col-lg-8 col-xl-8">
							<div class="checkbox-inline">
								<label class="radio">
									<input type="radio" name="status" value="0" <? if($status=="0") echo("checked"); ?>>Aktif
								<span></span></label>
								<label class="radio">
									<input type="radio" name="status" value="1"<? if($status=="1") echo("checked"); ?>>Non Aktif
								<span></span></label>
								
							</div>
					</div>
				</div>
				
			</td>
			<!-- --------------------------------------------------------------------------------- -->
		</tr>
		</table>
		<input type="hidden" name="no_induk" value="<?=$no_induk?>">
		<input type="hidden" name="id_dd_user" value="<?=$id_dd_user?>">
		<input type="hidden" name="kode_dokter" value="<?=$kode_dokter?>">
		<input type="hidden" name="id_mt_karyawan" value="<?=$id_mt_karyawan?>">
		<input type="hidden" name="act" value="<?=$aksi?>">
		<div class="formInputSubmitMulti">
			<div class="modal-footer">
		<? if($id_dd_user){ ?>
		<div class="formInputSubmit">
			<input type="button" value="Edit" name="submit" onclick="tambah_user_add_edit()" class="btn btn-success">
			<input type="reset" value="Close" class="btn btn-danger" data-dismiss="modal">
		</div>
		<? }else{ ?>
		<div class="formInputSubmitMulti">
			
			<input type="button" value="Selesai" name="submit" onclick="tambah_user_add_edit()" class="btn btn-success">&nbsp;
			<input type="reset" value="Close" class="btn btn-danger" data-dismiss="modal">
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
			  url: '/00_admin/user_act.php',
			  data: dataform,
			  success: function(data){
				  if(data.code=='200'){
						alert('Sukses');
						$("#TableView").bootstrapTable('refresh');
						$('#BuatModal').modal('hide');		
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});

		}
	</script>
