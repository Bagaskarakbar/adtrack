
<!-- presentation layer ------------------------------------------------------------------------------------------------------->
<div class="card-header">Konfigurasi Modul</div>
<div class="main-card mb-3 card">
		<div class="card-body">

	

	<!-- ========================================================================================= -->
	<div id="isiAtas">
		
		<div id="barTools" style='float:right;'>
			
			<input type="button" class="btn btn-success" onclick="TambahModul()" value="Tambah Modul">
		</div>
	</div>
	<!-- ========================================================================================= -->

	<!-- ========================================================================================= -->
	<div id="isiUtama">
		<form name="xxx" method="post" id="formData">
		
		<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/00_admin/get_modul_view_json.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
		<thead>
		<tr>
			<th class="thno" data-field="no">No.</th>
			<th style="text-align:left;" width="150" data-field="nama_modular">Nama Kelompok</th>
			<th class="thicons" data-field="no_urut"><a href="#" title="Simpan Urutan" onclick="SaveSort();"><i class='las la-save icon-lg text-success '></i></a></th>
			<th class="thicons" data-field="act_hapus">&nbsp;</th>
			<th class="thicons" data-field="act_edit">&nbsp;</th>
			<th width="150" style="text-align:left;" data-field="nama_modul">Nama Modul</th>
			<th data-field="kode_bagian">Kode</th>
			<th width="150" data-field="folder">Folder</th>
			<th width="180" data-field="logo">Icon</th>
		</tr>
		</thead>
		
		</table>

		</form>


	</div>
<!-- ========================================================================================= -->
		
<!-- ========================================================================================= -->

<!-- ############################################################################################# -->
</div>
</div>
<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
	function SaveSort(){
		var x = confirm("Simpan Urutan?");
		if(x){
			var dataForm=$("#formData").serialize();
			$.ajax({
				  type: "POST",
				  url: '/00_admin/modul_act.php?act=sort',
				  data: dataForm,
				  success: function (res){
					  if(res.code=='200'){
						  Swal.fire("Sukses ","Berhasil Melakukan Sort","success");
						 bootstrapTable('removeAll');
						 $("#kt_datatable1").bootstrapTable('refresh');
					  }else{
						  Swal.fire('Gagal Melakukan Sort');
					  }
				  },
				  dataType: "json"
				});
		}
	}
	function EditModul(id_dc_modul){
	var aksi='edit';
	$("#idIsiModal").load("/00_admin/modul_addedit.php",{id_dc_modul,aksi},function(){
		$("#BuatModal").modal('show');
	});
}
function TambahModul(){
	var aksi='add';
	$("#idIsiModal").load("/00_admin/modul_addedit.php",{aksi},function(){
		$("#BuatModal").modal('show');
	});
}
function HapusModul(id_dc_modul){
var x = confirm("Hapus Modul ini?");
if(x){
var act='delete';
	$.ajax({
		  type: "POST",
		  url: '/00_admin/modul_act.php',
		  data: {id_dc_modul,act},
		  success: function (res){
			  if(res.code=='200'){
				  $("#BuatModal").modal('hide');
				  Swal.fire("Sukses ","Berhasil Menghapus Modul","success");						 
				  $("#kt_datatable1").bootstrapTable('refresh');
			  }else{
				  Swal.fire('Gagal Menghapus Modul');
			  }
		  },
		  dataType: "json"
		});
}
}
</script>

