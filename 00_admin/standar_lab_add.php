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

	// $sql = "SELECT * FROM pm_mt_standarhasil WHERE kode_mt_hasilpm='050201'";

	// $hasil =& $db->Execute($sql);

	// $kode_mt_hasilpm = $hasil->Fields('kode_mt_hasilpm');
	// $kode_tarif = $hasil->Fields('kode_tarif');
	// $nama_pemeriksaan = $hasil->Fields('nama_pemeriksaan');
	// $kode_bagian = $hasil->Fields('kode_bagian');
	// $standar_hasil_wanita = $hasil->Fields('standar_hasil_wanita');
	// $standar_hasil_pria = $hasil->Fields('standar_hasil_pria');
	// $standar_hasil_wanita_min = $hasil->Fields('standar_hasil_wanita_min');
	// $standar_hasil_wanita_max = $hasil->Fields('standar_hasil_wanita_max');
	// $keterangan = $hasil->Fields('keterangan');
	// $satuan = $hasil->Fields('satuan');
	// $nama_tindakan=baca_tabel("mt_master_tarif","nama_tarif","where kode_tarif='".$kode_tarif."'");
	
	
	
	
$sqlCari = "SELECT * FROM mt_master_tarif WHERE kode_bagian='050201' AND tingkatan=5";
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
		
			<form id="AddRadiologi" method="POST" action="#"  enctype="multipart/form-data">
			
			<div id="content">
					<div class="modal-header register-modal-head" style="background-color:#2b345f">
						<h5 class="modal-title" style="color:white"><b>Tambah Radiologi</b></h5>
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
						
								<input type="text" class="form-control"  name="nama_tarif" id="generalSearch">
							
								
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
								<label for="exampleSelect1">Temuan Radiologi   </label>
							</div>
							<div class="col-lg-8">
								<TEXTAREA NAME="standar_rad" class="form-control" value="<?= $standar_rad ?>" ><?= $standar_rad ?></TEXTAREA>
							</div>

					</div>
				<br>
					<div class="row">
							<div class="col-lg-4">
								<label for="exampleSelect1">Kesan </label>
							</div>
							<div class="col-lg-8">
								<TEXTAREA NAME="txt_kesan" class="form-control" value="<?= $kesan ?>"><?= $kesan ?></TEXTAREA>
							</div>

					</div>
			
					
					<br>
						<input type="hidden" class="form-control"  name="kode_mt_hasilpm" value="<?=$kode_mt_hasilpm?>">
						<input type="hidden" class="form-control"  name="kode_bagnya" value="050201">
						
					<div class="row">
						<div class="col-lg-12">
						<div class="card-footer" align="right">
							<button type="button" class="btn btn-success font-weight-bolder font-size-sm" onclick="TambahRadiologi()">Submit</button>
						</div>
						</div>
					</div>

			</div>
				
			</div>
			</form>	
			<br>
</div>
		
		
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
function TambahRadiologi()
				{
					var nama_tarif;
					var nama_pemeriksaan;
					var standar_rad;
					var txt_kesan;
	
					
					nama_tarif			=$("input[name=nama_tarif]").val();
					nama_pemeriksaan	=$("input[name=nama_pemeriksaan]").val();

					standar_rad			=$("textarea[name=standar_rad]").val();
					txt_kesan			=$("textarea[name=txt_kesan]").val();


					if(nama_tarif=="")
					{
						
						$("input[name=nama_tarif]").focus();
						Swal.fire("Oops !", "Anda Belum Memilih Nama Tarif!", "warning");
					}else if(nama_pemeriksaan=="")
					{
						$("input[name=nama_pemeriksaan]").focus();
						Swal.fire("Oops !", "Anda Belum Mengisi Nama Pemeriksaan!", "warning");
					}else{
						Swal.fire({
						title: "Radiologi",
						text: "apakah yakin data yang diinput sudah benar ?",
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
								var datastring=$("#AddRadiologi").serialize();
								$.ajax({
								  type: "POST",
								  url: '/00_admin/rad_add_act.php',
								  data: datastring,
								  success: function (data){
														if(data.code=='200')
													{ 
															 Swal.fire("Sukses ","Berhasil Menambahkan Radiologi","success");
															
															$("#ModalAddRad").modal('hide');
																$('.modal-backdrop').hide();
															$("#RadView").load("../00_admin/rad_standar.php");
													}
														else{
														alert("Gagal Mengedit, Coba Lagi!");
													}
								  },
								  dataType: "json"
								});
							}
						});

					}
				}
</script>
