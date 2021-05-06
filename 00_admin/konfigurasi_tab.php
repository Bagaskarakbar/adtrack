<?
// logic layer ==========================================================================================================;
session_start();
include "../_lib/function/db.php";
include "../_lib/function/function.olah_tabel.php";
loadlib("function","function.datetime");

$r=read_tabel("dd_konfigurasi","*");
while ($konf=$r->FetchRow()) {
	$kode_rs=$konf["kode_rs"];
	$nama_perusahaan=$konf["nama_perusahaan"];
	$nama_singkat=$konf["nama_singkat"];
	$alamat=$konf["alamat"];
	$kota=$konf["kota"];
	$kode_pos=$konf["kode_pos"];
	$propinsi=$konf["propinsi"];
	$telpon=$konf["telpon"];
	$fax=$konf["fax"];
	$nama_pimpinan=$konf["nama_pimpinan"];
	$keterangan=$konf["keterangan"];
	$logo=$konf["logo"];
	$logo_small=$konf["logo_small"];
	$html_title=$konf["html_title"];
	$kontak_person=$konf["kontak_person"];
	$tgl_registrasi =date2str($konf['tgl_registrasi']);
	$jenis_rumah_sakit =$konf['jenis_rumah_sakit'];
	$kelas_rumah_sakit =$konf['kelas_rumah_sakit'];
	$penyelenggara_rumah_sakit =$konf['penyelenggara_rumah_sakit'];
	$notelp_humas =$konf['notelp_humas'];
	$website =$konf['website'];
	$luas_tanah =$konf['luas_tanah'];
	$luas_bangunan =$konf['luas_bangunan'];
	$surat_izin =$konf['surat_izin'];
	$nomor_izin = $konf['nomor_izin'];
	$tanggal_izin = date2str($konf['tanggal_izin']);
	$oleh_izin = $konf['oleh_izin'];
	$sifat_izin = $konf['sifat_izin'];
	$masa_berlaku = $konf['masa_berlaku'];
	$status_penyelenggara = $konf['status_penyelenggara'];
	$akreditas_rs = $konf['akreditas_rs'];
	$pentahapan_akreditas = $konf['pentahapan_akreditas'];
	$status_akreditas = $konf['status_akreditas'];
	$tanggal_akreditas = date2str($konf['tanggal_akreditas']);
	$jumlah_tt = $konf['jumlah_tt'];
	$perinatologi = $konf['perinatologi'];
	$kelas_vvip = $konf['kelas_vvip'];
	$kelas_vip = $konf['kelas_vip'];
	$kelas_i = $konf['kelas_i'];
	$kelas_ii = $konf['kelas_ii'];
	$kelas_iii = $konf['kelas_iii'];
	$icu = $konf['icu'];
	$picu = $konf['picu'];
	$nicu = $konf['nicu'];
	$hcu = $konf['hcu'];
	$iccu = $konf['iccu'];
	$ruang_isolasi = $konf['ruang_isolasi'];
	$ruang_ugd = $konf['ruang_ugd'];
	$ruang_bersalin = $konf['ruang_bersalin'];
	$ruang_operasi = $konf['ruang_operasi'];
	$email = $konf['email'];

}

