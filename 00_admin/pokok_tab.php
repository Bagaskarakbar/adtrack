<div class="container mb-8">
			<div class="card card-custom p-6">
				<div class="card-body" id="tab_frame">
		<div id="topLayer" class="loading"></div>
		<!-- ========================================================================================= -->
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title" style='font-weight:bold'>Tabel Pokok</div>
			
		</div>
		<!-- ========================================================================================= -->
		
<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header card-header-tabs-line">
												<div class="card-toolbar">
													<ul class="nav nav-tabs nav-bold nav-tabs-line">
														<li class="nav-item">
															<a class="nav-link active" data-toggle="tab" href="#" onclick="Kota()">
																<span class="nav-icon">
																	<i class="flaticon2-chat-1"></i>
																</span>
																<span class="nav-text">Kota</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Kecamatan()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Kecamatan</span>
															</a>
														</li>
														<li class="nav-item dropdown">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Kelurahan()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Kelurahan</span>
															</a>
														</li>
														<li class="nav-item dropdown">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Propinsi()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Propinsi</span>
															</a>
														</li>
														<li class="nav-item dropdown">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Negara()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Negara</span>
															</a>
														</li>
														<li class="nav-item dropdown">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Suku()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Suku</span>
															</a>
														</li>
														<li class="nav-item dropdown">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Agama()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Agama</span>
															</a>
														</li>
														<li class="nav-item dropdown">
															<a class="nav-link" data-toggle="tab" href="#" onclick="Bank()">
																<span class="nav-icon">
																	<i class="flaticon2-drop"></i>
																</span>
																<span class="nav-text">Bank</span>
															</a>
														</li>
														
													</ul>
												</div>
											
											</div>
											<script>
											Kota();
											function Bank(){
												$('#kt_tab_pokok').load("../00_admin/bank.php");
											}
											
											function Agama(){
												$('#kt_tab_pokok').load("../00_admin/agama.php");
											}
											
											function Suku(){
												$('#kt_tab_pokok').load("../00_admin/suku.php");
											}
											
											function Negara(){
												$('#kt_tab_pokok').load("../00_admin/negara.php");
											}
											
											function Propinsi(){
												$('#kt_tab_pokok').load("../00_admin/propinsi.php");
											}
											
											function Kelurahan(){
												$('#kt_tab_pokok').load("../00_admin/kelurahan.php");
											}
											
											function Kecamatan(){
												$('#kt_tab_pokok').load("../00_admin/kecamatan.php");
											}
																						
											function Kota(){
												$('#kt_tab_pokok').load("../00_admin/kota.php");
											}
											
											
											
											function info(){
											Swal.fire({
												title: "UNDER CONTSTRUCTION",
												icon: "error",
												confirmButtonText: "Close",
												customClass: {
												   confirmButton: "btn btn-danger"
												  }
												})
											}
											</script>
											<div class="card-body">
												<div class="tab-content" id="kt_tab_pokok">
													
													
												</div>
											</div>
										</div>
										<!--end::Card-->
			</div>
		</div>
	</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>