<?php
session_start();
include "_lib/function/db_login.php";
include "_lib/function/function.olah_tabel.php";
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("class","Security");

//$db->debug=true;
?>
<?//php include "_header.php"?>
<div class="app-main__inner" id="kt_content">
	<!-- 	Content 	 -->
	<div class="row">
		<div class="col-md-12">
			<div class="main-card mb-3 card">
				<?php $link= "$folder/index.php"?>
			</div>
		</div>
	</div>
	<!-- 	End Content 	-->
</div>

<!-- 	Footer 	-->
<?php include "_footer.php"?>
<!-- 	End Footer 	-->

<script src="assets/plugins/global/plugins.bundle.js?v=7.0.4"></script>
<script src="assets/js/pages/widgets.js?v=7.0.4"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script src="_av_js/main.js"></script>
<script>
loadKonten("<?=$link?>");
</script>
