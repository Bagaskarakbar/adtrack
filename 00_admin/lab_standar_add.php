<?
	session_start();
	/**
	 *
	 * Mendeklarasikan librari-librari dasar
	 *
	 */	 
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.pilihan_list");
	loadlib("function","function.olah_tabel");
	loadlib("function","function.uang");
	loadlib("function", "function.input_uang");
	//$db->debug=true;

	$sql = "SELECT * FROM pm_mt_standarhasil WHERE kode_mt_hasilpm='".$kode_mt_hasilpm."'";

	$hasil =& $db->Execute($sql);

	$kode_mt_hasilpm = $hasil->Fields('kode_mt_hasilpm');
	$kode_tarif = $hasil->Fields('kode_tarif');
	$nama_pemeriksaan = $hasil->Fields('nama_pemeriksaan');
	$kode_bagian = $hasil->Fields('kode_bagian');
	$standar_hasil_wanita = $hasil->Fields('standar_hasil_wanita');
	$standar_hasil_pria = $hasil->Fields('standar_hasil_pria');
	$standar_hasil_wanita_min = $hasil->Fields('standar_hasil_wanita_min');
	$standar_hasil_wanita_max = $hasil->Fields('standar_hasil_wanita_max');
	$keterangan = $hasil->Fields('keterangan');
	$satuan = $hasil->Fields('satuan');
	$nama_tindakan=baca_tabel("mt_master_tarif","nama_tarif","where kode_tarif='".$kode_tarif."'");
	
	
	
		
$sqlCari = "SELECT * FROM mt_master_tarif WHERE kode_bagian='050101' AND tingkatan=5";
$hasilCari =& $db->Execute($sqlCari);

		while ($tampil=$hasilCari->FetchRow()) {
			$i++;
			$nama_tarif = $tampil["nama_tarif"]."-".$tampil["kode_tarif"];
			$kode_tarif = $tampil["kode_tarif"];
			
			$arrTarif[]=$nama_tarif." | ".$kode_tarif;

		}
	
	
	
?>

<style>
	html{
		<!--overflow: hidden;-->
	}
	.autocomplete{
		position: relative;
		display: inline-block;
	}
	.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		z-index: 99;
		top: 100%;
		left: 0;
		right: 0;
	}
	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff;
		border-bottom: 1px solid #d4d4d4;
	}
	.autocomplete-items div:hover {
		background-color: #e9e9e9;
	}
	.autocomplete-active {
		background-color: DodgerBlue !important;
		color: #ffffff;
	}
	.content{
		padding: 0 0 25px 0;
	}
	.header-fixed.subheader-fixed.subheader-enabled .wrapper {
		padding-top: 90px;
	}
	#daftar_baru{
		padding-right: 40%!important; 
		text-align: center;
	}
</style>