// end of logic layer ==========================================================================================================;
?>
<div class="container mb-8">
	<div class="card card-custom p-6">
		<div class="card-body">
	<div id="isiAtas">
		<div class="card-title" style='float:left;'>
			<h3 class="card-label">Data Dasar</h3>
		</div>
		<div id="barTools" style='float:right;'>
			<a href="#" class="toolOpen" onclick="EditKonf()">Edit Data Dasar</a>
		</div>

	</div>
	<!-- ========================================================================================= -->

	<!-- ========================================================================================= -->
	<div id="isiUtama">

		<table cellpadding="0" cellspacing="0" class="table">
		<tr>
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kiri">

				<table cellpadding="0" cellspacing="3">
				<tr>
					<td class="field">Nomor Kode RS </td>
					<td class="input"><?=$kode_rs?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Tanggal Registrasi </td>
					<td class="input"><?=$tgl_registrasi?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Nama Rumah Sakit</td>
					<td class="input"><?=$nama_perusahaan?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Nama Singkat</td>
					<td class="input"><?=$nama_singkat?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Jenis Rumah Sakit </td>
					<td class="input"><?=$jenis_rumah_sakit?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kelas Rumah Sakit </td>
					<td class="input"><?=$kelas_rumah_sakit?>&nbsp;</td>
				</tr>
				
				<tr>
					<td class="field">Nama Direktur RS </td>
					<td class="input"><?=$nama_pimpinan?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Nama Penyelenggara RS  </td>
					<td class="input"><?=$penyelenggara_rumah_sakit?>&nbsp;</td>
				</tr>
				
				<tr>
					<td class="field">Alamat/Lokasi RS</td>
					<td class="input"><?=$alamat?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Propinsi</td>
					<td class="input"><?=$propinsi?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kab/Kota  </td>
					<td class="input"><?=$kota?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kode Pos</td>
					<td class="input"><?=$kode_pos?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Telepon</td>
					<td class="input"><?=$telpon?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Fax</td>
					<td class="input"><?=$fax?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Email</td>
					<td class="input"><?=$email?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Nomor Telp Bag. Umum/Humas RS</td>
					<td class="input"><?=$notelp_humas?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Website</td>
					<td class="input"><?=$website?>&nbsp;</td>
				</tr>
				
				
				<tr>
					<td class="field"><u>Luas Rumah Sakit</u></td>
					<td class="input">&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Tanah   </td>
					<td class="input"><?=$luas_tanah?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Bangunan   </td>
					<td class="input"><?=$luas_bangunan?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field"><u>Surat Izin/Penetapan </u>  </td>
					<td class="input"><?=$surat_izin?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Nomor       </td>
					<td class="input"><?=$nomor_izin?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Tanggal        </td>
					<td class="input"><?=$tanggal_izin?>&nbsp;</td>
				</tr>
				
				<tr>
					<td class="field">Oleh        </td>
					<td class="input"><?=$oleh_izin?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Sifat </td>
					<td class="input"><?=$sifat_izin?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Masa Berlaku s/d thn  </td>
					<td class="input"><?=$masa_berlaku?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Status Penyelenggara Swasta   </td>
					<td class="input"><?=$status_penyelenggara?>&nbsp;</td>
				</tr>
				
				</table>

			</td>
			<!-- --------------------------------------------------------------------------------- -->
			<!-- --------------------------------------------------------------------------------- -->
			<td class="kanan">

				<table cellpadding="0" cellspacing="3">
				
				<tr>
					<td class="field"><u>Akreditasi RS</u>   </td>
					<td class="input"><?=$akreditas_rs?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Pentahapan    </td>
					<td class="input"><?=$pentahapan_akreditas?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Status    </td>
					<td class="input"><?=$status_akreditas?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Tanggal Akreditasi      </td>
					<td class="input"><?=$tanggal_akreditas?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field"><u>Jumlah Tempat Tidur </u>      </td>
					<td class="input"><?=$jumlah_tt?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Perinatalogi       </td>
					<td class="input"><?=$perinatologi?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kelas VVIP           </td>
					<td class="input"><?=$kelas_vvip?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kelas VIP              </td>
					<td class="input"><?=$kelas_vip?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kelas I                </td>
					<td class="input"><?=$kelas_i?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kelas II                  </td>
					<td class="input"><?=$kelas_ii?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Kelas III                  </td>
					<td class="input"><?=$kelas_iii?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">ICU                </td>
					<td class="input"><?=$icu?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">PICU                     </td>
					<td class="input"><?=$picu?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">NICU                        </td>
					<td class="input"><?=$nicu?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">HCU</td>
					<td class="input"><?=$hcu?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">ICCU</td>
					<td class="input"><?=$iccu?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Ruang Isolasi</td>
					<td class="input"><?=$ruang_isolasi?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Ruang UGD</td>
					<td class="input"><?=$ruang_ugd?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Ruang Bersalin </td>
					<td class="input"><?=$ruang_bersalin?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Ruang Operasi</td>
					<td class="input"><?=$ruang_operasi?>&nbsp;</td>
				</tr>
				<tr>
					<td class="field">Logo Besar</td>
					<td class="input" style="text-align:center;">
						<? if($logo!=" ") {?>
						<img src="<?=$logo?>" border="0" vspace="5"><br>
						<?=$logo?>
						<? }?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td class="field">Logo Kecil</td>
					<td class="input" style="text-align:center;">
						<img src="<?=$logo_small?>" border="0" vspace="5"><br>
						<?=$logo_small?>&nbsp;
					</td>
				</tr>
				</table>

			</td>
			<!-- --------------------------------------------------------------------------------- -->
		</tr>
		</table>

	</div>
	<!-- ========================================================================================= -->

		</div>
	</div>
</div>
<style>
	
  .modal-lg {
	width: 900px;
  }
	
</style>
<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>
<script>
function EditKonf(){
	$("#idIsiModal").load("/00_admin/konfigurasi_datadasar_edit.php",{},function(){
		$("#BuatModal").modal('show');
	});
}
</script>
<!-- ############################################################################################# -->
