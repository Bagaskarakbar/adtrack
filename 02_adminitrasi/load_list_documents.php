<?
session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.variabel");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
//$db->debug=true;

$sql = "SELECT * FROM tc_pengajuan_dokumen WHERE id_tc_pengajuan = '$id'";
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
                  <td>NPWP</td>
                  <?if($id_mt_dokumen==1 && $url_dokumen!=""){?>
                    <td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
                    <td>-</td>
                  <?}else{?>
                    <td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="insert_NPWP()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
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
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="insert_SI()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
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
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="insert_TDP()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
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
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="insert_sk_dir()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
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
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="insert_SPK_WO()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
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
                    <td><button class="mb-2 mr-2 btn btn-info" onClick="insert_FORM_PENGAJUAN()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
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
									<td>NPWP</td>
									<td><button class="mb-2 mr-2 btn btn-info" onClick="insert_NPWP()"><i class="fa fa-fw fa-upload" aria-hidden="true" title="upload file"></i></button></td>
									<td>-</td>
							</tr>
							<tr>
									<th scope="row">2</th>
									<td>Surat Ijin</td>
									<td><i class="fa fa-fw fa-times" aria-hidden="true" title="belum upload" style="color:#cc0000"></i></td>
									<td></td>
							</tr>
							<tr>
									<th scope="row">3</th>
									<td>TDP</td>
									<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
									<td>-</td>
							</tr>
							<tr>
									<th scope="row">4</th>
									<td>SK Direktur</td>
									<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
									<td>-</td>
							</tr>
							<tr>
									<th scope="row">5</th>
									<td>SPK/WO</td>
									<td><i class="fa fa-fw fa-check" aria-hidden="true" title="sudah upload" style="color:#00b200"></i></td>
									<td>-</td>
							</tr>
							<tr>
									<th scope="row">6</th>
									<td>Form Pengajuan</td>
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
    async function insert_NPWP(){
			event.preventDefault();
      const { value: file } = await Swal.fire({
        title: 'Unggah NPWP',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah NPWP'
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
              bin_npwp: e.target.result,
							id_tc_pengajuan_npwp:<?=$id?>
    					// file: file.name,
    					// file_type: file.type,
            },
						url:'/02_adminitrasi/admin_form_act.php',
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

		async function insert_SI(){
			event.preventDefault();
      const { value: file } = await Swal.fire({
        title: 'Unggah Surat Ijin',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah Surat Ijin'
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
              bin_si: e.target.result,
							id_tc_pengajuan_si:<?=$id?>
            },
						url:'/02_adminitrasi/admin_form_act.php',
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
  		      }
          });
        }
        reader.readAsDataURL(file)
      }
    }

		async function insert_TDP(){
			event.preventDefault();
      const { value: file } = await Swal.fire({
        title: 'Unggah TDP',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah TDP'
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
              bin_tdp: e.target.result,
							id_tc_pengajuan_tdp:<?=$id?>
            },
						url:'/02_adminitrasi/admin_form_act.php',
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
          });
        }
        reader.readAsDataURL(file)
      }
    }

		async function insert_sk_dir(){
			event.preventDefault();
      const { value: file } = await Swal.fire({
        title: 'Unggah SK Direktur',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah SK Direktur'
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
              bin_sk_dir: e.target.result,
    					id_tc_pengajuan_sk_dir:<?=$id?>
            },
						url:'/02_adminitrasi/admin_form_act.php',
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
          });
        }
        reader.readAsDataURL(file)
      }
    }

		async function insert_SPK_WO(){
			event.preventDefault();
      const { value: file } = await Swal.fire({
        title: 'Unggah SPK/WO',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah SPK/WO'
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
              bin_spk_wo: e.target.result,
    					id_tc_pengajuan_spk_wo:<?=$id?>
            },
						url:'/02_adminitrasi/admin_form_act.php',
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
          });
        }
        reader.readAsDataURL(file)
      }
    }

		async function insert_FORM_PENGAJUAN(){
			event.preventDefault();
      const { value: file } = await Swal.fire({
        title: 'Unggah Form Pengajuan',
        input: 'file',
				confirmButtonText: 'Masukkan',
        inputAttributes: {
          'accept': 'application/pdf',
          'aria-label': 'Silahkan Unggah Form Pengajuan'
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
              bin_form_pengajuan: e.target.result,
    					id_tc_pengajuan_form_pengajuan:<?=$id?>
            },
						url:'/02_adminitrasi/admin_form_act.php',
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
          });
        }
        reader.readAsDataURL(file)
      }
    }
	</script>
