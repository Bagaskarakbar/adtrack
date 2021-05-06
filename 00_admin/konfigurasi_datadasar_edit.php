<?
/*
Edit Author		: Puji Risdianto
Date			: 30/10/2012
Desc			: Pembuatan data dasar rumah sakit, untuk keperluan laporan RL dan Konfigurasi Sistem SIRS
*/
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.form");
	loadlib("function","function.datetime");

	$sql = "SELECT * FROM dd_konfigurasi";

	$hasil =& $db->Execute($sql);

	$id_dd_konfigurasi			= $hasil->Fields('id_dd_konfigurasi');
	$kode_rs					= $hasil->Fields('kode_rs');
	$nama_perusahaan			= $hasil->Fields('nama_perusahaan');
	$nama_singkat				= $hasil->Fields('nama_singkat');
	$nama_aplikasi				= $hasil->Fields('nama_aplikasi');
	$alamat						= $hasil->Fields('alamat');
	$kota						= $hasil->Fields('kota');
	$propinsi					= $hasil->Fields('propinsi');
	$kode_pos					= $hasil->Fields('kode_pos');
	$telpon						= $hasil->Fields('telpon');
	$fax						= $hasil->Fields('fax');
	$nama_pimpinan				= $hasil->Fields('nama_pimpinan');
	$kontak_person				= $hasil->Fields('kontak_person');
	$keterangan					= $hasil->Fields('keterangan');
	$logo						= $hasil->Fields('logo');
	$logo_small					= $hasil->Fields('logo_small');
	$html_title					= $hasil->Fields('html_title');
	$tgl_registrasi				= $hasil->Fields('tgl_registrasi');
	$jenis_rumah_sakit			= $hasil->Fields('jenis_rumah_sakit');
	$kelas_rumah_sakit			= $hasil->Fields('kelas_rumah_sakit');
	$penyelenggara_rumah_sakit	= $hasil->Fields('penyelenggara_rumah_sakit');
	$notelp_humas				= $hasil->Fields('notelp_humas');
	$website					= $hasil->Fields('website');
	$luas_tanah					= $hasil->Fields('luas_tanah');
	$luas_bangunan				= $hasil->Fields('luas_bangunan');
	$surat_izin					= $hasil->Fields('surat_izin');
	$nomor_izin					= $hasil->Fields('nomor_izin');
	$tanggal_izin				= $hasil->Fields('tanggal_izin');
	$oleh_izin					= $hasil->Fields('oleh_izin');
	$sifat_izin					= $hasil->Fields('sifat_izin');
	$masa_berlaku				= $hasil->Fields('masa_berlaku');
	$status_penyelenggara		= $hasil->Fields('status_penyelenggara');
	$akreditas_rs				= $hasil->Fields('akreditas_rs');
	$pentahapan_akreditas		= $hasil->Fields('pentahapan_akreditas');
	$status_akreditas			= $hasil->Fields('status_akreditas');
	$tanggal_akreditas			= $hasil->Fields('tanggal_akreditas');
	$jumlah_tt					= $hasil->Fields('jumlah_tt');
	$perinatologi				= $hasil->Fields('perinatologi');
	$kelas_vvip					= $hasil->Fields('kelas_vvip');
	$kelas_vip					= $hasil->Fields('kelas_vip');
	$kelas_i					= $hasil->Fields('kelas_i');
	$kelas_ii					= $hasil->Fields('kelas_ii');
	$kelas_iii					= $hasil->Fields('kelas_iii');
	$icu						= $hasil->Fields('icu');
	$picu						= $hasil->Fields('picu');
	$nicu						= $hasil->Fields('nicu');
	$hcu						= $hasil->Fields('hcu');
	$iccu						= $hasil->Fields('iccu');
	$ruang_isolasi				= $hasil->Fields('ruang_isolasi');
	$ruang_ugd					= $hasil->Fields('ruang_ugd');
	$ruang_bersalin				= $hasil->Fields('ruang_bersalin');
	$ruang_operasi				= $hasil->Fields('ruang_operasi');
	$email						= $hasil->Fields('email');
	

	
