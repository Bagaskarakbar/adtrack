<?
session_start();
//error_reporting(0);
include "_lib/function/db_login.php";
loadlib("function","function.variabel");
loadlib("function","function.olah_tabel");



//$db->debug=true;
?>
<div class="app-sidebar sidebar-shadow" id="kt_aside">
	<div class="app-header__logo">
		<div class="logo-src"></div>
		<div class="header__pane ml-auto">
			<div>
				<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<div class="app-header__mobile-menu">
		<div>
			<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
		</div>
	</div>
	<div class="app-header__menu">
		<span>
			<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
				<span class="btn-icon-wrapper">
					<i class="fa fa-ellipsis-v fa-w-6"></i>
				</span>
			</button>
		</span>
	</div>

	<div class="scrollbar-sidebar">
		<div class="app-sidebar__inner">
			<ul class="vertical-nav-menu">
				<?
				//$db->debug=true;
				foreach ($modularnya as $k=>$id_dc_modular) {
				$nama_modular=baca_tabel("dc_modular","nama_modular","WHERE id_dc_modular=".$id_dc_modular);
				?>
				<li class="app-sidebar__heading"><?=$nama_modular?></li>
				<?
				foreach ($modulnya[$id_dc_modular] as $k=>$id_dc_modul) {

				$rModul=read_tabel("dc_modul","*","WHERE id_dc_modul=".$id_dc_modul);

				while ($resModul=$rModul->FetchRow()) {
					$icon=$resModul["logo"];
					$arrIcon = explode(".",$icon);
					$icon_hover = $arrIcon[0]."_hover.".$arrIcon[1];
					$nama_modul=$resModul["nama_modul"];
					$id_dc_modul=$resModul["id_dc_modul"];
					$folderx=$resModul["folder"];

					 if($id_dc_modul=='1'){
						$folder=$resModul["folder"];
						$modul=$id_dc_modul;
					}else {

						if(!isset($modul)){
							$folder=$resModul["folder"];
							$modul=$id_dc_modul;
						}

					}

				}
				?>
				<li>
					<a class="mm" onclick="loadModul('<?=$id_dc_modul?>','<?=$folderx?>')" style="cursor: pointer;">
						<i class="metismenu-icon"  style="opacity:1;"><img src="<?=$icon?>"  width="24" height="24"></i><?=strtolower($nama_modul)?>
					</a>
				</li>
				<?
				}


				}
				?>

			</ul>
		</div>
	</div>
</div>
