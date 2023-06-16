
<?php
include("bl_airlinecost.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_GET["token"])?$_GET["token"]:null;
$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;


if(TokenVerified($token))
{
  if($uid!=null)
  {
    $objBLAirlineCost = new BL_AIRLINE_COST($mysqli);
    $response = $objBLAirlineCost->DeleteAirlineCost($uid);       
  }
  else
  {
    $response["status"] = "failed";
    $response["data"] = "";
    $response["error"] = "Invalid request no id is provided.";  
  }
}
else
{
  $response["status"] = "failed";
  $response["data"] = "";
  $response["error"] = "Your token is either invalid or expired.";
}



echo json_encode($response);

 ?>
