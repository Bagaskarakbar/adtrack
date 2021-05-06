<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.max_kode_text");

if ($kode_dokter) {

	$judul="Edit";
	$aksi="edit";
	$sql =
		"
		SELECT k.*, d.nama_spesialisasi
		FROM mt_karyawan k, mt_spesialisasi_dokter d
		WHERE (kode_dokter <> '')
			AND k.kode_spesialisasi=d.kode_spesialisasi
			AND k.kode_dokter=$kode_dokter
		";

	$hasil =& $db->Execute($sql);

	$no_induk = $hasil->Fields('no_induk');
	$nama_pegawai = $hasil->Fields('nama_pegawai');
	$status_dr = $hasil->Fields('status_dr');
	$status = $hasil->Fields('status');
	$no_mr = $hasil->Fields('no_mr');
	$kode_spesialisasi = $hasil->Fields('kode_spesialisasi');
	$kode_dokter = $hasil->Fields('kode_dokter');
	$flag_tenaga_medis = $hasil->Fields('flag_tenaga_medis');

}else{

	$judul="Tambah";
	$aksi="add";
	$no_induk_awal = max_kode_text("mt_karyawan","no_induk","");
}

?>
<html>

<head>
	<title><?= $judul?> Dokter</title>
	<? include("../_inc/tpl_incHtmlHead.php"); ?>
</head>

<body scroll="no">
	<div id="topLayer" class="loading"></div>

	<!-- ========================================================================================= -->
	<div id="isiUtama">

		<form name="xxx" method="post" action="dokter_act.php?act=<?= $aksi?>" enctype="multipart/form-data">
		<div class="modal-header register-modal-head" style="background-color:#2ca4d7">
			<h5 class="modal-title" style="color:white">Edit Dokter</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<table cellpadding="0" cellspacing="0" class="formInput">
		<tr>
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kiri">
				<table cellpadding="0" cellspacing="0" id="dokter">
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">Nama Dokter</label></td>
					<td class="input"><input  type="text" class="form-control form-control-solid form-control-lg" name="nama_pegawai" value="<?= $nama_pegawai ?>" /></td>
				</tr>
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">Spesialisasi</td>
					<td class="input">
						<select name="kode_spesialisasi"  class="form-control form-control-solid form-control-lg" style="width:180px;">
						<?  
						$sql_kelompok = "select * from mt_spesialisasi_dokter";
						pilihan_list($sql_kelompok,"nama_spesialisasi","kode_spesialisasi","kode_spesialisasi",$kode_spesialisasi);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">No. MR</label></td>
					<td class="input"><input style="width:180px;" type="text" class="form-control" name="no_mr" value="<?= $no_mr ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/></td>
				</tr>
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">Status </label></td>
					<td class="input">
						<select name="status_dr" class="form-control form-control-solid form-control-lg">
							
							<option value="3" <?=$status_dr=="3" ? "selected" : ""?>>Spesialis</option>
							<option value="4" <?=$status_dr=="4" ? "selected" : ""?>>Sub Spesialis</option>
							<option value="5" <?=$status_dr=="5" ? "selected" : ""?>>Umum</option>
							<option value="2" <?=$status_dr=="2" ? "selected" : ""?>>Professor</option>
							<option value="6" <?=$status_dr=="6" ? "selected" : ""?>>Terapis</option>
						</select>
						<!-- <input style="width:180px;" type="text" name="status_dr" value="<?= $status_dr ?>"/> -->
					</td>
				</tr>
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">Jenis Dokter</label></td>
					<td class="input">
						<select name="flag_tenaga_medis" class="form-control form-control-solid form-control-lg">
							<option value="1" <?=$flag_tenaga_medis=="1" ? "selected" : ""?>>Full Time</option>
							<option value="2" <?=$flag_tenaga_medis=="2" ? "selected" : ""?>>Part Time</option>
							<option value="3" <?=$flag_tenaga_medis=="3" ? "selected" : ""?>>Dokter Tamu</option>
						</select>
						<!-- <input style="width:180px;" type="text" name="status_dr" value="<?= $status_dr ?>"/> -->
					</td>
				</tr>
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">No. Induk</label></td>
					<td class="input">
						<input style="width:180px;" type="text" class="form-control form-control-solid form-control-lg" name="no_induk" value="<?=$kode_dokter=="" ? $no_induk_awal : $no_induk ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;
						<button class="btn btn-primary font-weight-bold" onclick="cekNoInduk()">Cek</button></td>
				</tr>
				<!-- <tr>
					<td class="field">Status</td>
					<td class="input">
						<input style="width:180px;" type="text" name="status_dr" value="<?= $status ?>"/>
					</td>
				</tr> -->
				<tr>
					<td class="field"><label class="col-xl-3 col-lg-3 col-form-label">Bagian</label></td>
					<td class="input">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top:1px;">
									<select name="kode_bagian" class="form-control form-control-solid form-control-lg" id="kodeBagian" size="5" style="width:180px;">
									<?
									//$db->debug=true;
									if($kode_dokter){
										$hasilbagian=read_tabel("mt_dokter_bagian d, mt_bagian b","nama_bagian,d.kode_bagian","WHERE d.kode_dokter=$kode_dokter AND d.kd_bagian=b.kode_bagian");
										while ($tampilbagian=$hasilbagian->FetchRow()) {
											$nama_bagian=$tampilbagian["nama_bagian"];
											$kode_bagian=$tampilbagian["kode_bagian"];
									?>
									<option value="<?= $kode_bagian ?>"><?= $nama_bagian ?></option>
									<?	}
									}
									?>
									</select>
								</td>
								<td style="padding-left:3px;">
									<a class="icon" href="#" align="top" title="Hapus" onclick="delItem()"><img src="/_images/icons/icokecil_kurang.gif"></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="field">&nbsp;</td>
					<td class="input">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top:1px;">
									<select name="xkode_bagian" class="form-control form-control-solid form-control-lg" id="xkodeBagian" style="width:180px;">
										<option>-- Tambah Bagian --</option>
										<?
										$sql_kategori="SELECT kode_bagian,nama_bagian FROM mt_bagian ORDER BY nama_bagian";
										pilihan_list($sql_kategori,"nama_bagian","kode_bagian","kode_bagian");
										?>
									</select>
								</td>
								<td style="padding-left:3px;">
									<a class="icon" href="#" title="Tambah" onclick="addItem()"><img src="/_images/icons/icokecil_tambah.gif"></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="field">&nbsp;</td>
					<td class="input">
						<input name="foto" class="form-control" type="file" size="20" value="<?=$foto?>">
					</td>
				</tr>
				</table>
			</td>
			<!-- --------------------------------------------------------------------------------- -->
		</tr>
		</table>
		<input type="hidden" name="kode_dokter" value="<?= $kode_dokter?>">
		<div class="modal-footer">
			<input type="submit" name="submit" value="Simpan" class="btn btn-primary font-weight-bold" <?= $inputDisabled?> >
			<input type="reset" value="Batal" class="btn btn-primary font-weight-bold" onclick="javascript:window.close();return false;" <?= $inputDisabled?> >
		</div>
		
		</form>

	</div>
	<!-- ========================================================================================= -->

