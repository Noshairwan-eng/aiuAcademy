
<?php
// Includes ===========================================
include("../../database/model/User.php");
// ====================================================


class BL_AIRLINE_COST
{
  public $mysqli;
  // Constructor================
  function __construct($mysqli)
  {
      $this->mysqli = $mysqli;
  }
  //============================

  // User Methods ========================================

  function GetUsers($uid, $FirstName, $LastName, $Email)
  {
    $objUser = new User($this->mysqli);
    // Setting User Object values for Insert
    $objUser->uid = $uid;
    $objUser->FirstName = $FirstName;
    $objUser->LastName = $LastName;
    $objUser->Email = $Email;

    $User = $objUser->Select();

    if($objUser->error =="")
    {
      $res["status"] = "success";
      $res["data"] = $User;
      $res["error"] = "";
    }
    else
    {
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $objUser->error;
    }

    return $res;

  }

  function SaveUser($FirstName, $LastName, $Email)
  {
    //$this->mysqli->begin_transaction();
    try
    {

      $objUser = new User($this->mysqli);
      // Setting Reuqest Object values for Insert
      $objUser->FirstName = $FirstName;
      $objUser->LastName = $LastName;
      $objUser->Email = $Email;  
    
      // Setting Return Object
      $rtrn = $objUser->Insert();

      $inserted_request_id = $this->mysqli->insert_id;


      if($rtrn)
      {
          $res["status"] = "success";
          $res["data"] = $inserted_request_id;
          $res["error"] = "";
      }
      else {
        $res["status"] = "failed";
        $res["data"] = "";
        $res["error"] = $objUser->error;
      }

      //$this->mysqli->commit();

    }
    catch (mysqli_sql_exception $exception)
    {
      //$this->mysqli->rollback();
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $exception;

    }

    return $res;
  }

  function UpdateUser($uid, $FirstName, $LastName, $Email)
  {
    //$this->mysqli->begin_transaction();
    try
    {

      $objUser = new User($this->mysqli);

      // Key Column 
      $objUser->uid = $uid;
      // Setting Reuqest Object values for Insert
      $objUser->FirstName = $FirstName;
      $objUser->LastName = $LastName;
      $objUser->Email = $Email;
     
      // Setting Return Object
      $rtrn = $objUser->Update();

      if($rtrn)
      {
          $res["status"] = "success";
          $res["data"] = "";
          $res["error"] = "";
      }
      else {
        $res["status"] = "failed";
        $res["data"] = "";
        $res["error"] = $objUser->error;
      }

      //$this->mysqli->commit();

    }
    catch (mysqli_sql_exception $exception)
    {
      //$this->mysqli->rollback();
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $exception;

    }

    return $res;
  }

  function DeleteUser($uid)
  {
    $objUser = new User($this->mysqli);
    // Setting Reuqest Object values for Insert
    $objUser->uid = $uid;

    $User = $objUser->Delete();

    if($objUser->error =="")
    {
      $res["status"] = "success";
      $res["data"] = "";
      $res["error"] = "";
    }
    else
    {
      $res["status"] = "failed";
      $res["data"] = "";
      $res["error"] = $objUser->error;
    }

    return $res;

  }

// =========================================================
}

 ?>
