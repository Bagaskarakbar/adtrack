<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once("../_lib/function/db.php");
loadlib("function","function.pilihan_list");
loadlib("function","function.olah_tabel");
// loadlib("function","function.uang");

// $db->debug=true;
?>
<style media="screen">
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
	}
	input[type=number] {
			-moz-appearance:textfield;
			&:placeholder-shown + #btnReset{
		    opacity: 0;
		    pointer-events: none;
		  }
	}
	#btnReset{
    --size: 22px;
    position: absolute;
    border: none;
    display: block;
    width: var(--size);
    height: var(--size);
    line-height: var(--size);
    font-size: calc(var(--size) - 3px);
    border-radius: 50%;
    top: 0;
    bottom: 0;
    right: calc(var(--size)/2);
    margin: auto;
    background-color: salmon;
    color: white;
    padding: 0;
    outline: none;
    cursor: pointer;
    opacity: 0;
    transition: .1s;
  }
	span.idr {
    /* float:left;
    text-align:left; */
    position: relative;
	}

	span.idr::before {
	    position: absolute;
	    content: "Rp."; /* £ */
	    /* padding:3px 4px 3px 3px; */
			padding-left: 10px;
	    left: 0;
	    top:0;
	    bottom:0;
	}

	span.idr input {
    padding-left: 35px;
}
</style>
<div id="idContent">
<div class="card-header">List Projek
		<div class="btn-actions-pane-right" style="padding-right:10px;">
				<button class="btn-wide btn btn-info" onclick="am_form()"><i class="fa fa-plus"></i>  Proyek Baru</button>
		</div>
</div>
<div class="main-card mb-3 card">
	<div class="card-body">
		<div class="tab-content">
		<div class="table-responsive">
				<table class="table table-separate table-head-custom table-checkable" data-toggle="table" data-url="/01_am/get_index_view.php" data-pagination="true" data-trim-on-search="false"  data-search="true" data-sort-order="asc" data-side-pagination="server" data-total-field="count" data-data-field="items" id="kt_datatable1">
				<thead>
				<tr>
					<th data-field="no" >No.</th>
					<th data-field="nama_pelanggan" style="text-align:center;">Nama Pelanggan</th>
					<th data-field="jenis_pelanggan">Jenis Pelanggan</th>
					<th data-field="nama_layanan">Nama Layanan</th>
					<th data-field="paket_layanan">Paket Layanan</th>
					<th data-field="tgl_input">Tanggal Input</th>
					<th data-field="details" align="center">Aksi</th>
				</tr>
				</thead>

				</table>
		</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="./assets/scripts/sweetalert2@10.js"></script>