<div id="FormTambahRadiologi">
		
			<form id="FormAddLab" method="POST" enctype="multipart/form-data">
			
			<div id="content">
					<div class="modal-header register-modal-head" style="background-color:#2b345f">
						<h5 class="modal-title" style="color:white"><b>Tambah Labolatorium</b></h5>
						<button type="button" class="btn btn-danger"  style="color:white" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-times" aria-hidden="true"></i>
					</button>
					</div>
		
			<div class="col-sm-12">
				<br>
					<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Nama Pemeriksaan</label>
							</div>
							<div class="col-lg-8">
						
								<input type="text" class="form-control" name="nama_tarif" size='30' id="generalSearch">
								<input type="hidden" name="kode_tarif" id="idKodeTarif">
								
							</div>

					</div>
						<br>

						<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Nama Detail Pemeriksaan</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="nama_pemeriksaan"  value="<?= $nama_pemeriksaan ?>">
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Detail Item(1)</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="detail_item_1" value="<?= $detail_item_1 ?>">
							</div>
					</div>
					<br>	

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Detail Item(2)</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="detail_item_2" value="<?= $detail_item_2 ?>" >
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Wanita</label>
							</div>
							<div class="col-lg-8">
								
								<TEXTAREA class="form-control" NAME="standar_hasil_wanita"  ROWS="4" COLS="70"><?=$standar_hasil_wanita?></TEXTAREA>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Wanita Minimal</label>
							</div>
							<div class="col-lg-8">
								
								<input type="text" name="standar_hasil_wanita_min" class="form-control" value="<?= $standar_hasil_wanita_min ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Wanita Maximal</label>
							</div>
							<div class="col-lg-8">
								
								<input type="text" class="form-control" name="standar_hasil_wanita_max" value="<?= $standar_hasil_wanita_max ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Pria</label>
							</div>
							<div class="col-lg-8">
								<TEXTAREA type="text" class="form-control" NAME="standar_hasil_pria"  ></TEXTAREA>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Pria Minimal</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="standar_hasil_pria_min" value="<?= $standar_hasil_pria_min ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Standar Hasil Pria Maximal</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="standar_hasil_pria_max" value="<?= $standar_hasil_pria_max ?>"/>
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Satuan</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="satuan" value="<?= $satuan ?>"/>
							</div>
					</div>
					<br>


					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Satuan Umur</label>
							</div>
							<div class="col-lg-8">
										<select name="satuan_umur_mulai" class="form-control">
											<?
												$sql_umur="SELECT * FROM dd_mktime WHERE id_dd_mktime <= 4";
												pilihan_list($sql_umur,"satuan","id_dd_mktime","id_dd_mktime",$satuan_umur_mulai);
											?>
											</select>
							</div>
					</div>
					<br>	


					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Umur mulai</label>
							</div>
							<div class="col-lg-8">
										<input type="text" class="form-control" name="umur_mulai" value="<?= $umur_mulai ?>" />
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Umur akhir</label>
							</div>
							<div class="col-lg-8">
										<input type="text" class="form-control" name="umur_akhir" value="<?= $umur_akhir ?>" />
							</div>
					</div>
					<br>

					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Keterangan</label>
							</div>
							<div class="col-lg-8">
											<TEXTAREA  class="form-control" NAME="keterangan" ><?=$keterangan?></TEXTAREA>
							</div>
					</div>
					<br>
			
					
					<!--------------------------------------------------------------------------------------------------->

					<!--------------------------------------------------------------------------------------------------->
					
					
					
					<br>
						<input type="hidden" class="form-control"  name="kode_mt_hasilpm" value="<?=$kode_mt_hasilpm?>">
						<input type="hidden" class="form-control"  name="kode_bagnya" value="050101">
						<input type="hidden" class="form-control"  name="validasi" value="1">
						
					<div class="row">
						<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="SubmitLAb()">Submit</button>
						</div>
						</div>
					</div>

			</div>
				
			</div>
			</form>	
			<br>
</div>

<!--END------------------------------------------------------------------------->
		
<script>
function autocomplete(inp, arr) {
		var currentFocus;
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value;
			closeAllLists();
			if (!val) { return false;}
			currentFocus = -1;
			a = document.createElement("DIV");
			a.setAttribute("id", this.id + "autocomplete-list");
			a.setAttribute("class", "autocomplete-items");
			this.parentNode.appendChild(a);
			for (i = 0; i < arr.length; i++) {
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					b = document.createElement("DIV");
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length);
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
					b.addEventListener("click", function(e) {
						inp.value = this.getElementsByTagName("input")[0].value;
						closeAllLists();
					});
					a.appendChild(b);
				}
			}
		});
		inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				currentFocus++;
				addActive(x);
			} else if (e.keyCode == 38) {
				currentFocus--;
				addActive(x);
			} else if (e.keyCode == 13) {
				e.preventDefault();
				if (currentFocus > -1) {
					if (x) x[currentFocus].click();
				}
			}
		});
		function addActive(x) {
			if (!x) return false;
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) {
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
		}
		function closeAllLists(elmnt) {
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		document.addEventListener("click", function (e) {
			closeAllLists(e.target);
		});
	}

	var data=<?=json_encode($arrTarif)?>;

	autocomplete(document.getElementById("generalSearch"), data);

</script>





		
		<script>
		function SubmitLAb(){
			Swal.fire({
			title: "Simpan Data Labolatorium ?",
			text: "apakah data yang di pilih sudah benar ?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "Simpan",
			cancelButtonText: "Batal",
			customClass: {
			   confirmButton: "btn btn-success",
			   cancelButton: "btn btn-warning"
			  }
			}).then(function(result) {
				if (result.value) {
					var dataform=$("#FormAddLab").serialize();
					$.ajax({
						type: "POST",
						url: '/00_admin/standar_lab_act.php',
						data: dataform,
						success: function(data){
							if(data.code=='200'){
								$("#ModalAddLab").modal('hide');
								$('.modal-backdrop').remove();
								$('#idLab').load("../00_admin/lab_standar.php");
								Swal.fire("Sukses ","Berhasil Menyimpan data","success");
							}else{
								alert('Gagal');
							}
						},
						dataType: "json"
					});
				}
			});
			

		}
</script>
	</body>
</html>