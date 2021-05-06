<?
/**
 * dbconn() : Untuk menghubungkan ke database driver & database engine
 *
 * @param  string  $db_type  Tipe database
 * @param  string  $db_host  Host/Server database
 * @param  string  $db_user  User name
 * @param  string  $db_pass  User password
 * @param  string  $db_name  Nama database
 *
 * @return  object  Obyek database
 *
 */

if (!function_exists("dbconn_hr")) {
	function dbconn_hr($db_type,$db_host,$db_user,$db_pass,$db_name) {
		require_once(WWWROOT."/_contrib/adodb/adodb.inc.php");

		$db_hr=&ADONewConnection($db_type);
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		//$db->debug=true;
		if (!($db->Connect($db_host,$db_user,$db_pass,$db_name))) {
			die("Gagal konek<br>\n");
		}
		return $db_hr;
	} #function dbconn($db_type,$db_host,$db_user,$db_pass,$db_name){
} // end of if(!function_exists("dbconn"))
?>