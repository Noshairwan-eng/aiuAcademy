
<?php
include("bl_comic.php");
include("../common/token.php");
include("../../database/config/database.php");


$token = isset($_POST["token"])?$_POST["token"]:null;

$title = isset($_POST["title"]) ? $_POST["title"] : null;
$description = isset($_POST["description"]) ? $_POST["description"] : null;
$file = isset($_FILES["file"]) ? $_FILES["file"] : null;


if(TokenVerified($token))
{
  // Validating Information
  if($title!=null && $file!=null)
  {
      $objBLComic = new BL_AIRLINE_COST($mysqli);
      $response = $objBLComic->SaveComic(
           
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
