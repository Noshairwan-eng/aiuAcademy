
<?php
include("bl_airlinecost.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_POST["token"])?$_POST["token"]:null;

$uid = isset($_POST["uid"]) ? $_POST["uid"] : null;
$CompanyName = isset($_POST["CompanyName"]) ? $_POST["CompanyName"] : null;
$AirCraft = isset($_POST["AirCraft"]) ? $_POST["AirCraft"] : null;
$FT = isset($_POST["FT"]) ? $_POST["FT"] : null;
$STP = isset($_POST["STP"]) ? $_POST["STP"] : null;
$Comments = isset($_POST["Comments"]) ? $_POST["Comments"] : null;
$Price = isset($_POST["Price"]) ? $_POST["Price"] : null;
$SellFor = isset($_POST["SellFor"]) ? $_POST["SellFor"] : null;



if(TokenVerified($token))
{
  // Validating Information
  if($uid!=null)
  {
      $objBLAirlineCost = new BL_AIRLINE_COST($mysqli);
      $response = $objBLAirlineCost->UpdateAirlineCost(
            $uid,
            $CompanyName,
            $AirCraft,
            $FT,
            $STP,
            $Comments,
            $Price,
            $SellFor
      );
  }
  else
  {
    $response["status"] = "failed";
    $response["data"] = "";
    $response["error"] = "Incomplete information is provided.";
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
