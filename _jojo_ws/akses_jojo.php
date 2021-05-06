<?
$postdata = http_build_query(
    array(
        'email' => 'andrey.hidayat@gmail.com',
        'password' => 'verti123'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents('https://apiv2.jojonomic.com/user-service/auth/login', false, $context);
$hasil=json_decode($result,true);
$token=$hasil['token'];
?>