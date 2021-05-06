

	
	<!-- ========================================================================================= -->

	<!-- ========================================================================================= -->
	<div id="isiUtama">
		<div class="modal-header register-modal-head" style="background-color:#2ca4d7">
			<h5 class="modal-title" style="color:white">Tambah User</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card-body" id="tab_frame">
	
				<table cellpadding="0" cellspacing="0" border='0'>
				<tr>
					<td class="field"><label class="mr-3 mb-0 d-none d-md-block"><b>Cari</b> </label></td>
					<td class="input">
						<select name="tipeCari_user" class="form-control form-control-solid form-control-lg" >
							<option value="nama" <?= ($tipeCari == "nama") ? ("selected") : ("") ?>>Pegawai</option>
							<option value="bagian" <?= ($tipeCari == "bagian") ? ("selected") : ("") ?>>Bagian</option>
							<option value="noinduk" <?= ($tipeCari == "noinduk") ? ("selected") : ("") ?>>No. Induk</option>	
						</select>
					</td>
					<td><input type="text" value="<?= $filter ?>" name="filter_user" class="form-control form-control-solid form-control-lg"></td>
					<td><input type="button" name="cari" value="Cari" onclick="cari_user_add()" class="btn btn-light-primary px-6 font-weight-bold"></td>
				</tr>
				</table>
			<table id="TableViewUserAdd" class="table" data-toggle="table" data-url="/00_admin/user_addcaripegawai_json.php"  data-pagination="true" data-trim-on-search="false"  data-sort-order="asc" data-side-pagination="server" data-total-field="count"
data-data-field="items"  >
				<thead>
				<tr>
					<th data-field="nama_pegawai">Pegawai</th>
					<th data-field="nama_bagian">Bagian</th>
					<th data-field="no_induk">No. Induk</th>
					<th data-field="status">Status</th>
					<th data-field="add_user">#</th>
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
					

					
				
			
		<div class="formInputSubmitMulti">
			<div class="modal-footer">
			
			<input type="reset" value="Batal" class="btn btn-warning font-weight-bold" data-dismiss="modal">
		</div>
		</div>

		</div>
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
		</script>
	