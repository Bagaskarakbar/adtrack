<div class="tab-content">
	<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
		<div class="row">
			<div class="col-md-12">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>
						<div class="btn-actions-pane-right">
							<div class="nav">
								<a data-toggle="tab" href="#" onclick="Modul()" class="btn-pill btn-wide active btn btn-outline-danger btn-sm">Modul</a>
								<a data-toggle="tab" href="#" onclick="Menu()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Menu</a>
								<a data-toggle="tab" href="#" onclick="SubMenu()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Sub Menu</a>
							</div>
						</div>
					</div>
					<script>
						Modul();
						function Modul(){
							$('#id_tab_content').load("../00_admin/modul_view.php");
						}
						function Menu(){
							$('#id_tab_content').load("../00_admin/menu_view.php");
						}
						function SubMenu(){
							$('#id_tab_content').load("../00_admin/submenu_view.php");
						}
					</script>
					<div class="card-body" id="id_tab_content">
						
					</div>
		</div>
	</div>
</div>
</div>

