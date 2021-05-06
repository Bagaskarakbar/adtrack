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


	$sql = "SELECT * FROM pm_standar_hasil_v WHERE kode_bagian='050101' $sqlPlus ORDER BY kode_tarif,urutan";

	
	$recperpage = 20;

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;


?>

<div class="container mb-8" id="idLab">

			<div class="card card-custom p-6">
			
			

				
					<div id="topLayer" class="loading"></div>
					<!-- ========================================================================================= -->
					
							<div class="card-header flex-wrap border-0 pt-6 pb-0">
								<div class="card-title" style='font-weight:bold'>Standar Laboratorium</div>
								
							</div>
					
						<div class="card-body" id="tab_frame" align="right">
							<div class="card-toolbar">
								<!--begin::Button-->
								<a href="#" class="btn btn-primary font-weight-bolder" onclick="TambahLab('')">
								<i class="la la-plus"></i>Tambah Standar Lab</a> &nbsp;
								<!--end::Button-->
							</div>
						</div>
				

				
				
										
						<table id="TableView" class="table" data-toggle="table" data-url="/00_admin/data_lab_json.php" data-pagination="true" data-trim-on-search="true" data-sort-order="asc" data-side-pagination="server" data-search="true" data-total-field="count" data-data-field="items">
									<thead>
										<tr>
											<th class="thno" data-field="no">No.</th>
											<th class="thicons" data-field="action_hapus">&nbsp;</th>
											<th class="thicons" data-field="action_edit">&nbsp;</th>
											<th data-field="nama_tarif">Nama Pemeriksaan</th>
											<th data-field="nama_pemeriksaan">Nama Detail Pemeriksaan</th>
											<th data-field="standar_hasil_wanita">Standar Hasil Wanita</th>
											<th data-field="standar_hasil_pria">Standar Hasil Pria</th>
											<th data-field="satuan">Satuan</th>
										</tr>
									</thead>
									<tbody>
							
									</tbody>
						</table>
			</div>
</div>

	<div id="ModalAddLab" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="idIsiModalAddLab"></div>
		</div>
	</div>

	<div id="ModalEditLab" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="idIsiModalEditLab"></div>
		</div>
	</div>

<script src="/assets/js/bot-ta/bootstrap-table.js"></script>

<script>
		function TambahLab(a){
		$("#idIsiModalAddLab").load('/00_admin/lab_standar_add.php',function(){
			$("#ModalAddLab").modal("show");
		});
	}	


	function LabEdit(a){
		$("#idIsiModalEditLab").load('/00_admin/lab_standar_edit.php',{kode_mt_hasilpm:a},function(){
			$("#ModalEditLab").modal("show");
		});
	}
	
	function HapusLab(a){
		Swal.fire({
        title: "Hapus Standar Laboratorium ?",
        text: "apakah data yakin mau menghapus ?",
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
					url: '/00_admin/standar_lab_act.php',
					data: {kode_mt_hasilpm:a,validasi:3},
					success: function(data){
						if(data.code=='200'){
							$('#idLab').load("../00_admin/lab_standar.php");
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