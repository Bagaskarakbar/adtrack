
<div class="container mb-8">
	<div class="card card-custom p-6">
		<div class="card-body">
		<!-- ========================================================================================= -->
		<div id="isiAtas">			
			<div class="card-title">
				<h3 class="card-label">Konfigurasi Sub Menu</h3>
			</div>
			<div id="barTools">
				<form method="get" action="<?= $PHP_SELF ?>" style='float:left;'>
					<table cellpadding="0" cellspacing="0" class="table">
						<tr>
							<td><b>Cari  </b></td>
							<td>
								<select class="form-control"name="tipeCari">
									<option value="submenu" <?= ($tipeCari == "submenu") ? ("selected") : ("") ?>>Submenu</option>	
									<option value="menu" <?= ($tipeCari == "menu") ? ("selected") : ("") ?>>Menu</option>
									<option value="modul" <?= ($tipeCari == "modul") ? ("selected") : ("") ?>>Modul</option>
								</select>
							</td>
							<td><input type="text" class="form-control" size="20" value="<?= $filter ?>" name="filter"></td>
							<td><input type="button" name="cari" value="Cari" class="btn btn-success" onclick="fungsi_cari()"></td>
						</tr>
					</table>
				</form>
				<input type="button" class="btn btn-success" onclick="FungsiTambah()" value="Tambah Sub Menu" style='float:right;'>
			</div>
		</div>
		<!-- ========================================================================================= -->

		<!-- ========================================================================================= -->
		<div id="isiUtama">

		<form name="xxx" method="post" action="submenu_act.php?act=sort">
			<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/00_admin/get_submenu_view_json.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th width="100" style="text-align:left;" data-field="nama_modul">Nama Modul</th>
						<th width="140" style="text-align:left;" data-field="nama_menu">Nama Menu</th>
						<th class="thicons" data-field="no_urut"><a href="#" title="Simpan" onclick="xxx.submit();"><i class='las la-save icon-lg text-success '></i></a></th>
						<th class="thicons" data-field="act_hapus">&nbsp;</th>
						<th class="thicons" data-field="act_edit">&nbsp;</th>
						<th width="150" style="text-align:left;" data-field="nama_sub_menu">Nama Sub Menu</th>
						<th style="text-align:left;" data-field="url_sub_menu">Url</th>
					</tr>
				</thead>
				
			</table>
		</div>
	<!-- ========================================================================================= -->
		</div>
	</div>
</div>
<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function fungsi_cari(){
	var tipeCari=$("select[name=tipeCari]").val();
	var filter=$("input[name=filter]").val();
	$("#kt_datatable1").bootstrapTable('removeAll');		
	var urlnya='/00_admin/get_submenu_view_json.php?tipeCari='+tipeCari+'&filter='+filter;
	 $("#kt_datatable1").bootstrapTable('refresh', {
		url:urlnya
	});
}
function FungsiTambah(){
	var aksi='add';
	$("#idIsiModal").load("/00_admin/submenu_addedit.php",{aksi},function(){
		$("#BuatModal").modal('show');
	});
}
function FungsiEdit(a,b){
	var aksi='edit';
	$("#idIsiModal").load("/00_admin/submenu_addedit.php",{id_dc_sub_menu:a,id_dc_modul:b,aksi},function(){
		$("#BuatModal").modal('show');
	});
}
function FungsiHapus(id_dc_sub_menu){
var x = confirm("Hapus Sub Menu ini?");
if(x){
var act='delete';
	$.ajax({
		  type: "POST",
		  url: '/00_admin/submenu_act.php',
		  data: {id_dc_sub_menu,act},
		  success: function (res){
			  if(res.code=='200'){
				  $("#BuatModal").modal('hide');
				  Swal.fire("Sukses ","Berhasil Menghapus Sub Menu","success");						 
				  $("#kt_datatable1").bootstrapTable('refresh');
			  }else{
				  Swal.fire('Gagal Menghapus Sub Menu');
			  }
		  },
		  dataType: "json"
		});
}
}
</script>