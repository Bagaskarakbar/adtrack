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

$case="update";
$sql="SELECT * FROM tc_transaksi_dokumen WHERE id_tc_transaksi_dokumen = $id_dokumen";
$hasil=$db->Execute($sql);
$url_dokumen=$hasil->Fields("url_dokumen");
$id_mt_dokumen = $hasil->Fields("id_mt_dokumen");
$keterangan = $hasil->Fields("keterangan");
?>
<style type="text/css">
#dokumen_mitra {
	display: none;
}

#pdf-main-container {
	width: 400px;
	margin: 20px auto;
}

#pdf-loader {
	display: none;
	text-align: center;
	color: #999999;
	font-size: 13px;
	line-height: 100px;
	height: 100px;
}

#pdf-contents {
	display: none;
}

#pdf-meta {
	overflow: hidden;
	margin: 0 0 20px 0;
}

#pdf-buttons {
	float: left;
}

#page-count-container {
	float: right;
}

#pdf-current-page {
	display: inline;
}

#pdf-total-pages {
	display: inline;
}

#pdf-canvas {
	border: 1px solid rgba(0,0,0,0.2);
	box-sizing: border-box;
}

#page-loader {
	height: 100px;
	line-height: 100px;
	text-align: center;
	display: none;
	color: #999999;
	font-size: 13px;
}

#download-image {
	width: 150px;
	display: block;
	margin: 20px auto 0 auto;
	font-size: 13px;
	text-align: center;
}
</style>
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
							pilihan_list($sql_dokumen,"tipe_dokumen","id_mt_dokumen","id_mt_dokumen",$id_mt_dokumen);
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
                        <textarea id="keterangan_dokumen" name="keterangan_dokumen" rows="4" cols="46" placeholder="isi keterangan..."><?=$keterangan?></textarea>
					</div>
				</div>
                 <br>
                
				<div class="row">
					<div class="col-lg-4">
						<label>Upload Dokumen <?=mandatory();?></label>
					</div>
					<div class="col-lg-8">
						<button type="button" class="btn-wide btn btn-info" id="upload-button"><i class="fa fa-plus"></i> Pilih Dokumen</button>
						<input type="file" class="form-control" accept="application/pdf"  id="dokumen_mitra" name="dokumen_mitra" value="<?=$url_dokumen?>">
					</div>
				</div>
                 <br>
				 
				 <div id="pdf-main-container">
					<div id="pdf-loader">Memuat Dokumen ...</div>
					<div id="pdf-contents">
						<div id="pdf-meta">
							<div id="pdf-buttons">
								<button id="pdf-prev">Previous</button>
								<button id="pdf-next">Next</button>
							</div>
							<div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
						</div>
						<canvas id="pdf-canvas" width="400"></canvas>
						<div id="page-loader">Loading page ...</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-4"></div>	
					<div class="col-lg-8" id="loadDokumen"></div>
				</div>

                <input type="hidden" name="id_dokumen" value="<?=$id_dokumen?>">
                <input type="hidden" name="case" value="<?=$case?>">
				<input type="hidden" id="id_tc_transaksi" name="id_tc_transaksi" value="<?=$id?>">
				<br>

				<div class="row">
					<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="update_documents_mitra()">Masukkan</button>
							<button type="button" class="btn btn-danger font-weight-bolder font-size-sm" data-dismiss="modal">Batal</button>
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>	
    <br>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script> -->
<script src="./assets/js/PDF.js/pdf.min.js"></script>
<script src="./assets/js/PDF.js/pdf.worker.min.js"></script>
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
<script type="text/javascript">
	function back(){
		$("#insertDocsModal").load("/09_mitra/index.php");
	}

	function update_documents_mitra(){
		var dataform=$("#idTambahDokumen").serialize();
		$.ajax({
			type: "POST",
            dataType: "json",
			url:'/09_mitra/mitra_form_act.php',
			data: dataform,
			success: function(data){
				if(data.code=='200'){
                    Swal.fire("Berhasil!","Dokumen berhasil Diperbaharui!","success");
                    setTimeout(function(){
                        $("#table_dokumen_mitra").bootstrapTable('refresh');
					    $('#BuatModal').modal('hide');
                    }, 1500);
				}else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Berkas gagal Diperbaharui!!',
                        footer: 'Note: Terjadi Kesalahan Dalam Proses Memperbaharui!'
                    });
				}
			},
            // error:function(xhr,ajaxOptions,thrownError){
            //     alert("ERROR:" + xhr.responseText+" - "+thrownError);
            // }
		});
	}
