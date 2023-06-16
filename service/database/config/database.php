<?php
function GetURI()
{
  $arr_uri = explode("service", $_SERVER["REQUEST_URI"]);
  $uri =  "//".$_SERVER["HTTP_HOST"] . $arr_uri[0]."service";
  return $uri;
}
?>
<?php
//$host =  "localhost";
//$user = "root";
//$password = "";
//$database = "medical_escort";
$host =  "localhost";
$user = "gbproje1_user_medical_escort";
$password = "kXq>I^Vdsi4V%iEx";
$database = "gbproje1_medical_escort";
$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->query("SET NAMES 'utf8'");

include("cors.php");

?>
