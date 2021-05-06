<?php

set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
require_once("../_lib/function/function.olah_tabel.php");
	// ==================== GET MR,REGIS, ===================//

	// $db->debug=true;
	// $input = json_decode(file_get_contents('php://input'),true);

$H_bagian=read_tabel("mt_bagian","*","WHERE validasi=0100 and kode_bagian not in (010901,011201,011301,012401,013001,013101,013201,013301,013401,013601,015101)");
$Count_bag=$H_bagian->_numOfRows;

$arr['jml_bag']=$Count_bag;

while($T_bagian=$H_bagian->Fetchrow()){
	$arr['bagian'][]=$T_bagian;
}

if (empty($arr)) {
	$data['Response']=0;
	echo json_encode($data);
} else {
	$arr['Response'] = 1;
	echo json_encode($arr);
}
?>