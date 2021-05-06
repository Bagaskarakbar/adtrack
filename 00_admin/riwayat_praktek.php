<?

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.mandatory");
loadlib("function","function.max_kode_number");
// $db->debug= true;
$nama_pegawai=baca_tabel("mt_karyawan","nama_pegawai"," where kode_dokter=$kode_dokter");
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
<div class="tab-pane fade show active" id="idRiwayatPraktek" role="tabpanel" aria-labelledby="kt_tab_pane_1_1">
<div class="card-header border-0 py-3">
	<h3 class="card-title align-items-start flex-column">
		<span class="card-label font-weight-bolder text-dark">Riwayat Praktek</span>
	</h3>
	<button type="button" class="btn btn-primary btn-sm" onClick="AddDokDet()"><i class="las la-plus"></i>Tambah</button>
	<br/>
	<div class="table-responsive" id="idPraktek">
		<!--<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">-->
		<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_riwayat_praktek.php?kode=<?=$kode_dokter?>" data-pagination="true" data-trim-on-search="false"  data-search="true" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
			<thead>
				<tr>
					<th data-field="no" class="text-center"><span class="text-dark-75 text-center">No</span></th>
					<th data-field="action" class="text-center"><span class="text-dark-75 text-center"></span></th>
					<th data-field="nomer"><span class="text-dark-75 text-center">Nomer Izin Praktek</span></th>
					<th data-field="propinsi" class="text-center"><span class="text-dark-75 text-center">Propinsi</span></th>
					<th data-field="kota" class="text-center"><span class="text-dark-75 text-center">Kota </span></th>
					<th data-field="status" ><span class="text-dark-75 text-center">Status</span></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

</div>
		
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>	
<div id="ModalIsiPraktek" class="modal fade bd-modal-packing-md" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content" id="idIsiModalPraktek"></div>
	</div>
</div>
<script>
function AddDokDet(a){
	$("#idIsiModalPraktek").load("../00_admin/riwayat_praktek_tambah.php",{id_mt_dokter_detail:a,kode_dokter:<?=$kode_dokter?>},function(){
	$("#ModalIsiPraktek").modal("show");
	});
}
</script>

<script type="text/javascript">
	function hapusRiwayatPraktek(a){
		Swal.fire({
        title: "Hapus Riwayat Praktek ?",
        text: "apakah data yang di pilih sudah benar ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		customClass: {
		   confirmButton: "btn btn-danger",
		   cancelButton: "btn btn-warning"
		  }
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: '/00_admin/riwayat_praktek_act.php',
					data: {id_mt_dokter_detail:a,act:'delete'},
					success: function(data){
						if(data.code=='200'){
							$('#idRiwayatPraktek').load("../00_admin/riwayat_praktek.php",{kode_dokter:<?=$kode_dokter?>});
							Swal.fire("Sukses ","Berhasil Menghapus data","success");
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