?>
<div class="card-body">
		<!-- ========================================================================================= -->
		<div class="card-title">
			<h3 class="card-label">Edit Data Dasar</h3>
		</div>
		<!-- ========================================================================================= -->

		<!-- ========================================================================================= -->
		<div id="isiUtama">
			<form method="post" action="#" id="FormData">
				<table cellpadding="0" cellspacing="0" class="table">
					<tr>
		<!-- --------------------------------------------------------------------------------- -->
						<td class="kiri">
							<table cellpadding="0" cellspacing="0">
							    <tr>
									<td class="field">Nomor Kode RS </td>
									<td class="input"><INPUT type="text" class="form-control" NAME="kode_rs" value="<?=$kode_rs?>">&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Tanggal Registrasi </td>
									<td class="input">
										<input type="text" class="form-control" id="tgl-registrasi" value="<?=date("m/d/Y",strtotime($tgl_registrasi));?>">
										<script>
											$("#tgl-registrasi").datepicker();
										</script>										
									</td>
								</tr>
								<tr>
									<td class="field">Nama Rumah Sakit</td>
									<td class="input"><input type="text" class="form-control" name="nama_perusahaan" value="<?= $nama_perusahaan ?>"/></td>
								</tr>
								<tr>
									<td class="field">Nama Singkat</td>
									<td class="input"><input type="text" class="form-control" name="nama_singkat" value="<?= $nama_singkat ?>"/></td>
								</tr>
								<tr>
									<td class="field">Nama Aplikasi</td>
									<td class="input"><input type="text" class="form-control" name="nama_aplikasi" value="<?= $nama_aplikasi ?>"/></td>
								</tr>
								<tr>
									<td class="field">Jenis Rumah Sakit </td>
									<td class="input">
									<select class="form-control" name="jenis_rumah_sakit">
										<option value="">---Pilih Jenis Rumah Sakit---</option>
										<option value="RSU" <?=($jenis_rumah_sakit=="RSU")?"selected":""?>>RSU</option>
										<option value="RS JIWA" <?=($jenis_rumah_sakit=="RS JIWA")?"selected":""?>>RS Jiwa</option>
										<option value="RS BERSALIN" <?=($jenis_rumah_sakit=="RS BERSALIN")?"selected":""?>>RS Bersalin</option>
										<option value="RS MATA" <?=($jenis_rumah_sakit=="RS MATA")?"selected":""?>>RS Mata</option>
										<option value="RS KANKER" <?=($jenis_rumah_sakit=="RS KANKER")?"selected":""?>>RS Kanker</option>
										<option value="RS TUBERKULOSA PARU" <?=($jenis_rumah_sakit=="RS TUBERKULOSA PARU")?"selected":""?>>RS Tuberkulosa Paru</option>
										<option value="RS PENYAKIT INFEKSI" <?=($jenis_rumah_sakit=="RS PENYAKIT INFEKSI")?"selected":""?>>RS Penyakit Infeksi</option>
										<option value="RSK PENYAKIT DALAM" <?=($jenis_rumah_sakit=="RSK PENYAKIT DALAM")?"selected":""?>>RSK Penyakit Dalam</option>
										<option value="RSK BEDAH" <?=($jenis_rumah_sakit=="RSK BEDAH")?"selected":""?>>RSK Bedah</option>
										<option value="RS JANTUNG" <?=($jenis_rumah_sakit=="RS JANTUNG")?"selected":""?>>RS Jantung</option>
									</select>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kelas Rumah Sakit </td>
									<td class="input">
									<select class="form-control" name="kelas_rumah_sakit">
										<option value="">---Pilih Kelas Rumah Sakit---</option>
										<option value="A" <?=$kelas_rumah_sakit=="A"?"selected":""?>>A</option>
										<option value="B" <?=$kelas_rumah_sakit=="B"?"selected":""?>>B</option>
										<option value="C" <?=$kelas_rumah_sakit=="C"?"selected":""?>>C</option>
										<option value="D" <?=$kelas_rumah_sakit=="D"?"selected":""?>>D</option>
										<option value="BELUM DITETAPKAN" <?=$kelas_rumah_sakit=="BELUM DITETAPKAN"?"selected":""?>>Belum Ditetapkan</option>
									</select>&nbsp;</td>
								</tr>
								
								<tr>
									<td class="field">Nama Direktur RS</td>
									<td class="input"><input type="text" class="form-control" name="nama_pimpinan" value="<?= $nama_pimpinan ?>"/></td>
								</tr>
								<tr>
									<td class="field">Nama Penyelenggara RS  </td>
									<td class="input"><input type="text" class="form-control" name="penyelenggara_rumah_sakit" value="<?=$penyelenggara_rumah_sakit?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Alamat/Lokasi RS</td>
									<td class="input"><input type="text" class="form-control" name="alamat" value="<?= $alamat ?>"/></td>
								</tr>
								<tr>
									<td class="field">Propinsi</td>
									<td class="input"><input type="text" class="form-control" name="propinsi" value="<?= $propinsi ?>"/></td>
								</tr>
								<tr>
									<td class="field">Kota</td>
									<td class="input"><input type="text" class="form-control" name="kota" value="<?= $kota ?>"/></td>
								</tr>
								
								<tr>
									<td class="field">Kode Pos</td>
									<td class="input"><input type="text" class="form-control" name="kode_pos" value="<?= $kode_pos ?>"/></td>
								</tr>
								<tr>
									<td class="field">Telpon</td>
									<td class="input"><input type="text" class="form-control" name="telpon" value="<?= $telpon ?>"/></td>
								</tr>
								<tr>
									<td class="field">Fax</td>
									<td class="input"><input type="text" class="form-control" name="fax" value="<?= $fax ?>"/></td>
								</tr>
								<tr>
									<td class="field">Email</td>
									<td class="input"><input type="text" class="form-control" name="email" value="<?= $email ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Nomor Telp Bag. Umum/Humas RS</td>
									<td class="input"><input type="text" class="form-control" name="notelp_humas" value="<?= $notelp_humas ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Website</td>
									<td class="input"><input type="text" class="form-control" name="website" value="<?= $website ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field"><u>Luas Rumah Sakit</u> </td>
									<td class="input">&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Tanah   </td>
									<td class="input"><input type="text" class="form-control" name="luas_tanah" value="<?= $luas_tanah ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Bangunan   </td>
									<td class="input"><input type="text" class="form-control" name="luas_bangunan" value="<?= $luas_bangunan ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field"><u>Surat Izin/Penetapan</u>   </td>
									<td class="input">&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Nomor Izin</td>
									<td class="input"><input type="text" class="form-control" name="nomor_izin" value="<?= $nomor_izin ?>">&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Tanggal Izin</td>
									<td class="input">
										<input type="text" class="form-control" id="tanggal-izin" value="<?=date("m/d/Y",strtotime($tanggal_izin));?>">
										<script>
											$("#tanggal-izin").datepicker();
										</script>
										
									</td>
								</tr>
								
								<tr>
									<td class="field">Oleh</td>
									<td class="input"><input type="text" class="form-control" name="oleh_izin" value="<?= $oleh_izin ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Sifat </td>
									<td class="input"><input type="text" class="form-control" name="sifat_izin" value="<?= $sifat_izin ?>"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Masa Berlaku s/d thn <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="masa_berlaku" value="<?= $masa_berlaku ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								
								
												
								
							</table>
						</td>
		<!-- --------------------------------------------------------------------------------- -->

		<!-- --------------------------------------------------------------------------------- -->
						<td class="kanan">
							<table cellpadding="0" cellspacing="0">
							    <tr>
									<td class="field">Status Penyelenggara Swasta   </td>
									<td class="input">
									<select class="form-control" name="status_penyelenggara">
										<option value="">--Pilih Status Penyelenggara Swasta---</option>
										<option value="ISLAM" <?=($status_penyelenggara == "ISLAM")?"selected":""?>>Islam</option>
										<option value="KHATOLIK" <?=($status_penyelenggara == "KHATOLIK")?"selected":""?>>Khatolik</option>
										<option value="PROTESTAN" <?=($status_penyelenggara == "PROTESTAN")?"selected":""?>>Protestan</option>
										<option value="HINDU" <?=($status_penyelenggara == "HINDU")?"selected":""?>>Hindu</option>
										<option value="BUDHA" <?=($status_penyelenggara == "BUDHA")?"selected":""?>>Budha</option>
										<option value="ORGANISASI SOSIAL" <?=($status_penyelenggara == "ORGANISASI SOSIAL")?"selected":""?>>Organisasi Sosial</option>
										<option value="PERUSAHAAN" <?=($status_penyelenggara == "PERUSAHAAN")?"selected":""?>>Perusahaan</option>
										<option value="PERORANGAN" <?=($status_penyelenggara == "PERORANGAN")?"selected":""?>>Perorangan</option>
									</select>
									&nbsp;</td>
								</tr>
								<tr>
									<td class="field"><u>Akreditasi RS</u>   </td>
									<td class="input">
									<select class="form-control" name="akreditas_rs">
										<option value="">---Pilih Akreditasi RS---</option>
										<option value="SUDAH" <?=($akreditas_rs=="SUDAH")?"selected":""?>>Sudah</option>
										<option value="BELUM" <?=($akreditas_rs=="BELUM")?"selected":""?>>Belum</option>
									</select>
									&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Pentahapan Pelayanan </td>
									<td class="input">
									<select class="form-control" name="pentahapan_akreditas">
										<option value="">---Pentahapan Pelayanan---</option>
										<option value="5" <?=($pentahapan_akreditas=="5")?"selected":""?>>5</option>
										<option value="12" <?=($pentahapan_akreditas=="12")?"selected":""?>>12</option>
										<option value="16" <?=($pentahapan_akreditas=="16")?"selected":""?>>16</option>
										<option value="AKREDITASI INTERNASIONAL" <?=($pentahapan_akreditas=="AKREDITASI INTERNASIONAL")?"selected":""?>>Akreditasi Internasional</option>
									</select>
									&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Status</td>
									<td class="input">
									<select class="form-control" name="status_akreditas">
										<option value="">---Pilih Status Akreditasi---</option>
										<option value="PENUH" <?=($status_akreditas=="PENUH")?"selected":""?>>Penuh</option>
										<option value="BERSYARAT" <?=($status_akreditas=="BERSYARAT")?"selected":""?>>Bersyarat</option>
										<option value="GAGAL" <?=($status_akreditas=="GAGAL")?"selected":""?>>Gagal</option>
									</select>
									&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Tanggal Akreditasi      </td>
									<td class="input">
										<input type="text" class="form-control" id="tgl-akreditasi" value="<?=date("m/d/Y",strtotime($tanggal_akreditas));?>">
										<script>
											$("#tgl-akreditasi").datepicker();
										</script>
										
									</td>
								</tr>
							    <tr>
									<td class="field"><u>Jumlah Tempat Tidur</u></td>
									<td class="input">&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Perinatalogi <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="perinatologi" value="<?= $perinatologi ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kelas VVIP <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="kelas_vvip" value="<?= $kelas_vvip ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kelas VIP <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="kelas_vip" value="<?= $kelas_vip ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kelas I <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="kelas_i" value="<?= $kelas_i ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kelas II <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="kelas_ii" value="<?= $kelas_ii ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kelas III <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="kelas_iii" value="<?= $kelas_iii ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">ICU <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="icu" value="<?= $icu ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">PICU <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="picu" value="<?= $picu ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">NICU <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="nicu" value="<?= $nicu ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">HCU <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="hcu" value="<?= $hcu ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">ICCU <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="iccu" value="<?= $iccu ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Ruang Isolasi <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="ruang_isolasi" value="<?= $ruang_isolasi ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Ruang UGD <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="ruang_ugd" value="<?= $ruang_ugd ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Ruang Bersalin <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="ruang_bersalin" value="<?= $ruang_bersalin ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Ruang Operasi <font size="1" color="#ff0099"><sup>(1)</sup></font></td>
									<td class="input"><input type="text" class="form-control" name="ruang_operasi" value="<?= $ruang_operasi ?>" onkeypress="if (event.keyCode>57 || event.keyCode<48) { event.returnValue = false }"/>&nbsp;</td>
								</tr>
								<tr>
									<td class="field">Kontak Person</td>
									<td class="input"><input type="text" class="form-control" name="kontak_person" value="<?= $kontak_person ?>"/></td>
								</tr>
								<tr>
									<td class="field">Title Header</td>
									<td class="input"><input type="text" class="form-control" name="html_title" value="<?= $html_title ?>"/></td>
								</tr>
								<tr>
									<td class="field">Logo</td>
									<td class="input"><input type="text" class="form-control" name="logo" value="<?= $logo ?>"/></td>
								</tr>
								<tr>
									<td class="field">Logo Small</td>
									<td class="input"><input type="text" class="form-control" name="logo_small" value="<?= $logo_small ?>"/></td>
								</tr>
								<tr>
									<td class="field">Keterangan</td>
									<td class="input"><input type="text" class="form-control" name="keterangan" value="<?= $keterangan ?>"/></td>
								</tr>
															
							</table>
						</td>
								<!-- --------------------------------------------------------------------------------- -->
					</tr>
				</table>
				<div class="formInputSubmit"><input type="button" name="Submit" value="Submit" class="btn btn-success" onclick="SimpanData()">&nbsp;<input type="reset" value="Batal" class="btn btn-danger" onclick="javascript:window.close();return false;" <?= $inputDisabled?> ></div>
			</form>
		</div>
	</div>
	<script>
	function SimpanData(){
		Swal.fire({
			title: "Simpan Data",
			text: "apakah yakin data yang diinput sudah benar ?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "YA",
			cancelButtonText: "BATAL",
			customClass: {
			   confirmButton: "btn btn-success",
			   cancelButton: "btn btn-warning"
			  }
			}).then(function(result) {
				
				if(result.value){
					var dataForm=$('#FormData').serialize();
					$.ajax({
					  type: "POST",
					  url: '/00_admin/konfigurasi_datadasar_act.php',
					  data: dataForm,
					  success: function (datax){
						if(datax.code=='200')
						{
							$("#BuatModal").modal('hide');
							Swal.fire("Sukses ","Berhasil Menyimpan Data","success");								
							loadKonten('../00_admin/konfigurasi_tab.php')						 
							
						}else{
							 Swal.fire("Gagal ","Gagal Menyimpan Data","error");
						}
					  },
					  dataType: "json"
					});
				}
				
			});
	}
	</script>
		