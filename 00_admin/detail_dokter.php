<?

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_number");
// $db->debug= true;
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
$kode_bagian_dokter = baca_tabel("mt_karyawan","kode_bagian","where kode_dokter = $kode_dokter");
$sql = "SELECT * FROM mt_jadwal_dokter WHERE kode_dokter= '$kode_dokter' ";

$hasil =$db->Execute($sql);
$id_mt_jadwal_dokter = $hasil->Fields('id_mt_jadwal_dokter');
$kode_dokter = $kode_dokter;
$kode_bagian = $kode_bagian_dokter;
$range_hari = $hasil->Fields('range_hari');
$jam_mulai = $hasil->Fields('jam_mulai');
$jam_akhir = $hasil->Fields('jam_akhir');
$keterangan = $hasil->Fields('keterangan');
$senin = $hasil->Fields('senin');
$selasa = $hasil->Fields('selasa');
$rabu = $hasil->Fields('rabu');
$kamis = $hasil->Fields('kamis');
$jumat = $hasil->Fields('jumat');
$sabtu = $hasil->Fields('sabtu');
$minggu = $hasil->Fields('minggu');
$tgl_input = $hasil->Fields('tgl_input');
$waktu_periksa = $hasil->Fields('waktu_periksa');
if($hasil->Fields('id_mt_jadwal_dokter') != NULL){
	$aksi = "edit";
}
else{
	$aksi = "add";
	$id_mt_jadwal_dokter = max_kode_number("mt_jadwal_dokter","id_mt_jadwal_dokter");
}

$jam=substr($jam_mulai,11,2);
$menit=substr($jam_mulai,13,2);

$jam_akhirX=substr($jam_akhir,11,2);
$menit_akhir=substr($jam_akhir,13,2);

?>
<div class="container mb-8" id="jadwalDokter">
	<div class="card card-custom p-6">
		<div class="card-body" id="tab_frame">
			<div id="topLayer" class="loading"></div>
			<!-- ========================================================================================= -->
			<div class="card-header flex-wrap border-0 pt-6 pb-0">
				<div class="card-title" ><h3>Dokter : <?=$nama_pegawai?>  ||  Spesialisasi : <?=$nama_spesialisasi?></h3></div>

			</div>
			<!-- ========================================================================================= -->

			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header card-header-tabs-line">
					<div class="card-toolbar">
						<ul class="nav nav-tabs nav-bold nav-tabs-line">
							<li class="nav-item dropdown">
								<a class="nav-link active" data-toggle="tab" href="#" onclick="Send(<?=$kode_dokter?>)">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Jadwal Dokter</span>
								</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#" onclick="Praktek()">
									<span class="nav-icon">
										<i class="flaticon2-chat-1"></i>
									</span>
									<span class="nav-text">Riwayat Praktek</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#" onclick="Pendidikan()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Riwayat Pendidikan</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="Jabatan()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Riwayat Jabatan</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="Keluarga()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Riwayat Keluarga</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="Cv()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">CV</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="Perjanjian()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Perjanjian Dokter</span>
								</a>
							</li>
							<!--<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="info()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Foto</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="info()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Paramater Praktek</span>
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" data-toggle="tab" href="#" onclick="info()">
									<span class="nav-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="nav-text">Status Dokter</span>
								</a>
							</li>-->


						</ul>
					</div>
				</div>
				<script>
				send();
				function Send(){
					$('#kt_tab_pane').load("../00_admin/jadwal_dokter.php",{kode_dokter:<?=$kode_dokter?>});
				}
				function Praktek(){
					$('#kt_tab_pane').load("../00_admin/riwayat_praktek.php",{kode_dokter:<?=$kode_dokter?>});
				}
				function Jabatan(){
					$('#kt_tab_pane').load("../00_admin/riwayat_jabatan.php",{kode_dokter:<?=$kode_dokter?>});
				}
				function Pendidikan(){
					$('#kt_tab_pane').load("../00_admin/riwayat_pendidikan.php",{kode_dokter:<?=$kode_dokter?>});
				}
				function Keluarga(){
					$('#kt_tab_pane').load("../00_admin/riwayat_keluarga.php",{kode_dokter:<?=$kode_dokter?>});
				}
				function Perjanjian(){
					$('#kt_tab_pane').load("../00_admin/perjanjian_dokter.php",{kode_dokter:<?=$kode_dokter?>});
				}
				function Cv(){
					$('#kt_tab_pane').load("../00_admin/cv_dokter.php",{kode_dokter:<?=$kode_dokter?>});
				}
				
				
				function info(){
				Swal.fire({
					title: "UNDER CONTSTRUCTION",
					icon: "error",
					confirmButtonText: "Close",
					customClass: {
					   confirmButton: "btn btn-danger"
					  }
					})
				}
				</script>
				<div class="card-body">
					<div class="tab-content" id="kt_tab_pane">
						
						
					</div>
				</div>
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>
</div>
<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>
