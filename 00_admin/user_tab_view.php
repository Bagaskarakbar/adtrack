<div class="tab-content">
	<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
		<div class="row">
			<div class="col-md-12">
				<div class="main-card mb-3 card">
					<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>
						<div class="btn-actions-pane-right">
							<div class="nav">
								<a data-toggle="tab" href="#" onclick="User()" class="btn-pill btn-wide active btn btn-outline-danger btn-sm">User</a>
								<a data-toggle="tab" href="#" onclick="GroupUser()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Group User</a>
								<a data-toggle="tab" href="#" onclick="Privillages()" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-danger btn-sm">Group Privillage</a>
							</div>
						</div>
					</div>
					<script>
						User();
						function User(){
							$('#id_tab_content').load("../00_admin/user.php");
						}
						function GroupUser(){
							$('#id_tab_content').load("../00_admin/user_group.php");
						}
						function Privillages(){
							$('#id_tab_content').load("../00_admin/user_privillages.php");
						}
					</script>
					<div class="card-body" id="id_tab_content">
						
					</div>
		</div>
	</div>
</div>
</div>

