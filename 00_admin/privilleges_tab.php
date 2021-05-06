<?	session_start();

	require_once("../_lib/function/db.php");
	loadlib("function","function.pilihan_list");
?>
<div class="container mb-8">
			<div class="card card-custom p-6">
				<div class="card-body" id="tab_frame">
		<div id="topLayer" class="loading"></div>
		<!-- ========================================================================================= -->
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title" style='font-weight:bold'>PRIVILLAGES</div>
			
		</div>
		<!-- ========================================================================================= -->
		
<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header card-header-tabs-line">
												<div class="card-toolbar">
													<ul class="nav nav-tabs nav-bold nav-tabs-line">
														<li class="nav-item">
															<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
																<span class="nav-icon">
																	<i class="flaticon2-chat-1"></i>
																</span>
																<span class="nav-text">Group User</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Group Privilleges</span>
															</a>
														</li>
														
													</ul>
												</div>
											
											</div>
											<div class="card-body">
												<div class="tab-content">
													
													<div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
													
													<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0" style="position:absolute;left:0;border:0px solid black;">
															<a href="#" class="btn btn-primary font-weight-bolder rm-5" onClick="tambahGroup()">Tambah</a>
													</div>
														
													<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_groupuser_json.php" data-pagination="true" data-trim-on-search="true" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
														<thead>
															<tr>
																<th class="thno" data-field="no">No.</th>
																<th class="thicons" data-field="action_hapus">&nbsp;</th>
																<th class="thicons" data-field="action_edit">&nbsp;</th>
																<th data-field="nama_group">Nama Group</th>
																<th data-field="keterangan">Keterangan</th>
															</tr>
														</thead>
														<tbody>
												<!-- ========================================================================================= -->
											<!-- ========================================================================================= -->
														</tbody>
													</table>
													
													
													</div>
													
													<div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
													
													<div class="mb-7">
													<div class="row align-items-center">
														<div class="col-lg-9 col-xl-8">
															<form method="get" action="<?= $PHP_SELF ?>">
															<div id="idGroup">
																<select name="tipeCari" onChange="pilihPrivillage()" class="form-control" id="idKelompok">
																<option value="">-- Pilih Group User --</option>
																<?$sql_kelompok = "select * from dd_user_group ";
																	pilihan_list($sql_kelompok,"nama_group","id_dd_user_group","id_dd_user_group",$tipeCari);
																			
																?>
																</select>
															</div>
															</form>
														</div>
														
														<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
															
														</div>
													<!---->
													<!---->
													</div>
													
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
														<tbody>
												<!-- ========================================================================================= -->
											<!-- ========================================================================================= -->
														</tbody>
													</table>
													</form>
													</div>
													<div class="modal-footer">
													<div class="formInputSubmitMulti">
														<input type="button" value="Simpan" name="submit" onclick="simpanPrivilage()" class="btn btn-primary font-weight-bold">&nbsp;
													</div>
												
												</div>
												</div>
											</div>
										</div>
										<!--end::Card-->
			</div>
		</div>
	</div>
</div>

<div id="ModalTambahgroup" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModalTambahgroup"></div>
	</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function tambahGroup(){
	$("#idIsiModalTambahgroup").load("../00_admin/group_user_add.php",function(){
	$("#ModalTambahgroup").modal("show");
	});
	
}
</script>
<script>
function ubahGroupuser(a){
	$("#idIsiModalTambahgroup").load("../00_admin/group_user_edit.php",{id:a},function(){
	$("#ModalTambahgroup").modal("show");
	});
	
}
</script>
<script>
function hapusGroupuser(a){
	var x=confirm('Yakin ingin menghapus user ini?');
		if(x){
			$.ajax({
			  type: "POST",
			  url: '/00_admin/group_user_del_act.php',
			  data: {id_dd_user_group:a},
			  success: function(data){
				  if(data.code=='1'){
					  alert('Sukses');
					  cari_user();	
					  $('#idGroup').load("../00_admin/group_add.php");	
				  }else{
					  alert('Gagal');
				  }
			  },
			  dataType: "json"
			});
		}
}

function cari_user(){
		var search=$("input[name=search]").val();
		$("#TableView").bootstrapTable('removeAll');		
		var urlnya='/00_admin/data_groupuser_json.php?search='+search;
		 $("#TableView").bootstrapTable('refresh', {
			url:urlnya
		});
}
</script>

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
