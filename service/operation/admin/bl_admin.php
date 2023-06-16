
<?php
// Includes ===========================================
include("../../database/model/Admin.php");
// ====================================================


class BL_ADMIN
{
  public $mysqli;
  // Constructor================
  function __construct($mysqli)
  {
      $this->mysqli = $mysqli;
  }
  //============================

  // Admin Methods ========================================
  function GetAdmin($UserName, $Password)
  {
      $objAdmin = new Admin($this->mysqli);
      // Setting User Object values for Insert

      $objAdmin->UserName = $UserName;
      $objAdmin->Password = $Password;

      $Admin = $objAdmin->Select();

      if($objAdmin->error =="")
      {
        $res["status"] = "success";
        $res["data"] = $Admin;
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
