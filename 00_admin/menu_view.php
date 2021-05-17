<div class="card-header">Konfigurasi Menu </div>
<div class="main-card mb-3 card">
		<div class="card-body">
		<div id="topLayer" class="loading"></div>
		<!-- ========================================================================================= -->
		<div id="isiAtas">
			
			<div id="barTools">
				<form method="get" action="#" style='float:left;'>
					<table cellpadding="0" cellspacing="0" class="table" >
						<tr>
							<td><b>Cari</b></td>
							<td>
								<select class="form-control"name="tipeCari">
									<option value="menu" <?= ($tipeCari == "menu") ? ("selected") : ("") ?>>Menu</option>	
									<option value="modul" <?= ($tipeCari == "modul") ? ("selected") : ("") ?>>Modul</option>
								</select>
							</td>
							<td><input type="text" class="form-control" size="20" value="<?= $filter ?>" name="filter"></td>
							<td><input type="button" name="cari" value="Cari" class="btn btn-success" onclick="cari_menu()"> </td>
						</tr>
					</table>
				</form>				
				<input type="button" class="btn btn-success" onclick="TambahMenu()" value="Tambah Menu" style='float:right;'>
			</div>
		</div>
		<!-- ========================================================================================= -->

		<!-- ========================================================================================= -->
		<div id="isiUtama">

		<form name="xxx" method="post" action="menu_act.php?act=sort">
			<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/00_admin/get_menu_view_json.php" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
				<thead>
					<tr>
						<th class="thno" data-field="no">No.</th>
						<th width="120" style="text-align:left;" data-field="nama_modul">Nama Modul</th>
						<th class="thicons" data-field="no_urut"><a href="#" title="Simpan" onclick="xxx.submit();"><i class='las la-save icon-lg text-success '></i></a></th>
						<th class="thicons" data-field="act_hapus">#&nbsp;</th>
						<th class="thicons" data-field="act_edit">#&nbsp;</th>
						<th width="220" style="text-align:left;" data-field="nama_menu">Nama Menu</th>
						
					</tr>
				</thead>				
			</table>
		</form>
		</div>
	<!-- ========================================================================================= -->
	</div>
</div>
<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="idIsiModal"></div>
	</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
	function cari_menu(){
		var tipeCari=$("select[name=tipeCari]").val();
		var filter=$("input[name=filter]").val();
		$("#kt_datatable1").bootstrapTable('removeAll');		
		var urlnya='/00_admin/get_menu_view_json.php?tipeCari='+tipeCari+'&filter='+filter;
		 $("#kt_datatable1").bootstrapTable('refresh', {
			url:urlnya
		});
	}
	function TambahMenu(){
		var aksi='add';
		$("#idIsiModal").load("/00_admin/menu_addedit.php",{aksi},function(){
			$("#BuatModal").modal('show');
		});
	}
	function EditMenu(url){
		var aksi='edit';
		$("#idIsiModal").load(url,{aksi},function(){
			$("#BuatModal").modal('show');
		});
	}
	function HapusMenu(id_dc_menu){
		var x = confirm('Hapus Menu ?');
		if(x){
		var act='delete';
			
			$.ajax({				
			  type: "POST",
			  url: '/00_admin/menu_act.php',	  
			  data:{id_dc_menu,act},
			  success: function (res){
				  if(res.code=='200'){
					  $("#BuatModal").modal('hide');
					  Swal.fire("Sukses ","Berhasil Menghapus Menu","success");						 
					  $("#kt_datatable1").bootstrapTable('refresh');
				  }else{
					  Swal.fire('Gagal Menghapus Menu');
				  }
			  },
			  dataType: "json"
			});
		}
		
	}
</script>