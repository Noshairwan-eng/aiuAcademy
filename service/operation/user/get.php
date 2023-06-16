
<?php
include("bl_airlinecost.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_GET["token"])?$_GET["token"]:null;

$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;
$FirstName = isset($_GET["first_name"]) ? $_GET["first_name"] : null;
$LastName = isset($_GET["last_name"]) ? $_GET["last_name"] : null;
$Email = isset($_GET["email"]) ? $_GET["email"] : null;




if(TokenVerified($token))
{
  $objBLUser = new BL_USER($mysqli);
  $response = $objBLUser->GetUsers(
    $uid,
    $FirstName,
    $LastName,
    $Email
  );
}
else
{
  $response["status"] = "failed";
  $response["data"] = "";
  $response["error"] = "Your token is either invalid or expired.";
}



echo json_encode($response);

 ?>
