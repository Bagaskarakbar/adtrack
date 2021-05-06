<?
session_start();

	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.tidak_berulang");
	loadlib("class","Paging");
	//cek_kiriman();
	//$db->debug=true;


	switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "AND nama_tarif LIKE'%$filter%'";
			break;
		case "periksa" :
			$sqlPlus = "AND nama_pemeriksaan  LIKE'%$filter%'";
			break;
		default :
			$sqlPlus = "";
	}


	$sql = "SELECT * FROM pm_standar_hasil_v WHERE kode_bagian='".$kode_bagnya."' $sqlPlus ORDER BY kode_tarif,urutan";

	
	$recperpage = 20;

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;


?>

<div class="container mb-8" id="RadView">

			<div class="card card-custom p-6">
			
			

				
					<div id="topLayer" class="loading"></div>
					<!-- ========================================================================================= -->
					
							<div class="card-header flex-wrap border-0 pt-6 pb-0">
								<div class="card-title" style='font-weight:bold'>Standar Radiologi</div>
								<div ><a href="#" class="btn btn-primary font-weight-bolder" onclick="TambahRad('')">
								<i class="la la-plus"></i>Tambah Standar</a> &nbsp;</div>
							</div>
					
					
		
				<div class="card-body" id="tab_frame" align="right">
				
				<form method="get" >
					<div class="mb-7">
						<div class="row align-items">

									<div >
										<div class="d-flex align-items-center">
											<label class="mr-4 mb-0 d-none d-md-block">Cari:</label>
											<select name="tipeCari" class="form-control" id="kt_datatable_search_status" tabindex="null">
											<option value="pemeriksaan" <?= ($tipeCari == "pemeriksaan") ? ("selected") : ("") ?>>Pemeriksaan</option>
											<option value="pemeriksaan_detail" <?= ($tipeCari == "pemeriksaan_detail") ? ("selected") : ("") ?>>Pemeriksaan Detail</option>
								
										</select>
										</div>
									</div> &nbsp;&nbsp;&nbsp;
									<div >
										<div class="d-flex align-items-center">
											<input type="text" size="20" value="<?= $filter ?>" name="filter" class="form-control">
										</div>
									</div>&nbsp;&nbsp;&nbsp;
							
						
							<div >
								<input type="button" name="cari" value="Cari" onclick="CariRadiologi()" class="btn btn-light-primary px-6 font-weight-bold">
							</div>
						</div>
					</div>
					</form>
				
				<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_rad_json.php" data-pagination="true" data-trim-on-search="true" data-sort-order="asc" data-side-pagination="server" data-search="false" data-total-field="count" data-data-field="items">
														<thead>
															<tr>
																<th class="thno" data-field="no" style="text-align:center">No.</th>
																<th class="thicons" data-field="action_hapus" style="text-align:center">&nbsp;</th>
																<th class="thicons" data-field="action_edit" style="text-align:center">&nbsp;</th>
																<th data-field="nama_tarif" style="text-align:center">Nama Pemeriksaan</th>
																<th data-field="nama_pemeriksaan" style="text-align:center">Nama Detail Pemeriksaan</th>
																<th data-field="standar_rad" style="text-align:center">Kesimpulan</th>
																<th data-field="kesan" style="text-align:center">Kesan</th>
															</tr>
														</thead>
														<tbody>
												<!-- ========================================================================================= -->
											<!-- ========================================================================================= -->
														</tbody>
													</table>
			</div>
</div>

	<div id="ModalAddRad" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="idIsiModalAddRad"></div>
		</div>
	</div>

	<div id="ModalEditRad" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="idIsiModalEditRad"></div>
		</div>
	</div>

<script src="/assets/js/bot-ta/bootstrap-table.js"></script>


<script>
		function TambahRad(a){
		$("#idIsiModalAddRad").load('/00_admin/standar_lab_add.php',function(){
			$("#ModalAddRad").modal("show");
		});
	}	


	function EditRad(a){
		$("#idIsiModalEditRad").load('/00_admin/standar_lab_edit.php',{kode_mt_hasilpm:a},function(){
			$("#ModalEditRad").modal("show");
		});
	}	
	
	
	
	
	function DelRad(a){
		Swal.fire({
		title: "Hapus Radiologi",
		text: "Apakah yakin Anda kan Menghapus?",
		icon: "question",
		showCancelButton: true,
		confirmButtonText: "Simpan",
		cancelButtonText: "Batal",
		customClass: {
		   confirmButton: "btn btn-success",
		   cancelButton: "btn btn-warning"
		  }
		}).then(function(result) {
			if (result.value) {
				var datastring=$("#AddRadiologi").serialize();
				$.ajax({
				  type: "POST",
				  url: '/00_admin/standar_lab_hapus.php',
				   data: {kode_mt_hasilpm:a},
				  success: function (data){
										if(data.code=='200')
									{ 
											 Swal.fire("Sukses ","Berhasil Menghapus","success");
											 $("#RadView").load("../00_admin/rad_standar.php");
											 
										
									}
										else{
										 Swal.fire("Gagal ","Berhasil Menghapus","error");
										 $("#RadView").load("../00_admin/rad_standar.php");
									}
				  },
				  dataType: "json"
				});
			}
		});
	}
	
	
function CariRadiologi(){
		var tipeCari=$("select[name=tipeCari]").val();
		var filter=$("input[name=filter]").val();
		$("#TableView").bootstrapTable('removeAll');		
		var urlnya='/00_admin/data_rad_json.php?tipeCari='+tipeCari+'&filter='+filter;
		 $("#TableView").bootstrapTable('refresh', {
			url:urlnya
		});
}
	
</script>
