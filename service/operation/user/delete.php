
<?php
include("bl_user.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_GET["token"])?$_GET["token"]:null;
$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;


if(TokenVerified($token))
{
  if($uid!=null)
  {
    $objBLUser = new BL_USER($mysqli);
    $response = $objBLUser->DeleteUser($uid);       
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
