<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
//$db->debug=true;

//var_dump($_SESSION);
//$loginInfo["username"]

$sql="select * from tc_pengajuan_dokumen where id_tc_pengajuan_dokumen=$id";
$hasil =& $db->Execute($sql);
$id_tc_pengajuan_dokumen = $hasil->Fields('id_tc_pengajuan_dokumen');
$id_tc_pengajuan = $hasil->Fields('id_tc_pengajuan');
$url_dokumen = $hasil->Fields('url_dokumen');

//echo $url_dokumen;
//die;
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Dokument</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form name="xxx" method="post" action="#" id="formDataMenu">
		<div class="col-sm-12">
			<iframe src="<?=$url_dokumen?>" width="100%" height="600px"></iframe>
		</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		
	</div>
	</form>
</div>
<script>
</script>
	<!-- ========================================================================================= -->
