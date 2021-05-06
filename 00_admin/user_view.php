<div class="container mb-8">
			<div class="card card-custom p-6">
				<div class="card-body" id="tab_frame">
		<div id="topLayer" class="loading"></div>
		<!-- ========================================================================================= -->
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title"><h3>User</h3></div>
			<div class="mb-12">
				<div class="row align-items-center">
					<div class="col-lg-9 col-xl-9">
					
						<table cellpadding="0" cellspacing="0" class="singleRow">
							<tr>
								<td><label class="mr-3 mb-0 d-none d-md-block"><b>Cari  </b> </label></td>
								<td>
									<select name="tipeCari" class="form-control form-control-solid form-control-lg" id="kt_datatable_search_status">
										<option value="nama" <?= ($tipeCari == "nama") ? ("selected") : ("") ?>>Nama Pegawai</option>
										<option value="id" <?= ($tipeCari == "id") ? ("selected") : ("") ?>>User ID</option>	
									</select>
								</td>
								<td><input type="text" size="20" class="form-control form-control-solid form-control-lg" value="<?= $filter ?>" name="filter"></td>
								<td><input type="button" name="cari" value="Cari" onclick="cari_user()" class="btn btn-light-primary px-6 font-weight-bold"></td>
							</tr>
						</table>
					
				</div>
				<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0" style="position:absolute;right:0;border:0px solid black;">
						<a href="#" class="btn btn-primary font-weight-bolder rm-5" onClick="tambah('/00_admin/user_addcaripegawai.php')">Tambah User</a>
				</div>
			</div>
		</div>
		<!-- ========================================================================================= -->

		<!-- ========================================================================================= -->
		<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable">
			<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/user_view_json.php" data-pagination="true" data-trim-on-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count"
  data-data-field="items">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th class="thicons" data-field="action_hapus">&nbsp;</th>
						<th class="thicons" data-field="action_edit">&nbsp;</th>
						<th width="100" data-field="username">User ID</th>
						<th width="150" data-field="nama_pegawai">Nama Pegawai</th>
						<th width="100" data-field="nama_bagian">Bagian</th>
						<th width="150" data-field="nama_group">Group User</th>
						<th width="40" data-field="status">Status</th>
						
					</tr>
				</thead>
			</table>
		</div>
	<!-- ========================================================================================= -->

		</div>
	</div>
	<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="idIsiModal"></div>
		</div>
	</div>
	
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
	function ubah_user_view(a){
		$("#idIsiModal").load('/00_admin/user_addedit.php',{id_dd_user:a,act:'edit'},function(){
			$("#BuatModal").modal("show");
		});
	}
	function tambah(link){
		$("#idIsiModal").load(link,{},function(){
			$("#BuatModal").modal("show");
		});
	}
	
	function hapus_user_view(a){
		var x=confirm('Yakin ingin menghapus user ini?');
		if(x){
			$.ajax({
			  type: "POST",
			  url: '/00_admin/user_act.php',
			  data: {id_dd_user:a,act:'delete'},
			  success: function(data){
				  if(data.code='200'){
					  alert('Sukses');
					  cari_user();					  
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});
		}
	}
	function cari_user(){
		var tipeCari=$("select[name=tipeCari]").val();
		var filter=$("input[name=filter]").val();
		$("#TableView").bootstrapTable('removeAll');		
		var urlnya='/00_admin/user_view_json.php?tipeCari='+tipeCari+'&filter='+filter;
		 $("#TableView").bootstrapTable('refresh', {
			url:urlnya
		});
}
</script>