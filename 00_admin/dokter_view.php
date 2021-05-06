<div class="container mb-8">
			<div class="card card-custom p-6">
				<div class="card-body" id="tab_frame">
					<div id="topLayer" class="loading"></div>
					<!-- ========================================================================================= -->
					<div class="card-header flex-wrap border-0 pt-6 pb-0">
						<div class="card-title" style='font-weight:bold'>Standar Laboratorium</div>
						
					</div>
		<!-- ========================================================================================= -->
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
												<!-- ========================================================================================= -->
											<!-- ========================================================================================= -->
														</tbody>
													</table>
			</div>
				</div>
				</div>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>