<script type="text/javascript" src="./assets/js/bot-ta/bootstrap-table.js"></script>
<script type="text/javascript" src="./assets/scripts/jquery-3.6.0.min.js"></script>
<script>
	function DetailProjek(a){
		$("#idContent").load('../01_am/projek_detail.php',{id:a});
	}
	function detail_form(){
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Something went wrong!',
				footer: '<a href>Why do I have this issue?</a>'
		})
	}

	function am_form(){
		var q1;
		var q2;
		var q3;
		var q4;

		const pages = ['1', '2', '3'];
		Swal.mixin({
		confirmButtonText: 'Selanjutnya &rarr;',
		confirmButtonColor: '#007bff',
		cancelButtonText:	'Batal',
		cancelButtonColor:	'#dc3545',
		reverseButtons:	true,
		focusConfirm: false,
		showCloseButton: true,
		progressSteps: pages
		}).queue([{
			title: 'Form General',
			html: `<label for="nama_am" style="text-align: left;float: left;">Nama AM</label>
				<input type="text" id="nama_am" class="swal2-input" placeholder="Nama AM" value="<?=$_SESSION['logininfo']['username']?>" disabled>
				<label for="unit" style="text-align: left;float: left;">Departemen/Unit</label>
				<select name="unit" id="unit" class="swal2-input">
					<option value="" disabled selected>Departemen/Unit</option>
					<?
					$getUnit="SELECT * FROM mt_unit ORDER BY id_mt_unit ASC";
					pilihan_list($getUnit,"nama_unit","id_mt_unit","id_mt_unit");
					?>
				</select>
				<label for="nama_pelanggan" style="text-align: left;float: left;">Nama Pelanggan</label>
				<input type="text" id="nama_pelanggan" class="swal2-input" placeholder="Nama Pelanggan">
				<label for="jenis_pelanggan" style="text-align: left;float: left;">Jenis Pelanggan</label>
				<select name="jenis_pelanggan" id="jenis_pelanggan" class="swal2-input">
					<option value="" disabled selected>Jenis Pelanggan</option>
					<?
					$getJenisPelanggan="SELECT * FROM mt_jenis_pelanggan ORDER BY id_mt_jenis_pelanggan ASC";
					pilihan_list($getJenisPelanggan,"jenis_pelanggan","id_mt_jenis_pelanggan","id_mt_jenis_pelanggan");
					?>
				</select>
				<label for="keterangan" style="text-align: left;float: left;">Keterangan</label>
				<textarea rows="4" cols="50" placeholder="Keterangan" class="swal2-textarea" id="keterangan"></textarea>`,
			preConfirm: ()=>{
				const nama_pelanggan = Swal.getPopup().querySelector('#nama_pelanggan').value
				const id_dd_user = <?=$_SESSION['logininfo']['id_dd_user']?>;
				const unit = Swal.getPopup().querySelector('#unit').value
				const jenis_pelanggan = Swal.getPopup().querySelector('#jenis_pelanggan').value
				const keterangan = Swal.getPopup().querySelector('#keterangan').value
				if(!unit){
					Swal.showValidationMessage(`Unit harus dipilih!!`)
				}
				if(!nama_pelanggan){
					Swal.showValidationMessage(`Nama Pelanggan harus dimasukan!!`)
				}
				if(!jenis_pelanggan){
					Swal.showValidationMessage(`Jenis Pelanggan harus dipilih!!`)
				}
				if(!keterangan){
					Swal.showValidationMessage(`Keterangan harus dimasukkan!!`)
				}
				var	arr1 = {
					id_dd_user: id_dd_user,
					unit: unit,
					nama_pelanggan: nama_pelanggan,
					jenis_pelanggan: jenis_pelanggan,
					keterangan: keterangan
				}
				q1=arr1;
				return{
					q1
				}
			}
		},
		{
			title: 'Form Detail',
			html: `	<label for="layanan" style="text-align: left;float: left;">Jenis Layanan</label>
					<select name="layanan" id="layanan" class="swal2-input" onchange="get_jenis_layanan()">
					<option value="" disabled selected>Jenis Layanan</option>
						<?
					  $getJenisLayanan="SELECT * FROM mt_layanan ORDER BY id_mt_layanan ASC";
					  pilihan_list($getJenisLayanan,"nama_layanan","id_mt_layanan","id_mt_layanan");
					 	?>
					</select>
					<label for="bundling" style="text-align: left;float: left;">Jenis Bundling</label>
					<select name="bundling" id="bundling" class="swal2-input">
					  <option value="" disabled selected>Jenis Bundling</option>
					  <?
					  $getJenisLayanan="SELECT * FROM mt_bundling ORDER BY id_mt_bundling ASC";
					  pilihan_list($getJenisLayanan,"nama_bundling","id_mt_bundling","id_mt_bundling");
					  ?>
					</select>
					<label for="paket_layanan" style="text-align: left;float: left;">Paket Layanan</label>
					<select name="paket_layanan" id="paket_layanan" class="swal2-input">
					  <option value="" disabled selected>Paket Layanan</option>
					  <option value="" disabled>Mohon Ditunggu...</option>
					</select>
					<label for="jenis_projek" style="text-align: left;float: left;">Jenis Proyek</label>
					<select name="jenis_projek" id="jenis_projek" class="swal2-input">
					  <option value="" disabled selected>Jenis Projek</option>
					  <?
					  $getJenisLayanan="SELECT * FROM mt_jenis_project ORDER BY id_mt_jenis_project ASC";
					  pilihan_list($getJenisLayanan,"jenis_project","id_mt_jenis_project","id_mt_jenis_project");
					  ?>
					</select>
					<label for="tgl_spk" style="text-align: left;float: left;">Tanggal SPK: </label><br><input type="text" id="tgl_spk" class="swal2-input" placeholder="Tanggal SPK | <?=date("m/d/Y")?>" onfocus="(this.type='date')">
					<label for="nomor" style="text-align: left;float: left;">Nomor: </label><br><input type="text" id="nomor" class="swal2-input" placeholder="Format: xx/xx/xx" style="max-width:none !important;">
					<label for="channel" style="text-align: left;float: left;">Channel</label>
					<select name="channel" id="channel" class="swal2-input">
					  <option value="" disabled selected>Channel</option>
						<?
					  $getChannel="SELECT * FROM mt_channel ORDER BY id_mt_channel ASC";
					  pilihan_list($getChannel,"nama_channel","id_mt_channel","id_mt_channel");
					  ?>
					</select>`,
			cancelButtonText:	'Kembali',
			preConfirm: ()=>{
				const layanan = Swal.getPopup().querySelector('#layanan').value
				const bundling = Swal.getPopup().querySelector('#bundling').value
				const paket_layanan = Swal.getPopup().querySelector('#paket_layanan').value
				const jenis_projek = Swal.getPopup().querySelector('#jenis_projek').value
				const tgl_spk = Swal.getPopup().querySelector('#tgl_spk').value
				const nomor = Swal.getPopup().querySelector('#nomor').value
				const channel = Swal.getPopup().querySelector('#channel').value
				if (!layanan) {
					Swal.showValidationMessage(`Jenis Layanan harus dipilih!!`)
				}
				if(!bundling){
					Swal.showValidationMessage(`Jenis Bundling harus dipilih!!`)
				}
				if(!paket_layanan){
					Swal.showValidationMessage(`Paket Layanan harus dipilih!!`)
				}
				if(!jenis_projek){
					Swal.showValidationMessage(`Jenis Projek harus dipilih!!`)
				}
				if (!tgl_spk) {
					Swal.showValidationMessage(`Tanggal SPK harus dimasukan!!`)
				}
				if(!nomor){
					Swal.showValidationMessage(`Nomor harus dimasukan!!`)
				}
				if(!channel){
					Swal.showValidationMessage(`Channel harus dipilih!!`)
				}
				var	arr2 = {
					layanan: layanan,
					bundling: bundling,
					paket_layanan:paket_layanan,
					jenis_projek: jenis_projek,
					tgl_spk: tgl_spk,
					nomor: nomor,
					channel: channel
				}
				q2=arr2;
				return{
					q2
				}
			}
		},
		{
			title: 'Form Kontrak',
			html: `
			<label for="lama_kontrak" style="text-align: left;float: left;">Lama Kontrak</label>
			<input type="number" id="lama_kontrak" class="swal2-input" placeholder="Lama Kontrak | Per Bulan" style="max-width:none !important;" onkeypress="checkNum(event)">
			<label for="span_dana" style="text-align: left;float: left;">Jumlah Dana</label>
			<span class="idr" id="span_dana">
			<input type="number" id="jumlah_dana" class="swal2-input" placeholder="Jumlah Dana" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="jumlah_term" style="text-align: left;float: left;">Jumlah Term</label>
			<select name="jumlah_term" id="jumlah_term" class="swal2-input" onchange="gantiTerm()">
					<option value="0" disabled selected>Jumlah Term</option>
					<option value="1">1 Term</option>
					<option value="2">2 Term</option>
					<option value="3">3 Term</option>
					<option value="4">4 Term</option>
					<option value="5">5 Term</option>
					<option value="6">6 Term</option>
			</select>
			<label for="span_term1" id="label_term1" style="text-align: left;float: left; display:none;">Termin 1</label>
			<span class="idr" id="span_term1" style="display: none;">
				<input type="number" id="term1" class="swal2-input" placeholder="Jumlah nominasi Term 1" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_term2" id="label_term2" style="text-align: left;float: left; display:none;">Termin 2</label>
			<span class="idr" id="span_term2" style="display: none;">
				<input type="number" id="term2" class="swal2-input" placeholder="Jumlah nominasi Term 2" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_term3" id="label_term3" style="text-align: left;float: left; display:none;">Termin 3</label>
			<span class="idr" id="span_term3" style="display: none;">
				<input type="number" id="term3" class="swal2-input" placeholder="Jumlah nominasi Term 3" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_term4" id="label_term4" style="text-align: left;float: left; display:none;">Termin 4</label>
			<span class="idr" id="span_term4" style="display: none;">
				<input type="number" id="term4" class="swal2-input" placeholder="Jumlah nominasi Term 4" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_term5" id="label_term5" style="text-align: left;float: left; display:none;">Termin 5</label>
			<span class="idr" id="span_term5" style="display: none;">
				<input type="number" id="term5" class="swal2-input" placeholder="Jumlah nominasi Term 5" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_term6" id="label_term6" style="text-align: left;float: left; display:none;">Termin 6</label>
			<span class="idr" id="span_term6" style="display: none;">
				<input type="number" id="term6" class="swal2-input" placeholder="Jumlah nominasi Term 6" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<input type="checkbox" id="cb_trans" name="cb_trans" value="1" class="swal2-checkbox hide_trans" onchange="checkedTrans()"><label for="cb_ri" class="hide_trans">Masukkan nilai transaksional?</label><br>
			<label for="span_trans_ri" id="label_ri" style="text-align: left;float: left; display:none;">Jumlah Transaksional RI</label>
			<span class="idr" id="span_trans_ri" style="display: none;">
				<input type="number" id="transaksional_ri" class="swal2-input" placeholder="Jumlah transaksional RI" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_trans_rj" id="label_rj" style="text-align: left;float: left; display:none;">Jumlah Transaksional RJ</label>
			<span class="idr" id="span_trans_rj" style="display: none;">
				<input type="number" id="transaksional_rj" class="swal2-input" placeholder="Jumlah transaksional RJ" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<label for="span_min_caps" id="label_caps" style="text-align: left;float: left; display:none;">Jumlah Minimum Caps</label>
			<span class="idr" id="span_min_caps" style="display: none;">
				<input type="number" id="min_caps" class="swal2-input" placeholder="Jumlah minimum caps" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>
			<input type="checkbox" id="cb_kso" name="cb_kso" value="1" class="swal2-checkbox hide_kso" onchange="checkedKSO()"><label for="cb_kso" class="hide_kso">Masukkan KSO Flat?</label><br>
			<label for="span_kso" id="label_kso" style="text-align: left;float: left; display:none;">Jumlah KSO Flat</label>
			<span class="idr" id="span_kso" style="display: none;">
				<input type="number" id="kso" class="swal2-input" placeholder="Jumlah KSO Flat" style="max-width:none !important;" onkeypress="checkNum(event)" inputMode="decimal" onFocus="this.type='number'; this.value=this.lastValue" onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString('id-ID')">
			</span>`,
			cancelButtonText:	'Kembali',
			confirmButtonText: 'Masukkan',
			preConfirm: ()=>{
				const lama_kontrak = Swal.getPopup().querySelector('#lama_kontrak').value
				const jumlah_dana = Swal.getPopup().querySelector('#jumlah_dana').value
				const jumlah_term = Swal.getPopup().querySelector('#jumlah_term').value
				const term1 = Swal.getPopup().querySelector('#term1').value
				const term2 = Swal.getPopup().querySelector('#term2').value
				const term3 = Swal.getPopup().querySelector('#term3').value
				const term4 = Swal.getPopup().querySelector('#term4').value
				const term5 = Swal.getPopup().querySelector('#term5').value
				const term6 = Swal.getPopup().querySelector('#term6').value
				const transaksional_ri = Swal.getPopup().querySelector('#transaksional_ri').value
				const transaksional_rj = Swal.getPopup().querySelector('#transaksional_rj').value
				const min_caps = Swal.getPopup().querySelector('#min_caps').value
				const kso = Swal.getPopup().querySelector('#kso').value
				if(!lama_kontrak){
					Swal.showValidationMessage(`Lama Kontrak harus dimasukan!!`)
				}
				if(!jumlah_dana){
					Swal.showValidationMessage(`Jumlah Dana harus dimasukan!!`)
				}
				if(!jumlah_term){
					Swal.showValidationMessage(`Jumlah Term harus dipilih!!`)
				}
				var	arr3 = {
					lama_kontrak: lama_kontrak,
					jumlah_dana: jumlah_dana,
					term1: term1,
					term2: term2,
					term3: term3,
					term4: term4,
					term5: term5,
					term6: term6,
					transaksional_ri: transaksional_ri,
					transaksional_rj: transaksional_rj,
					min_caps: min_caps,
					kso: kso
				}
				q3=arr3;
				return{
					q3
				}
			}
		},
		// {
		// 	title: 'Form Dokumen',
		// 	html: `<form id="formDokumen" action="#" method="post" enctype="multipart/form-data">
		// 	<label for="npwp">npwp: </label>&nbsp;<input type="file" accept="application/pdf,image/png" class="swal2-file" id="npwp" name="npwp" style="max-width:60% !important;"><br>
		// 	<label for="surat_ijin">Surat Ijin: </label>&nbsp;<input type="file" accept="application/pdf,image/png" class="swal2-file" id="surat_ijin" name="surat_ijin" style="max-width:60% !important;"><br>
		// 	<label for="tdp">TDP: </label>&nbsp;<input type="file" accept="application/pdf,image/png" class="swal2-file" id="tdp" name="tdp" style="max-width:60% !important;"><br>
		// 	<label for="sk_direktur">SK Direktur: </label>&nbsp;<input type="file" accept="application/pdf,image/png" class="swal2-file" id="sk_direktur" name="sk_direktur" style="max-width:60% !important;"><br>
		// 	<label for="spk_wo">SPK/WO: </label>&nbsp;<input type="file" accept="application/pdf,image/png" class="swal2-file" id="spk_wo" name="spk_wo" style="max-width:60% !important;"><br>
		// 	<label for="form_pengajuan">Form Pengajuan: </label>&nbsp;<input type="file" accept="application/pdf,image/png" class="swal2-file" id="form_pengajuan" name="form_pengajuan" style="max-width:60% !important;"><br>
		// 	</form>`,
		// 	confirmButtonText: 'Masukkan',
		// 	cancelButtonText:	'Kembali',
		// 	preConfirm: ()=>{
		// 		const npwp = Swal.getPopup().querySelector('#npwp').value
		// 		var ext_npwp = npwp.split('/').pop().split('.')[1];
		// 		const surat_ijin = Swal.getPopup().querySelector('#surat_ijin').value
		// 		var ext_surat_ijin = surat_ijin.split('/').pop().split('.')[1];
		// 		const tdp = Swal.getPopup().querySelector('#tdp').value
		// 		var ext_tdp = tdp.split('/').pop().split('.')[1];
		// 		const sk_direktur = Swal.getPopup().querySelector('#sk_direktur').value
		// 		var ext_sk_direktur = sk_direktur.split('/').pop().split('.')[1];
		// 		const spk_wo = Swal.getPopup().querySelector('#spk_wo').value
		// 		var ext_spk_wo = spk_wo.split('/').pop().split('.')[1];
		// 		const form_pengajuan = Swal.getPopup().querySelector('#form_pengajuan').value
		// 		var ext_form_pengajuan = form_pengajuan.split('/').pop().split('.')[1];
		// 		if(!spk_wo){
		// 			Swal.showValidationMessage(`SPK/WO harus dimasukan!!`)
		// 		}
		// 		if(!form_pengajuan){
		// 			Swal.showValidationMessage(`Form Pengajuan harus dipilih!!`)
		// 		}
		// 		var	arr4 = {
		// 			npwp: npwp,
		// 			ext_npwp: ext_npwp,
		// 			surat_ijin: surat_ijin,
		// 			ext_surat_ijin: ext_surat_ijin,
		// 			tdp: tdp,
		// 			ext_tdp: ext_tdp,
		// 			sk_direktur: sk_direktur,
		// 			ext_sk_direktur: ext_sk_direktur,
		// 			spk_wo: spk_wo,
		// 			ext_spk_wo: ext_spk_wo,
		// 			form_pengajuan: form_pengajuan,
		// 			ext_form_pengajuan: ext_form_pengajuan
		// 		}
		// 		q4=arr4;
		// 		return{
		// 			q4
		// 		}
		// 	}
		// },
		]).then(function(result){
		  if(result.value){
		    $.ajax({
		      method:"POST",
		      dataType:"json",
		      url:'/01_am/am_form_act.php',
		      data:{q1,q2,q3},
					// cache: false,
					// contentType: false,
					// processData: false,
					// xhr: function () {
					//   var myXhr = $.ajaxSettings.xhr();
					//   if (myXhr.upload) {
					// 		myXhr.upload.addEventListener('progress', function (e) {
					// 			if (e.lengthComputable) {
					// 				$('progress').attr({
					// 		  		value: e.loaded,
					// 		  		max: e.total,
					// 				});
					// 	  	}
					// 		}, false);
					//   }
					//   return myXhr;
					// },
		      success:function(data){
		        if(data.code != "500" ){
		          Swal.fire({
		            icon: 'success',
		            title: 'Yayy...',
		            text: 'Data berhasil dimasukan!!'
		          })
		        }else{
		          Swal.fire({
		          icon: 'error',
		          title: 'Oops...',
		          text: 'Data gagal dimasukan!!',
		          footer: 'Note: Terjadi kesalahan saat memasukan data!!'
		          })
		        }
		      },
		      // error:function(xhr,ajaxOptions,thrownError){
		      //   alert("ERROR:" + xhr.responseText+" - "+thrownError);
		      // }
		    })
		  }else{
		    Swal.fire({
		    icon: 'error',
		    title: 'Oops...',
		    text: 'Data gagal dimasukan!!',
		    footer: 'Note: Proses Dibatalkan oleh user!'
		    })
		  }
		})
  }

	function checkNum(evt) {
		var theEvent = evt || window.event;
		if (theEvent.type === 'paste') {
				key = event.clipboardData.getData('text/plain');
		} else {
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode(key);
		}
		var regex = /[0-9]|\./;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}

  function checkedTrans(){
    if($("#cb_trans").is(":checked")){
    		$('#label_rj').show();
			$("#span_trans_rj").show();
			$('#label_ri').show();
			$("#span_trans_ri").show();
			$('#label_caps').show();
			$("#span_min_caps").show();
			$(".hide_kso").hide();
			$('#label_kso').hide();
			$("#span_kso").hide();
    }else{
    		$('#label_rj').hide();
			$("#span_trans_rj").hide();
			$('#label_ri').hide();
			$("#span_trans_ri").hide();
			$('#label_caps').hide();
			$("#span_min_caps").hide();
			$(".hide_kso").show();
    }
  }

	function checkedKSO(){
    if($("#cb_kso").is(":checked")){
    		$('#label_kso').show();
			$("#span_kso").show();
			$('#label_rj').hide();
			$("#span_trans_rj").hide();
			$('#label_ri').hide();
			$("#span_trans_ri").hide();
			$('#label_caps').hide();
			$("#span_min_caps").hide();
			$(".hide_trans").hide();
    }else{
    		$('#label_kso').hide();
			$("#span_kso").hide();
			$(".hide_trans").show();
    }
  }

	function gantiTerm(){
		var jumlah_term=$('#jumlah_term').val();
		if(jumlah_term=='1'){
			if(($('#term1').css('visibility') === 'hidden')){
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').hide();
				$('#label_term2').hide();
				$('#span_term3').hide();
				$('#label_term3').hide();
				$('#span_term4').hide();
				$('#label_term4').hide();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}else{
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').hide();
				$('#label_term2').hide();
				$('#span_term3').hide();
				$('#label_term3').hide();
				$('#span_term4').hide();
				$('#label_term4').hide();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
				$('#span_term6').hide();
			}
		}else if(jumlah_term=='2'){
			if(($('#term2').css('visibility') === 'hidden')){
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').hide();
				$('#label_term3').hide();
				$('#span_term4').hide();
				$('#label_term4').hide();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}else{
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').hide();
				$('#label_term3').hide();
				$('#span_term4').hide();
				$('#label_term4').hide();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}
		}else if(jumlah_term=='3'){
			if(($('#term3').css('visibility') === 'hidden')){
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').hide();
				$('#label_term4').hide();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}else{
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').hide();
				$('#label_term4').hide();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}
		}else if(jumlah_term=='4'){
			if(($('#term4').css('visibility') === 'hidden')){
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').show();
				$('#label_term4').show();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}else{
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').show();
				$('#label_term4').show();
				$('#span_term5').hide();
				$('#label_term5').hide();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}
		}else if(jumlah_term=='5'){
			if(($('#term5').css('visibility') === 'hidden')){
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').show();
				$('#label_term4').show();
				$('#span_term5').show();
				$('#label_term5').show();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}else{
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').show();
				$('#label_term4').show();
				$('#span_term5').show();
				$('#label_term5').show();
				$('#span_term6').hide();
				$('#label_term6').hide();
			}
		}else{
			if(($('#term6').css('visibility') === 'hidden')){
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').show();
				$('#label_term4').show();
				$('#span_term5').show();
				$('#label_term5').show();
				$('#span_term6').show();
				$('#label_term6').show();
			}else{
				$('#span_term1').show();
				$('#label_term1').show();
				$('#span_term2').show();
				$('#label_term2').show();
				$('#span_term3').show();
				$('#label_term3').show();
				$('#span_term4').show();
				$('#label_term4').show();
				$('#span_term5').show();
				$('#label_term5').show();
				$('#span_term6').show();
				$('#label_term6').show();
			}
		}
	}

	function get_jenis_layanan(){
		var id_mt_layanan=$('#layanan').val();
		$('#paket_layanan').load('../01_am/get_jenis_layanan.php',{id_mt_layanan:id_mt_layanan});
	}
</script>
