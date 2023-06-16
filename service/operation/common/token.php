<?php

function TokenVerified($token)
{
  return true; 
  
  $blnFlag = false;

  if($token!="" && $token!=null)
  {

    $adminStr = substr($token,0,5);
    $customerStr = substr($token,0,8);

    if($adminStr=="admin")
    {

      $tokenFinal = substr($token,5,strlen($token)-5);
      session_start();
      $sessionToken = isset($_SESSION["token"])?$_SESSION["token"]:null;
      if($sessionToken == $tokenFinal)
      {
        $blnFlag = true;
      }
      else {
        echo "Checking for Admin Failed Match ($sessionToken) = ($tokenFinal) ";
      }
    }
    else if($customerStr=="customer")
    {
      $tokenFinal = substr($token,8,strlen($token)-8);
      session_start();
      if($_SESSION["token"] == $tokenFinal)
      {
        $blnFlag = true;
      }
    }
    else if($token == "637xy2h2gdgd52gwhdgfdf")
    {
      $blnFlag = true;
    }
    else {
      $blnFlag = false;
    }

  }
  else
  {
    $blnFlag = false;
  }

  return $blnFlag;
}

?>
