
<?php
// Includes ===========================================
include("../../database/model/Admin.php");
// ====================================================


class BL_AUTH
{
  public $mysqli;
  // Constructor================
  function __construct($mysqli)
  {
      $this->mysqli = $mysqli;
  }
  //============================

  // Request Methods ========================================

  function GetUserDetail($username,$password)
  {
    $objAdmin = new Admin($this->mysqli);
    $objAdmin->UserName = $username;
    $Admin = $objAdmin->Select();

    if($Admin!=null && count($Admin)>0)
    {
        // Matching user Password
        if($Admin[0]["Password"]!=$password)
        {
            $res["status"] = "failed";
            $res["data"] = "";
            $res["error"] = "Incorrect Password.";
        }
        // Checking if user status is inactive
        else if($Admin[0]["Status"]=="0")
        {
            $res["status"] = "failed";
            $res["data"] = "";
            $res["error"] = "You user account is inactive.";            
        }
        else
        {
            $token = $this->GenerateToken();
            $Admin[0]["token"] = $token;
            
            $res["status"] = "success";
            $res["data"] = $Admin[0];
            $res["error"] = "";
        }
    }
    else
    {
        $res["status"] = "failed";
        $res["data"] = "";
        $res["error"] = "No such user found.";

    }

    return $res;

  }


  function GenerateToken()
  {
    // Creating a random string to create Token
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 20;
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $charset[mt_rand(0, strlen($charset) - 1)];
    }
    $current_time = time();
    $timestamp_string = date('YmdHis', $current_time);
    
    // Attaching Time Stamp to Token String    
    $token = $random_string . "_" . $timestamp_string;

    // Adding token value to session
    session_start();
    $_SESSION["token"] = $token;

    return $token;

  }


// =========================================================

  


}

 ?>
