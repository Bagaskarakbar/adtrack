<?
	session_start();
	require_once("../_lib/function/db.php");
	//$db->debug=true;
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.pilihan_list");
?>
<div class="card-header">User Group Privillage</div>
<br>
<form method="get" action="<?= $PHP_SELF ?>">
<div id="idGroup">
	<div class="col-sm-5">
		<select name="tipeCari" onChange="pilihPrivillage()" class="form-control" id="idKelompok">
		<option value="">-- Pilih Group User --</option>
		<?$sql_kelompok = "select * from dd_user_group ";
			pilihan_list($sql_kelompok,"nama_group","id_dd_user_group","id_dd_user_group",$tipeCari);
					
		?>
		</select>
	</div>
</div>
</form>
<br>

	<div class="tab-content">
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<form id="idPrivillage">
			<table id="TableViewprivillage" class="table" data-toggle="table" data-url="/00_admin/data_privillage_json.php" data-pagination="true" data-trim-on-search="true" data-sort-order="asc" data-side-pagination="server" data-search="false" data-total-field="count" data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th data-field="nama_modul">Nama Modul</th>
						<th data-field="nama_menu">Nama Menu</th>
						<th data-field="nama_sub_menu">Nama Sub Menu</th>
						<th data-field="aktif">Aktif/Non Aktif</th>
					</tr>
				</thead>
			</table>
			</form>
		</div>
			
	</div>
<div class="form-group row">
	<div class="col-sm-12 text-right">
	 <input type="button" value="Simpan" name="submit" onclick="simpanPrivilage()" class="btn btn-success font-weight-bold">&nbsp;
	</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>

function pilihPrivillage(){
	var kelompok=$("#idKelompok").val();
	var urlnya='/00_admin/data_privillage_json.php?kelompok='+kelompok;
		 $("#TableViewprivillage").bootstrapTable('refresh', {
			url:urlnya
		});
}

function simpanPrivilage(){
	var kelompok=$("#idKelompok").val();
	var x=confirm('Apakah Yakin Akan Menyimpan Data Ini?');
		if(x){
			var dataform=$("#idPrivillage").serialize();
			$.ajax({
			  type: "POST",
			  url: '/00_admin/privillage_act.php?kelompok='+kelompok,
			  data: dataform,
			  success: function(data){
				  if(data.code=='1'){
					  alert('Sukses');
					  pilihPrivillage();					  
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});
		}
}
</script>