<?php
include "_lib/function/db_login.php";
include "_lib/function/function.olah_tabel.php";
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("class","Security");

//$db->debug=true;
?>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" >
	<div class="app-header header-shadow">
		<div class="app-header__logo">
			<div class="logo-src"></div>
			<div class="header__pane ml-auto">
				<div>
					<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>
			</div>
		</div>
		<div class="app-header__mobile-menu">
			<div>
				<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
		<div class="app-header__menu">
			<span>
				<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
					<span class="btn-icon-wrapper">
						<i class="fa fa-ellipsis-v fa-w-6"></i>
					</span>
				</button>
			</span>
		</div>
		<div class="app-header__content" id="kt_header">
		</div>
	</div>
	<div class="app-main" >
      <?php include "_aside.php" ?>
			<div class="app-main__outer" id="kt_wrapper"></div>
    </div>
</div>
<script src="assets/plugins/global/plugins.bundle.js?v=7.0.4"></script>
<script src="assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.4"></script>
<script src="assets/js/scripts.bundle.js?v=7.0.4"></script>
<script src="assets/js/pages/widgets.js?v=7.0.4"></script>
<script type="text/javascript" src="assets/scripts/main.js"></script>
