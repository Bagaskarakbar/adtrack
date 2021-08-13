<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
//$db->debug=true;

$sql = "SELECT * FROM tc_transaksi_dokumen WHERE id_tc_transaksi = '$id'";
$hasil=$db->Execute($sql);
while($tpl_hasil=$hasil->FetchRow()){
	$url_dokumen			=$tpl_hasil["url_dokumen"];
	$id_mt_dokumen		=$tpl_hasil["id_mt_dokumen"];
}
?>

	<div id="isiUtama">
		<div class="modal-header register-modal-head" style="background-color:#d82550">
			<h5 class="modal-title" style="color:white">Daftar Dokumen</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card-body" id="tab_frame">
  		<form name="formListDokumen" id="formListDokumen" method="post" action="#" enctype="multipart/form-data">
        <table class="mb-0 table table-hover">
            <thead>
              <tr>
                  <th>No</th>
                  <th>Tipe Dokumen</th>
                  <th>Status</th>
                  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <th scope="row">1</th>
                  <td>Perintah Tagih</td>
                  <?if($id_mt_dokumen==19 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button type="button" class="mb-2 mr-2 btn btn-info" onClick="insert_perintah_tagih()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">2</th>
                  <td>Kwitansi</td>
                  <?if($id_mt_dokumen==25 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button type="button" class="mb-2 mr-2 btn btn-info" onClick="insert_kwitansi()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">3</th>
                  <td>Faktur Pajak</td>
                  <?if($id_mt_dokumen==26 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button type="button" class="mb-2 mr-2 btn btn-info" onClick="insert_faktur_pajak()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
            </tbody>
        </table>
				<!-- <table class="mb-0 table table-hover">
						<thead>
							<tr>
									<th>No</th>
									<th>Tipe Dokumen</th>
									<th>Status</th>
									<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
									<th scope="row">1</th>
									<td>Perintah Tagih</td>
									<td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
									<td><button type="button" class="mb-2 mr-2 btn btn-info" onClick="insert_perintah_tagih()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
							</tr>
							<tr>
									<th scope="row">2</th>
									<td>Kwitansi</td>
									<td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
									<td></td>
							</tr>
							<tr>
									<th scope="row">3</th>
									<td>Faktur Pajak</td>
									<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
									<td>-</td>
							</tr>
						</tbody>
				</table> -->
        <div class="formInputSubmit">
    			<input type="reset" value="Close" class="btn btn-danger" data-dismiss="modal">
    		</div>
  		</form>
		</div>
	</div>
  <script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
	<script>
    async function insert_perintah_tagih(){
      const { value: file } = await Swal.fire({
        title: 'Unggah Perintah Tagih',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah Perintah Tagih'
        }
      })

      if (file) {
        const reader = new FileReader()
        reader.onloadend = (e) => {
          if ( e.target.readyState !== FileReader.DONE ) {
    				return;
    			}
          $.ajax({
            type:'post',
            dataType:'json',
            cache:'false',
            data:{
              bin_perintah_tagih: e.target.result,
							// id_tc_transaksi_perintah_tagih:<?//=$id?>
    					// file: file.name,
    					// file_type: file.type,
            },
						url:'/09_mitra/mitra_form_act.php',
            success:function(data){
  		        if(data.code != "500" ){
  		          Swal.fire({
  		            icon: 'success',
  		            title: 'Yayy...',
  		            text: 'Dokumen berhasil diunggah!!'
  		          })
								$('#BuatModal').modal('hide');
								$('.modal-backdrop').hide();
  		        }else{
  		          Swal.fire({
  		          icon: 'error',
  		          title: 'Oops...',
  		          text: 'Dokumen gagal diunggah!!',
  		          footer: 'Note: Terjadi kesalahan saat memasukan data!!'
  		          })
  		        }
  		      },
  		      // error:function(xhr,ajaxOptions,thrownError){
  		      //   alert("ERROR:" + xhr.responseText+" - "+thrownError);
  		      // }
          });
        }
        reader.readAsDataURL(file)
      }
    }

		async function insert_kwitansi(){
      const { value: file } = await Swal.fire({
        title: 'Unggah Kwitansi',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah Kwitansi'
        }
      })

      if (file) {
        const reader = new FileReader()
        reader.onloadend = (e) => {
          if ( e.target.readyState !== FileReader.DONE ) {
    				return;
    			}
          $.ajax({
            type:'post',
            dataType:'json',
            cache:'false',
            data:{
              bin_kwitansi: e.target.result,
							// id_tc_transaksi_kwitansi:<?//=$id?>
    					// file: file.name,
    					// file_type: file.type,
            },
						url:'/09_mitra/mitra_form_act.php',
            success:function(data){
  		        if(data.code != "500" ){
  		          Swal.fire({
  		            icon: 'success',
  		            title: 'Yayy...',
  		            text: 'Dokumen berhasil diunggah!!'
  		          })
								$('#BuatModal').modal('hide');
								$('.modal-backdrop').hide();
  		        }else{
  		          Swal.fire({
  		          icon: 'error',
  		          title: 'Oops...',
  		          text: 'Dokumen gagal diunggah!!',
  		          footer: 'Note: Terjadi kesalahan saat memasukan data!!'
  		          })
  		        }
  		      },
  		      // error:function(xhr,ajaxOptions,thrownError){
  		      //   alert("ERROR:" + xhr.responseText+" - "+thrownError);
  		      // }
          });
        }
        reader.readAsDataURL(file)
      }
    }

		async function insert_faktur_pajak(){
      const { value: file } = await Swal.fire({
        title: 'Unggah Faktur Pajak',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah Perintah Tagih'
        }
      })

      if (file) {
        const reader = new FileReader()
        reader.onloadend = (e) => {
          if ( e.target.readyState !== FileReader.DONE ) {
    				return;
    			}
          $.ajax({
            type:'post',
            dataType:'json',
            cache:'false',
            data:{
              bin_faktur_pajak: e.target.result,
							// id_tc_transaksi_faktur_pajak:<?//=$id?>
    					// file: file.name,
    					// file_type: file.type,
            },
						url:'/09_mitra/mitra_form_act.php',
            success:function(data){
  		        if(data.code != "500" ){
  		          Swal.fire({
  		            icon: 'success',
  		            title: 'Yayy...',
  		            text: 'Dokumen berhasil diunggah!!'
  		          })
								$('#BuatModal').modal('hide');
								$('.modal-backdrop').hide();
  		        }else{
  		          Swal.fire({
  		          icon: 'error',
  		          title: 'Oops...',
  		          text: 'Dokumen gagal diunggah!!',
  		          footer: 'Note: Terjadi kesalahan saat memasukan data!!'
  		          })
  		        }
  		      },
  		      // error:function(xhr,ajaxOptions,thrownError){
  		      //   alert("ERROR:" + xhr.responseText+" - "+thrownError);
  		      // }
          });
        }
        reader.readAsDataURL(file)
      }
    }
	</script>