<!-- ############################################################################################# -->
<script language="JavaScript" type="text/javascript">

function addItem(){
	var kBag = aGetElementById("kodeBagian");
	var xBag = aGetElementById("xkodeBagian");
	var xBagSel = $('#xkodeBagian').val();
	
	var adaVal = false

	$("#kodeBagian > option").each(function() {
    //alert(this.text + ' ' + this.value);
		if(this.value==xBagSel)adaVal = true
	});
	
	/*for (var i=0; i<kBag.options.length; i++) {
		if(kBag.options[i].value==xBagSel.value) adaVal = true
	}*/

	if(xBagSel && (!adaVal)){

		var valy=$('#xkodeBagian').val();
		var text=$('#xkodeBagian :selected').text();
		$('#kodeBagian').append($("<option></option>").val(valy).html(text));
		$('#kodeBagian').append("<INPUT TYPE='HIDDEN' NAME='kode_bagian_add[]' value='"+valy+"' >");
	}

	$('#xkodeBagian').val(0);

	for (var i=0; i<kBag.options.length; i++) {
		if(kBag.options[i].value==xBagSel.value) kBag.options[i].selected = true
	}
}

function delItem(){
	
	var kBag = aGetElementById("kodeBagian");
	var xBag = aGetElementById("xkodeBagian");
	
	if(kBag.value){
		
		$('#dokter tr:last').after("<tr><td><INPUT TYPE='hidden' NAME='kode_bagian_del[]' value='"+kBag.value+"' ></td></tr>");
		$("#kodeBagian option[value="+kBag.value+"]").remove();
		//var inputVal = aGetElementsByAttribute("INPUT", "VALUE", kBag.value)[0]

		/*if (inputVal) {
			kBag.removeChild(inputVal)
			kBag.remove(kBag.selectedIndex)
		}else{
			
			

			kBag.remove(kBag.selectedIndex)
		}*/
	}

}

function getData(obj) {
	if (obj.responseText!=xxx.no_induk.value){
		alert("No. Induk  " + xxx.no_induk.value + "  Belum Terpakai")
	}else{
		alert("No. Induk  " + xxx.no_induk.value + "  Sudah Terpakai")
	}

}


function cekNoInduk(){
		var url = "getIfInduk.php?no_induk=" + xxx.no_induk.value;
		retrieveData(url, "getData")
}

window.onload = function()
{
	initHalaman()
}

</script>
</body>

</html>