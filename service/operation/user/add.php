
<?php
include("bl_user.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_POST["token"])?$_POST["token"]:null;

$FirstName = isset($_POST["first_name"]) ? $_POST["first_name"] : null;
$LastName = isset($_POST["last_name"]) ? $_POST["last_name"] : null;
$Email = isset($_POST["email"]) ? $_POST["email"] : null;




if(TokenVerified($token))
{
  // Validating Information
  if($FirstName!=null && $LastName!==null && $Email!=null && )
  {
      $objBLUser = new BL_USER($mysqli);
      $response = $objBLUser->SaveUser(
            $FirstName,
            $LastName,
            $Email
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
