<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.mandatory");
// $db->debug=true;
?>
<div id="insertDocsModal">
	<form id="idTambahDokumen" method="POST" action="#"  enctype="multipart/form-data">
		<div id="content">
			<div class="modal-header register-modal-head" style="background-color:#d92550">
				<h5 class="modal-title" style="color:white"><b>Tambah Dokumen</b></h5>
				<button type="button" class="close" style="color:white" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times" aria-hidden="true"></i>
				</button>
			</div>

			<div class="col-sm-12">
				<br>
				<br>
				
				<div class="row">
					<div class="col-lg-4">
						<label for="exampleSelect1">Jenis Dokumen<?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="jenis_dokumen">
							<?  
							$sql_dokumen= "SELECT * FROM mt_dokumen WHERE id_mt_dokumen IN (19, 25, 26)";
							pilihan_list($sql_dokumen,"tipe_dokumen","id_mt_dokumen","id_mt_dokumen","id_mt_dokumen");
							?>
						</select>
					</div>
				</div>
				<br>

				<div class="row">
					<div class="col-lg-4">
						<label>Keterangan <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
                        <textarea id="keterangan_dokumen" name="keterangan_dokumen" rows="4" cols="46" placeholder="isi keterangan..."></textarea>
					</div>
				</div>
                 <br>
                
				<div class="row">
					<div class="col-lg-4">
						<label>Upload Dokumen <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<input type="file" class="form-control" accept="application/pdf"  id="dokumen_mitra" name="dokumen_mitra">
					</div>
				</div>
                 <br>

				<div class="row">
					<div class="col-lg-4"></div>	
					<div class="col-lg-8" id="loadDokumen"></div>
				</div>

				<input type="hidden" id="id_tc_transaksi" name="id_tc_transaksi" value="<?=$id?>">
				<br>

				<div class="row">
					<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="add_documents_mitra()">Masukkan</button>
							<button type="button" class="btn btn-danger font-weight-bolder font-size-sm" data-dismiss="modal">Batal</button>
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>	
    <br>
</div>
<script type="text/javascript">
	function readFile() {
		if (this.files && this.files[0]) {
			var FR= new FileReader();
			FR.addEventListener("load", function(e) {
				$("#loadDokumen").append("<input type='hidden' value='"+e.target.result+"' name='dokumen_mitra'>");
			}); 
			FR.readAsDataURL( this.files[0] );
		}

	}
	$("#idTambahDokumen input[name=dokumen_mitra]").change(readFile);
</script>
<script>
	function back(){
		$("#insertDocsModal").load("/09_mitra/index.php");
	}

	function add_documents_mitra(){
		var dataform=$("#idTambahDokumen").serialize();
		$.ajax({
			type: "POST",
            dataType: "json",
			url:'/09_mitra/mitra_form_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
					Swal.fire("Berhasil!","Dokumen berhasil Diunggah!","success");
                    setTimeout(function(){
                        $("#table_dokumen_mitra").bootstrapTable('refresh');
					    $('#BuatModal').modal('hide');
                    }, 1500);
				}else{
					Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Berkas gagal Diunggah!!',
                        footer: 'Note: Terjadi Kesalahan Dalam Proses Mengunggah!'
                    });
				}
			},
            // error:function(xhr,ajaxOptions,thrownError){
            //     alert("ERROR:" + xhr.responseText+" - "+thrownError);
            // }
		});
	}
</script>
