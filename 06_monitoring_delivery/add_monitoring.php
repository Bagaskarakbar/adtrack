<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
//$db->debug=true;

//var_dump($_SESSION);
//$loginInfo["username"]

$nama_monitoring = baca_tabel("mt_monitoring","nama_monitoring","where id_mt_monitoring=$id");
$id_tc_monitoring = baca_tabel("tc_monitoring","id_tc_monitoring","where id_mt_monitoring=$id and id_tc_transaksi=$idt");

if($id_tc_monitoring==""){
 	$result = true;
	$db->BeginTrans();
	unset($insertMonitoring);
	$insertMonitoring["nama_monitoring"] 			= $nama_monitoring;
	$insertMonitoring["id_mt_monitoring"] 			= $id;
	$insertMonitoring["id_tc_transaksi"] 			= $idt;
	
	$result = insert_tabel("tc_monitoring", $insertMonitoring);
	$db->CommitTrans($result !== false);
	
	$cek="Insert";
}else{
	$sql="select * from tc_monitoring where id_mt_monitoring=$id and id_tc_transaksi=$idt";
	$hasil =& $db->Execute($sql);
	$id_tc_monitoring = $hasil->Fields('id_tc_monitoring');
	//$nama_monitoring = $hasil->Fields('nama_monitoring');
	$id_mt_monitoring = $hasil->Fields('id_mt_monitoring');
	$id_tc_transaksi = $hasil->Fields('id_tc_transaksi');
	
	$cek="Tampil";
}
//echo $cek;
//die;
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Form Monitoring</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form name="xxx" method="post" action="#" id="formDataMenu">
		<!--begin::Table-->
		<div class="col-sm-12">
			<br>
			<div class="row">
				<div class="col-lg-6">
					<table border="0">
						<tbody>
							<tr>
								<td><b>Nama Monitoring</b></td>
								<td>&nbsp : &nbsp </td>
								<td> <b><?= $nama_monitoring?> </b></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6  text-right">
					<button type="button" id="PopoverCustomT-4" class="btn btn-success btn-sm"><a href='#' style="lor: white; text-decoration: none;" onClick="AddMonDet(<?=$id?>,<?=$idt?>)"><i class="fa fa-plus"></i> Add Monitoring</a></button>
				</div>
			</div>
		</div>
		<br>
		<div class="table-responsive" id="idTblMonDet">
			<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/json/get_monitoring_delivery_detail.php?id=<?=$id_tc_monitoring?>" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
				<thead>
				<tr>
					<th data-align="center" data-field="no">No.</th>
					<th data-align="left" data-field="keterangan">Keterangan</th>
					<th data-align="center" data-field="tgl_mulai">Tanggal Mulai</th>
					<th data-align="center" data-field="tgl_selesai">Tanggal Selesai</th>
					<th data-align="center" data-field="progres">Progres %</th>
					<th data-align="center" data-field="action">Action</th>
				</tr>
				</thead>
			</table>
		</div>
		<!--end::Table-->
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal" onclick="BackDetail()">Close</button>
		
	</div>
	</form>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>




function AddMonDet(a,b){
	$("#idIsiModalLarge").load("/06_monitoring_delivery/add_monitoring_detail.php",{id:a,idt:b},function(){
		$("#BuatModalLarge").modal('show');
	});
}

function DeleteMonDet(a){
		$.ajax({
			type: "POST",
			url: '/06_monitoring_delivery/add_monitoring_detail_act.php',
			data: {idd:a,act:'delete'},
			success: function(data){
				if(data.code=='200'){
					AddMon(<?=$id?>,<?=$idt?>)
					//$('#BuatModal').modal('hide');
				}else{
					
				}
			},
			dataType: "json"
		});
	}
</script>
	<!-- ========================================================================================= -->
