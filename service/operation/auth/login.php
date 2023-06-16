
<?php
include("bl_auth.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_POST["token"])?$_POST["token"]:null;
$username = isset($_POST["username"])?$_POST["username"]:null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;



if(TokenVerified($token))
{
    $objBLAuth = new BL_AUTH($mysqli);
    if($username!=null && $password!=null)
    {
        $response = $objBLAuth->GetUserDetail($username,$password);  
    }
    else
    {
        $response["status"] = "failed";
        $response["data"] = "";
        $response["error"] = "Username or Password was not provided.";
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
