<?
	session_start();

	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.tidak_berulang");
	loadlib("function","function.date2str");
	loadlib("function","function.form");
    loadlib("function", "function.uang");
     
	if (isset($kode_bagian_cari)){
		$sql_plus = " AND kode_bagian = '$kode_bagian_cari'";
	}
	
	$sql_poli = "SELECT * FROM mt_bagian WHERE validasi='0100' AND status_aktif = 1 ";
?>
<div class="container mb-8">
	<div class="card card-custom p-6">
		<div class="card-body">
		<!-- ========================================================================================= -->
		<div id="isiAtas">			
			<div class="card-title">
				<h3 class="card-label">Tarif Tindakan</h3>
			</div>	
			<div id="barTools">
				<form method="get" action="#" style='float:left;'>
					<table cellpadding="0" cellspacing="0" class="table">
						<tr>
							<td><b>Cari : </b></td>
							<td>
								<select class="form-control"name="kode_bagian_cari">
									
									<? pilihan_list($sql_poli,"nama_bagian","kode_bagian")?>
								</select>
							</td>
							<input type="hidden" name="rev" value="<?=$rev?>">
							<td><input type="button" name="cari" value="Cari" class="btn btn-success" onClick="fungsi_cari()"></td>
						</tr>
					</table>
					<input type="hidden" name="kd_bag" value="<?=$kd_bag?>">
				</form>
				
				<!-- <a href="tarif_view_add.php?rev=<?=$rev?>&kode_bagian_cari=<?=$kode_bagian_cari?>" class="tool" <?=$kode_bagian_cari=="" ? "disabled" : ""?>>Tambah</a> -->

				<a href="#" onClick="openPop('tarif_view2nd_add.php?rev=<?=$rev?>&kode_bagian_cari=<?=$kode_bagian_cari?>&kd_bag=<?=$kd_bag?>')" class="btn btn-success" <?=$kode_bagian_cari=="" ? "disabled" : ""?>  style='float:right;'>Tambah</a>

				<a href="#" class="btn btn-success" <?=$kode_bagian_cari=="" ? "disabled" : ""?> onClick="openPop('tarif_view_cetak.php?<?=isi_kirim()?>&rev=<?=$rev?>&type=1&kode_bagian_cari=<?=$kode_bagian_cari?>')"  style='float:right;'>Cetak</a>
				
			</div>
		</div>
		<!-- ========================================================================================= -->

		<!-- ========================================================================================= -->
		<div id="isiUtama">
			<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="" data-pagination="true" data-trim-on-search="false"  data-search="false" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
				<thead>
					<tr>
						<th class="thno" rowspan="2" data-field="i">No.</th>
						<th class="thcheck" rowspan="2" data-field="tarif_detail">&nbsp;</th>
						<th class="thedit" rowspan="2" data-field="act_edit">Edit</th>
						<th class="thcheck" rowspan="2" data-field="act_hapus">&nbsp;</th>
						<th rowspan="2" data-field="tarif_det">Nama Tarif</th>
						<th rowspan="2" data-field="total">Total</th>
						<th rowspan="2" data-field="bill_dr1">Bill dr 1</th>
						<th rowspan="2" data-field="bill_dr2">Bill dr 2</th>
						<th rowspan="2" data-field="bill_dr3">Bill dr 3</th>
						<th rowspan="2" data-field="jasa_dr_asisten">Jasa dr Asisten</th>
						<th colspan="3" >Komponen  RS</th>
						<th rowspan="2" data-field="kelas">Klas</th>
					</tr>

					<tr>
						<th data-field="pendapatan_rs">Pendapatan RS</th>
						<th data-field="overhead">Overhead</th>
						<th data-field="alat_rs">Alat RS</th>
					</tr>
				</thead>
				
			</table>
		</div>
		<div id="BuatModal" class="modal fade bd-modal-packing-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="idIsiModal"></div>
			</div>
		</div>
	<!-- ========================================================================================= -->
		<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
	<!-- ========================================================================================= -->
		<script language="JavaScript" type="text/javascript">
		fungsi_cari();
		function fungsi_cari(){
			var kode_bagian_cari=$("select[name=kode_bagian_cari]").val();
			$("#kt_datatable1").bootstrapTable('removeAll');		
			var urlnya='/00_admin/get_tarif_view_json.php?kode_bagian_cari='+kode_bagian_cari;
			 $("#kt_datatable1").bootstrapTable('refresh', {
				url:urlnya
			});
		}
		
		function tarif_detail(a,b,c)
		{
			var kode_bagian_cari=a;
			var rev=b;
			var kode_tarif=c;
			var url = '/00_admin/tarif_view_detail.php?kode_bagian_cari='+kode_bagian_cari+'&rev='+rev+'&kode_tarif='+kode_tarif;
			$("#idIsiModal").load(url,{},function(){
				$("#BuatModal").modal('show');
			});
		}
		</script>
		</div>
	</div>
</div>