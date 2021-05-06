<?
	session_start();
	/**
	 *
	 * Mendeklarasikan librari-librari dasar
	 *
	 */	 
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("class","Paging");
	loadlib("function","function.datetime");
	loadlib("function","function.uang");
	


	/**
	 *
	 * $sqlPlus, query tambahan untuk proses penelusuran
	 * Bagian ini hanya contoh...disesuaikan dengan kondisi pencarian yang ada
	 *
	 */

	switch ($tipeCari) {
		case "nama" :
			$sqlPlus = "WHERE nama_pasien LIKE'%$filter%'";
			break;
		case "mr" :
			$filter = (int)$filter;
			$sqlPlus = "WHERE no_mr = $filter";
			break;
		default :
			$sqlPlus = "";
	}

	/**
	 *
	 * $sql, query utama
	 *
	 */
		//PUNK-28/06/2013-14:48:26 
		if($rev=='1'){
			$viewnya = "admin_mt_tarif_revisi_view";
		} else {
			$viewnya = "admin_mt_tarif_view";
		}

	$sql = "select * from ".$viewnya." WHERE kode_klas<>16 and kode_tarif='$kode_tarif' $sqlPlus";

	$recperpage = 20;

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;
	
?>
<div class="card-body">
		<!-- ========================================================================================= -->
		<div id="isiAtas">			
			<div class="card-title">
				<h3 class="card-label">Detail Tarif</h3>
			</div>	
			<div id="barTools">
				&nbsp;
				<!-- <a href="tarif_view_add.php?rev=<?=$rev?>&kode_bagian_cari=<?=$kode_bagian_cari?>&kode_tarif=<?=$kode_tarif?>&detail=1" class="tool">Tambah Tarif</a> -->
			</div>
		</div>
		<!-- ========================================================================================= -->
		
		<!-- ========================================================================================= -->
		<div id="isiUtama">
			<table cellpadding="0" cellspacing="0" class="table">
				<thead>
					<tr>
						<th class="thno" rowspan="2">No.</th>
						<!-- <th class="thedit" rowspan="2">Edit</th>
						<th class="thcheck" rowspan="2">&nbsp;</th> -->
						<th rowspan="2">Kode Tarif</th>
						<th rowspan="2">Nama Tarif</th>
						<th rowspan="2">Nama Bagian</th>
						<th rowspan="2">Nama Klas</th>
						<!--<th rowspan="2">Tgl Berlaku</th>
						<th colspan="4">Tarif</th>-->
						<th rowspan="2">Total</th>
					</tr>
					
					<!--<tr>
						<th>Bill Dr 1</th>
						<th>Bill Dr 2</th>
						<th>Bill Dr 3</th>
						<th>RS</th>
					</tr>-->
					
				</thead>
				<tbody>
		<!-- ========================================================================================= -->
		<?
			$i = $pagenya->pagingVars["firstno"];
		
			while ($tampil=$rsPaging->FetchRow()) {
				$i++;


				$kode_tarif = $tampil["kode_tarif"];
				$nama_tarif = $tampil["nama_tarif"];
				$tingkatan = $tampil["tingkatan"];
				$referensi = $tampil["referensi"];
				$jenis_tindakan = $tampil["jenis_tindakan"];
				$paket_askes = $tampil["paket_askes"];
				$bill_rs = $tampil["bill_rs"];
				$kode_klas = $tampil["kode_klas"];
				$bill_dr1 = $tampil["bill_dr1"];
				$bill_dr2 = $tampil["bill_dr2"];
				$bill_dr3 = $tampil["bill_dr3"];
				$bhp = $tampil["bhp"];
				$rs = $tampil["bill_rs"];
				$total = $tampil["bill_rs"]+$tampil["bill_dr3"]+$tampil["bill_dr2"]+$tampil["bill_dr1"];
				$kode_tgl_tarif = $tampil["kode_tgl_tarif"];
				$kode_master_tarif_detail = $tampil["kode_master_tarif_detail"];
				$nama_klas = $tampil["nama_klas"];
				$kode_bagian = $tampil["kode_bagian"];
				$nama_bagian = $tampil["nama_bagian"];
				$tgl_berlaku = $tampil["tgl_berlaku"];
				$status = $tampil["status"];
				
		?>
					<tr>
						<td class="tdno"><?= $i ?>.</td>
						<!-- <td class="tdicons">
							<a href="#" onclick="openPop('tarif_view_edit.php?rev=<?=$rev?>&kode_master_tarif_detail=<?=$kode_master_tarif_detail?>&kode_bagian=<?=$kode_bagian?>&kode_tarif=<?=$kode_tarif?>&kode_bagian_cari=<?=$kode_bagian_cari?>&detail=1')">
							<img src="../_images/icons/icokecil_edit.gif" width="13" height="12" border="0" alt="Edit">
							</a>
						</td>
						<td>
							<a class="hapus" href="tarif_view_hapus.php?rev=<?=$rev?>&kode_master_tarif_detail=<?=$kode_master_tarif_detail?>&detail=1&kode_bagian=<?=$kode_bagian?>&kode_tarif=<?=$kode_tarif?>" title="Hapus"><img src="/_images/icons/icokecil_hapus.gif" border="0"></a>
						</td> -->
						<td><?= $kode_tarif ?>&nbsp;</td>
						<td><?= $nama_tarif ?>&nbsp;</td>
						<td><?= $nama_bagian ?>&nbsp;</td>
						<td><?= $nama_klas ?>&nbsp;</td>
						<!--<td align="center"><?= date2str($tgl_berlaku) ?>&nbsp;</td>
						<td align="right"><?= uang($bill_dr1,true) ?>&nbsp;</td>
						<td align="right"><?= uang($bill_dr2,true) ?>&nbsp;</td>
						<td align="right"><?= uang($bill_dr3,true) ?>&nbsp;</td>
						<td align="right"><?= uang($rs,true) ?>&nbsp;</td>-->
						<!-- <td align="right"><?= uang($bhp,true) ?>&nbsp;</td> -->
						<td align="right"><?= uang($total,true) ?>&nbsp;</td>
					</tr>
		<?
			} // end of while ($hasil->FetchRow())
		?>
	<!-- ========================================================================================= -->
				</tbody>
			</table>
		</div>
	</div>
	<!-- ========================================================================================= -->
		