</script>
<script>
var _PDF_DOC,
    _CURRENT_PAGE,
    _TOTAL_PAGES,
    _PAGE_RENDERING_IN_PROGRESS = 0,
    _CANVAS = document.querySelector('#pdf-canvas');

// memuat pdf
async function showPDF(pdf_url) {
    document.querySelector("#pdf-loader").style.display = 'block';

    try {
        _PDF_DOC = await pdfjsLib.getDocument({ url: pdf_url });
    }
    catch(error) {
        // alert(error.message);
    }

    // hitung jumlah halaman pdf
    _TOTAL_PAGES = _PDF_DOC.numPages;
    
    // Hide pdf loader dan show pdf container
    document.querySelector("#pdf-loader").style.display = 'none';
    document.querySelector("#pdf-contents").style.display = 'block';
    document.querySelector("#pdf-total-pages").innerHTML = _TOTAL_PAGES;

    // show halaman pertama
    showPage(1);
}

// Proses pdf
async function showPage(page_no) {
    _PAGE_RENDERING_IN_PROGRESS = 1;
    _CURRENT_PAGE = page_no;

    // disable prev & next button saat lagi loading pdf
    document.querySelector("#pdf-next").disabled = true;
    document.querySelector("#pdf-prev").disabled = true;

    // Tampilkan Pesan memuat pdf
    document.querySelector("#pdf-canvas").style.display = 'none';
    document.querySelector("#page-loader").style.display = 'block';

    // update buat current page
    document.querySelector("#pdf-current-page").innerHTML = page_no;
    
    try {
        var page = await _PDF_DOC.getPage(page_no);
    }
    catch(error) {
        // alert(error.message);
    }

    var pdf_original_width = page.getViewport(1).width;
 
    var scale_required = _CANVAS.width / pdf_original_width;

    var viewport = page.getViewport(scale_required);

    _CANVAS.height = viewport.height;

    // pengaturan buat pdf
    document.querySelector("#page-loader").style.height =  _CANVAS.height + 'px';
    document.querySelector("#page-loader").style.lineHeight = _CANVAS.height + 'px';

    var render_context = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
    };
    
    try {
        await page.render(render_context);
    }
    catch(error) {
        // alert(error.message);
    }

    _PAGE_RENDERING_IN_PROGRESS = 0;

    document.querySelector("#pdf-next").disabled = false;
    document.querySelector("#pdf-prev").disabled = false;

    // show pilihan buat next, prev dan current page pdf
    document.querySelector("#pdf-canvas").style.display = 'block';
    document.querySelector("#page-loader").style.display = 'none';
	document.querySelector("#pdf-meta").style.display = 'none';
}
document.querySelector("#upload-button").addEventListener('click', function() {
	$("#dokumen_mitra").trigger('click');
});

// pilih file pdf
document.querySelector("#dokumen_mitra").addEventListener('change', function() {
    if(['application/pdf'].indexOf($("#dokumen_mitra").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }

	// $("#upload-button").hide();
	showPDF(URL.createObjectURL($("#dokumen_mitra").get(0).files[0]));
});

// click on "Show PDF" buuton
// document.querySelector("#show-pdf-button").addEventListener('click', function() {
//     this.style.display = 'none';
//     showPDF('https://mozilla.github.io/pdf.js/web/compressed.tracemonkey-pldi-09.pdf');
// });

//function buat prev button
document.querySelector("#pdf-prev").addEventListener('click', function() {
    if(_CURRENT_PAGE != 1)
        showPage(--_CURRENT_PAGE);
});

//function buat next button
document.querySelector("#pdf-next").addEventListener('click', function() {
    if(_CURRENT_PAGE != _TOTAL_PAGES)
        showPage(++_CURRENT_PAGE);
});
</script>