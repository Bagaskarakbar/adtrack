
<div class="app-header-right">
	<div class="header-btn-lg pr-0">
		<div class="widget-content p-0">
			<div class="widget-content-wrapper">
				<div class="widget-content-left">
					<div class="btn-group">
						<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
							<img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
							<i class="fa fa-angle-down ml-2 opacity-8"></i>
						</a>
						<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
							<a type="button" href="logout.php" tabindex="0" class="dropdown-item">Sign Out</a>
						</div>
					</div>
				</div>
				<div class="widget-content-left  ml-3 header-user-info">
					<div class="widget-heading">
						<?=$nama_user?>
					</div>
					<div class="widget-subheading">
					   <?=$_SESSION['logininfo']['username']?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
