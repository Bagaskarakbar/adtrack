<?
session_start();

require_once("../_lib/function/db.php");
loadlib("function","function.olah_tabel");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
//$db->debug=true;

//var_dump($_SESSION);
//$loginInfo["username"]

//echo $url_dokumen;
//die;

$id_tc_monitoring = baca_tabel("tc_monitoring","id_tc_monitoring","where id_mt_monitoring=$id and id_tc_transaksi=$idt");
$nama_monitoring = baca_tabel("mt_monitoring","nama_monitoring","where id_mt_monitoring=$id");
$act="tambah";
?>

<div class="modal-content">
	<div class="modal-header" style="background-color:#d92550">
		<h5 class="modal-title" id="staticBackdropLabel" style="color:white">Form Monitoring Detail</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form id="idTambahDeliveryDetail" method="POST" action="#"  enctype="multipart/form-data">
		<div class="col-sm-12">
			<br>
			<div class="row">
					<div class="col-lg-4">
						<label >Keterangan</label>
					</div>
					<div class="col-lg-8">
						<textarea class="form-control"  name="keterangan" ></textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label >Tanggal Mulai <?=mandatory();?></label>
					</div>
					<div class="col-lg-5">
						<input type="date" class="form-control"  name="tgl_mulai">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label >Tanggal Selesai <?=mandatory();?></label>
					</div>
					<div class="col-lg-5">
						<input type="date" class="form-control"  name="tgl_selesai">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<label >Progres <?=mandatory();?></label>
					</div>
					<div class="col-lg-2">
						<input type="number" class="form-control"  name="progres">
					</div>
					<div class="col-lg-2">
						<label >%</label>
					</div>
				</div>
				<br>
		</div>
		<input type="hidden" class="form-control"  name="id_tc_monitoring" value="<?=$id_tc_monitoring?>">
		<input type="hidden" class="form-control"  name="act" value="tambah">
		
	<div class="modal-footer">
		<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-success " onclick="AddDeliveryDetail()">Submit</button>
		
	</div>
	</form>
</div>
<script src="/assets/js/bot-ta/bootstrap-table.js"></script>
<script>
function AddDeliveryDetail(){
		var dataform=$("#idTambahDeliveryDetail").serialize();
		$.ajax({
			type: "POST",
			url: '/06_monitoring_delivery/add_monitoring_detail_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
					//Swal.fire("Success!","Data Berhasil ditambah!","success");
					 //Swal.fire({icon: 'success',title: 'Yayy...',text: 'Data berhasil dimasukan!!'});
					AddMon(<?=$id?>,<?=$idt?>)
					//$('#BuatModal').modal('hide');
				}else{
					//Swal.fire("Gagal!","Terjadi Kesalahan!","warning");
					//Swal.fire({icon: 'error',title: 'Oops...',text: 'Data gagal dimasukan!!',footer: 'Note: Terjadi kesalahan saat memasukan data!!'});
				}
			},
			dataType: "json"
		});
	}
</script>
	<!-- ========================================================================================= -->
