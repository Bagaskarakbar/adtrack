<?
	$data = file_get_contents("php://input");
	$json = json_decode($data, true);
	var_dump($json);// o/p->Null
	print_r($json);// o/p-> nothing

	echo $json[2];
?>