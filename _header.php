<?
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
?>

<div class="app-header header-shadow">
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
	<div class="app-header__content" >
		<div class="app-header-left">
		<ul class="header-menu nav">
			<?
			//$db->debug=true;
			$menunya=array();
			$submenunya=array();
			$sec=new Security($db);
			
			if ($sec->isLoggedIn(session_id()) && $sec->isValidUser() && $sec->isModulAllowed($modul)) {
				$menunya=$sec->hakMenu($modul);
				
				foreach ($menunya as $k=>$id_dc_menu) {
					
					$submenunya[$id_dc_menu]=$sec->hakSubMenu($modul,$id_dc_menu);
					
				}
				
			} else {
				$lokasi="login.php";
			}
			
			
			foreach ($menunya as $k=>$id_dc_menu) {
			
			
			$nama_menu		=baca_tabel("dc_menu","nama_menu","where id_dc_menu=".$id_dc_menu);
			$id_dc_modul	=baca_tabel("dc_menu","id_dc_modul","where id_dc_menu=".$id_dc_menu);
			
			//echo $nama_menu;
			?>
			
			<?
			$userModul["id_dc_modul"]	=$id_dc_modul;
			$_SESSION['modul']			=$userModul;
			/*Cek Jumlah Sub Menu------------------------------------------------------*/
			
			$jmlSubmenu=count($submenunya[$id_dc_menu]);
			
			/* if($jmlSubmenu == '1'){ */
				
				foreach ($submenunya[$id_dc_menu] as $k=>$id_dc_sub_menu) {
							
							$rSubMenu=read_tabel("dc_sub_menu","url_sub_menu,nama_sub_menu","where id_dc_sub_menu=".$id_dc_sub_menu);
							$url_sub_menu	=$rSubMenu->fields("url_sub_menu");
			?>
				
				 <li class="nav-item">
					<a onclick="loadKonten('<?=$url_sub_menu?>')" class="nav-link">
						<i class="nav-link-icon fa fa-database"> </i>
						<?=$nama_menu?>
					</a>
				</li>
			<?
				}
			}
			?>
								  
				
			</ul>  
			

			
		</div>
		<?php include "profil_user.php"?>
	</div>
</div>        