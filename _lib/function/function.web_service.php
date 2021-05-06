<?
function file_post_contents($url, $data, $username = null, $password = null)
{
    $postdata = json_encode($data);
    $url="http://distrex.averin.co.id/api/".$url;
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context = stream_context_create($opts);
    return file_get_contents($url, false, $context);
}
function file_request_contents($url, $data){
  global $db;
  $url="http://distrex.averin.co.id/api/".$url;
  $dateNow=date("Y-m-d");
  $SqlGetKonfig="select kode_apotik,username,password,key_akses,tgl_expired from dd_konfigurasi ";
  $RunGetKonfig=$db->Execute($SqlGetKonfig);
  while($TplGetKonfig=$RunGetKonfig->fetchRow()){
    $key_akses		=$TplGetKonfig["key_akses"];
    $tgl_expired	=$TplGetKonfig["tgl_expired"];
    $kode_apotik	=$TplGetKonfig["kode_apotik"];
    $username	    =$TplGetKonfig["username"];
    $data['key_akses']  =$key_akses;
    $data['tgl_expired']=$tgl_expired;
    $data['kode_apotik']=$kode_apotik;
    $data['username']   =$username;
  }
  if(isset($tgl_expired)){
    if($tgl_expired > $dateNow){
        $postdata = json_encode($data);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }else{
        $dataJson['code']='100';
        return  json_encode($dataJson);
    }
  }else{
      $dataJson['code']='100';
      return  json_encode($dataJson);
  }
}
?>
