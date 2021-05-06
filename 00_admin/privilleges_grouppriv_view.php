<?
	session_start();

	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.tidak_berulang");
	loadlib("function","function.pilihan_list");

	$sqlPlus="AND id_dc_sub_menu IS NULL ";

	////////////////////////////////////////////////////////////////

	if(isset($tipeCari)){

		$sqlUserGroup = "SELECT *, id_dc_sub_menu as kode_submenu FROM dd_user_group_detail WHERE id_dd_user_group=$tipeCari";
		$hasilUserGroup =& $db->Execute($sqlUserGroup);

		while ($tampilUserGroup=$hasilUserGroup->FetchRow()) {
			$hak_akses_menu[$tampilUserGroup["kode_submenu"]] = $tampilUserGroup["hak_akses_menu"];
		}

		$sqlPlus = "";

	}

	////////////////////////////////////////////////////////////////

	$sql = "
		SELECT		s.*,m.nama_menu,m.no_urut AS no_urut_menu,d.nama_modul,d.id_dc_modul
		FROM		dc_sub_menu s,dc_menu m,dc_modul d
		WHERE		s.id_dc_menu=m.id_dc_menu AND m.id_dc_modul=d.id_dc_modul   $sqlPlus
		ORDER BY	d.nama_modul,m.no_urut,s.no_urut 
	";

	$hasil =& $db->Execute($sql);

	////////////////////////////////////////////////////////////////

	$sqlGroup = "SELECT id_dd_group, nama_group FROM dd_group";
	$hasilGroup =& $db->Execute($sqlGroup);

	while ($tampilGroup=$hasilGroup->FetchRow()) {
		$nama_group[] = $tampilGroup["nama_group"];
		$id_dd_group[] = $tampilGroup["id_dd_group"];
	}

?>
<html>
	<head>
		<title>Averin Intranet Application Framework - Pagging Template</title>
		<? 
			include("../_inc/tpl_incHtmlHead.php"); 
		?>
	</head>
	<body scroll="no">
		<div id="topLayer" class="loading"></div>
		<!-- ========================================================================================= -->
		<div id="isiAtas">
			<div id="barJudul">Konfigurasi Hak Group User</div>
			<div id="barTools">
				<form method="get" action="<?= $PHP_SELF ?>">
					<table cellpadding="0" cellspacing="0" class="singleRow">
						<tr>
							<td>
								<select name="tipeCari" onChange="submit()">
									<option value="">-- Pilih Group User --</option>
									<?
									$sql_kelompok = "select * from dd_user_group";
									pilihan_list($sql_kelompok,"nama_group","id_dd_user_group","id_dd_user_group",$tipeCari);
									?>
								</select>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<!-- ========================================================================================= -->

		<!-- ========================================================================================= -->
		<form name="xxx" method="post" action="privilleges_grouppriv_act.php?act=pilih">
		<div id="isiUtama">

			<table cellpadding="0" cellspacing="0" class="table">
				<thead>
					<tr>
						<th class="thno">No.</th>
						<th style="width:80px;text-align:left;" nowrap>Nama Modul</th>
						<th style="width:130px;text-align:left;" nowrap>Nama Menu</th>
						<th style="width:180px;text-align:left;" nowrap>Nama Sub Menu</th>
						<?	for($k = 0; $k < count($id_dd_group); ++$k){?>
						<th style="width:50px; font-weight:normal;"><?= $nama_group[$k]?></th>
						<?	} ?>
						<th>&nbsp;No Priv.</th>
					</tr>
				</thead>
				<tbody>
		<!-- ========================================================================================= -->
		<?
			$i = 0;
		
			while ($tampil=$hasil->FetchRow()) {
				$i++;

				$id_dc_sub_menu = $tampil["id_dc_sub_menu"];
				$id_dc_menu = $tampil["id_dc_menu"];
				$id_dc_modul = $tampil["id_dc_modul"];
				$nama_sub_menu = $tampil["nama_sub_menu"];
				$url_sub_menu = $tampil["url_sub_menu"];
				$keterangan = $tampil["keterangan"];
				$no_urut = $tampil["no_urut"];
				$input_id = $tampil["input_id"];
				$input_tgl = $tampil["input_tgl"];
				$nama_menu = $tampil["nama_menu"];
				$nama_modul = $tampil["nama_modul"];
				$no = $i.".";

				tidak_berulang("nama_modul,nama_menu");
		?>
					<tr id="<?= $id_dc_sub_menu?>">
						<td class="tdno"><?= $no ?></td>
						<td nowrap><?= $nama_modul ?>&nbsp;</td>
						<td nowrap><?= $nama_menu ?>&nbsp;</td>
						<td nowrap><b><?= $nama_sub_menu ?>&nbsp;</b></td>
						<?
						$num_of_isChecked=0;
						for($k = 0; $k < count($id_dd_group); ++$k){

							$isChecked = "";
							if($hak_akses_menu[$id_dc_sub_menu]==$id_dd_group[$k]) {$isChecked = "checked";$num_of_isChecked++;}

						?>
						<td class="tdcheck"><input type="checkbox" value="<?= $id_dd_group[$k]?>" onclick="diKlik()" <?= $isChecked?> title="<?= $nama_group[$k]?>"></td>
						<?	} 
						if($num_of_isChecked==0){$isCheckedplus = "checked";}else{$isCheckedplus = "";}
						?>
						<td>&nbsp;<input type="checkbox" value="no_access" onclick="diKlik()" <?= $isCheckedplus?> title="<?= $nama_group[$k+1]?>"></td>
						<input type="hidden" name="id_dd_user_group" value="<?=$tipeCari?>">
					</tr>
		<?
			}
		?>
	<!-- ========================================================================================= -->
				</tbody>
			</table>
		</div>
		<div id="isiBawah">
			<input type="submit" class="submit01" value="Submit">
		</div>
		</form>
	<!-- ========================================================================================= -->
		<script language="JavaScript" type="text/javascript">
			window.onload = function() {
				initHalaman();
			}

			function diKlik(evt) {
				var e = new aEvent(evt);
				var siElem = e.target;

				var siTr = siElem.parentElement.parentElement
				var siInput = siTr.getElementsByTagName("INPUT")

				if(siElem.checked!=false){
					for(var i=0; i<siInput.length; i++){
						siInput[i].checked = false
						siInput[i].name = ""
					}
					siElem.checked = true
				}

				siElem.name = "oid[" + siTr.id + "]"
			}

		</script>
	</body>
</html>