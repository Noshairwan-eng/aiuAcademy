
<?php
include("bl_comic.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_GET["token"])?$_GET["token"]:null;

$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;
$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : null;




if(TokenVerified($token))
{
  $objBLEquipments = new BL_AIRLINE_COST($mysqli);
  $response = $objBLEquipments->GetAirlineCost(
    $uid,
    $request_id
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
