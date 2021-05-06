	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader" align="right">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center">
				<!--begin::Actions-->				
				<a href="#" onclick="url_buka('tarif_view.php?kd_bag=1')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Poliklinik</a>
				<a href="#" onclick="url_buka('tarif_igd.php?kd_bag=2')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">IGD</a>
				<a href="#" onclick="url_buka('tarif_ambulance.php?kd_bag=020102')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Ambulance</a> <!---->
				<a href="#" onclick="url_buka('tarifTindakanRI.php?kd_bag=3')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Tindakan RI</a>
				<a href="#" onclick="url_buka('tarifPenunjangMedis.php?kd_bag=5')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Penunjang</a> 
				<a href="#" onclick="url_buka('tarifPaketMcu.php?kd_bag=5')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Paket MCU</a>
				<a href="#" onclick="url_buka('tarifTindakanVK.php?kd_bag=<?=AV_VK?>')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">VK</a>
				<a href="#" onclick="url_buka('tarifTindakanBedah.php?kd_bag=<?=AV_KAMAR_BEDAH?>')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Bedah</a>
				<a href="#" onclick="url_buka('tarif_ruang_view.php')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Ruangan</a>
				<a href="#" onclick="url_buka('jtindakan_view.php')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Jenis Tindakan</a>
				<a href="#" onclick="url_buka('tarif_kartu_view.php')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Kartu</a>
				<a href="#" onclick="url_buka('profit_view.php')" target="frmIsiTab" class="btn btn-clean btn-hover-light-primary- btn-sm font-weight-bold font-size-base mr-1">Profit Margin</a>
			</div>
		</div>
	</div>

					
					
					
<div class="container mb-0" id="tabstokdepo">

</div>

					


<script>
url_buka('tarif_view.php?kd_bag=1');

	function url_buka(url){
		$('#tabstokdepo').load("/00_admin/"+url);
	}

	
</script>