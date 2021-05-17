<?
	
	session_start();
	require_once("../_lib/function/db.php");
	
?>
	<div class="card-header">Data Karyawan </div>
	<div class="tab-content">
		<div id="isiAtas">
			<div id="barTools">
				<form method="get" action="#" style='float:left;'>
					<table cellpadding="0" cellspacing="0" class="table" >
						<tr>
							<td><b>Cari</b></td>
							<td>
								<select name="tipeCari" class="form-control" id="kt_datatable_search_status" tabindex="null">
									<option value="nama" <?= ($tipeCari == "nama") ? ("selected") : ("") ?>>Nama</option>
									<option value="bagian" <?= ($tipeCari == "bagian") ? ("selected") : ("") ?>>Bagian</option>
									<option value="noinduk" <?= ($tipeCari == "noinduk") ? ("selected") : ("") ?>>No Induk</option>
								</select>
							</td>
							<td><input type="text" class="form-control" size="20" value="<?= $filter ?>" name="filter"></td>
							<td><input type="button" name="cari" value="Cari" class="btn btn-success" onclick="cari_user()"> </td>
						</tr>
					</table>
				</form>				
				<input type="button" class="btn btn-success" onClick="tambah_pegawai('/00_admin/karyawan_tambah.php')" value="Tambah Karyawan" style='float:right;'>
			</div>
		</div>
		
		<table id="TableViewUserAdd" class="table" data-toggle="table" data-url="/00_admin/user_addcaripegawai_json.php"  data-pagination="true" data-trim-on-search="false"  data-sort-order="asc" data-side-pagination="server" data-total-field="count"
		data-data-field="items" data-search="false" >
		<thead>
			<tr>
				<th data-field="action_edit"></th>
				<th data-field="action_hapus"></th>
				<th data-field="nama_pegawai">Pegawai</th>
				<th data-field="nama_bagian">Bagian</th>
				<th data-field="no_induk">No. Induk</th>
				<th data-field="status">Status</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><a href="user_addedit.php?no_induk=<?= $no_induk ?>" onclick="pilihIni(); return false"><b><?= $nama_pegawai ?></b></a>&nbsp;</td>
				<td><?= $nama_bagian ?>&nbsp;</td>
				<td><?= $no_induk ?>&nbsp;</td>
				<td><?= $status ?>&nbsp;</td>
			</tr>

		</tbody>
	</table>

		
	</div>	
		
	<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="idIsiModal"></div>
		</div>
<!-- ========================================================================================= -->
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script language="JavaScript" type="text/javascript">	
	function cari_user_add(){
		var tipeCari=$("select[name=tipeCari_user]").val();
		var filter=$("input[name=filter_user]").val();

		var urlnya='/00_admin/user_addcaripegawai_json.php?tipeCari='+tipeCari+'&filter='+filter;
		$("#TableViewUserAdd").bootstrapTable('refresh', {
			url:urlnya
		});
	}
	function add_user_act(a){

		$("#idIsiModal").load('/00_admin/user_addedit.php',{no_induk:a},function(){
			$("#BuatModal").modal("show");
		});
	}
	function tambah_pegawai(a){
		$("#idIsiModal").load('/00_admin/karyawan_tambah.php',{no_induk:a},function(){
			$("#BuatModal").modal("show");
		});
	}
	function hapus_karyawan(a){
			var x=confirm('Yakin ingin menghapus karyawan ini?');
			if(x){
				$.ajax({
					type: "POST",
					url: '/00_admin/karyawan_act.php',
					data: {no_induk:a,act:'delete'},
					success: function(data){
						if(data.code='200'){
							$("#BuatModal").modal('hide');
							$('.modal-backdrop').hide();
							$('#idTabKaryawan').load("../00_admin/karyawan_tab.php");
							Swal.fire("Success!","Data Berhasil dihapus!","success");
						}else{
							Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
						}
					},
					dataType: "json"
				});
			}
	}
	function ubah_karyawan(a){
		$("#idIsiModal").load('/00_admin/karyawan_edit.php',{no_induk:a},function(){
			$("#BuatModal").modal("show");
		});
	}
		function cari_user(){
		var tipeCari=$("select[name=tipeCari]").val();
		var filter=$("input[name=filter]").val();
		$("#TableViewUserAdd").bootstrapTable('removeAll');		
		var urlnya='/00_admin/user_addcaripegawai_json.php?tipeCari='+tipeCari+'&filter='+filter;
		 $("#TableViewUserAdd").bootstrapTable('refresh', {
			url:urlnya
		});
}
</script>
