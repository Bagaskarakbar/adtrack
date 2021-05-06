<?
	session_start();
	require_once("../_lib/function/db.php");
	loadlib("function","variabel");
	loadlib("function","function.olah_tabel");
	loadlib("class","Paging");

	$filter ? $sqlPlus="WHERE nama_group LIKE '%$filter%'" : $sqlPlus = "";

	$sql = "select * from dd_user_group $sqlPlus";
	
	$recperpage = 20;

	$pagenya = new Paging($db, $sql, $recperpage);
	$rsPaging = $pagenya->ExecPage($hal);
	$NoAwal = ($hal == "" || $hal < 1) ? 0 : ($rsPaging->_currentPage - 1) * $recperpage;
?>

			<table cellpadding="0" cellspacing="0" class="table">
				<thead>
					<tr>
						<th class="thno">No.</th>
						<th class="thicons">&nbsp;</th>
						<th class="thicons">&nbsp;</th>
						<th width="150">Nama Group</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
		<!-- ========================================================================================= -->
		<?
			$i = $pagenya->pagingVars["firstno"];
		
			while ($tampil=$rsPaging->FetchRow()) {
				$i++;

				$id_dd_user_group = $tampil["id_dd_user_group"];
				$nama_group = $tampil["nama_group"];
				$keterangan = $tampil["keterangan"];
				
				$cek_del = "";

				if($id_dd_user_group!="")$cek_del=baca_tabel("dd_user","id_dd_user_group","WHERE id_dd_user_group=".$id_dd_user_group);
		?>
					<tr>
						<td class="tdno"><?= $i ?>.</td>
						<td class="tdicons">
							<?if($cek_del!=""){ echo "&nbsp;"; } else {?>
							<a class="hapus" href="#" title="Hapus <?= $nama_group ?>" onclick="openPop('privilleges_groupuser_act.php?id_dd_user_group=<?= $id_dd_user_group ?>&act=delete')">
							<i class="las la-trash-alt icon-lg text-danger "></i>
							</a>
							<?}?>
						</td>
						<td class="tdicons">
							<a href="#" title="Edit <?= $nama_group ?>" onclick="openPop('privilleges_groupuser_addedit.php?id_dd_user_group=<?= $id_dd_user_group ?>')">
							<i class="las la-edit icon-lg text-success "></i>
							</a>
						</td>
						<td nowrap><b><?= $nama_group ?></b>&nbsp;</td>
						<td><?= $keterangan ?>&nbsp;</td>
					</tr>
		<?
			} // end of while ($rsPaging->FetchRow())
		?>
	<!-- ========================================================================================= -->
				</tbody>
			</table>
		</div>
	<!-- ========================================================================================= -->
		