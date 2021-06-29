<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
//$db->debug=true;

$sql = "SELECT * FROM tc_pengajuan_dokumen WHERE id_tc_pengajuan = '$id'";
$hasil =& $db->Execute($sql);
$url_dokumen = $hasil->Fields('url_dokumen');
$id_mt_dokumen = $hasil->Fields('id_mt_dokumen');
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
        <table class="mb-0 table table-hover table-responsive">
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
                  <td>NPWP</td>
                  <?if($id_mt_dokumen==1 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="upNPWP()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">2</th>
                  <td>Surat Ijin</td>
                  <?if($id_mt_dokumen==2 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">3</th>
                  <td>TDP</td>
                  <?if($id_mt_dokumen==3 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">4</th>
                  <td>SK Direktur</td>
                  <?if($id_mt_dokumen==4 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">5</th>
                  <td>SPK/WO</td>
                  <?if($id_mt_dokumen==5 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
              <tr>
                  <th scope="row">6</th>
                  <td>Form Pengajuan</td>
                  <?if($id_mt_dokumen==9 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
                  <?}?>
              </tr>
            </tbody>
        </table>
        <div class="formInputSubmit">
    			<input type="reset" value="Close" class="btn btn-danger" data-dismiss="modal">
    		</div>
  		</form>
		</div>
	</div>
  <script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
  <script type="text/javascript" src="./assets/scripts/jquery-3.6.0.min.js"></script>
	<script>
    async function upNPWP(){
      const { value: file } = await Swal.fire({
        title: 'Unggah NPWP',
        input: 'file',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah Dokumen NPWP'
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
              file_data: e.target.result,
    					// file: file.name,
    					// file_type: file.type,
            },
            success:function(data){
  		        if(data.code != "500" ){
  		          Swal.fire({
  		            icon: 'success',
  		            title: 'Yayy...',
  		            text: 'Dokumen berhasil diunggah!!'
  		          })
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
